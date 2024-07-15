Chart.defaults.color = "#888";
Chart.defaults.borderColor = "#444";

const getDataColors2 = (opacity) => {
  const colors = [
    "#7448c2",
    "#21c0d7",
    "#d99e2b",
    "#cd3a81",
    "#9c99cc",
    "#e14eca",
    "#ffffff",
    "#ff0000",
    "#d6ff00",
    "#0038ff",
  ];
  return colors.map((color) => (opacity ? `${color + opacity}` : color));
};

const getDataColors = () => {
  let numer1 = parseInt((Math.random() * 255))
  let numer2 = parseInt((Math.random() * 255))
  let numer3 = parseInt((Math.random() * 255))
  return `rgb(${numer1},${numer2},${numer3})`
}

const captureChart = (ChartId, InputId) => {
  var canvas = document.getElementById(ChartId);
  var imgData = canvas.toDataURL('image/png');
  document.getElementById(InputId).value = imgData;
}


const printChart = () => {
  renderModelsChart1();
  renderModelsChart2();
  renderModelsChart3();
  renderModelsChart4();
  renderModelsChart5();
};

const renderModelsChart1 = () => {


  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "ratio_ventas" },
    success: function (response) {
      let json = JSON.parse(response);
      let array = []

      json.lista.forEach(element => {
        if ((element.ratio_ventas == null ? 0 : parseFloat(element.ratio_ventas) * 100) > 0) {
          array.push
            ({
              label: `${element.nombre + " " + element.marca + " de " + element.unidad_valor + " " + element.unidad}`,
              data: [element.ratio_ventas == null ? 0 : parseFloat(element.ratio_ventas) * 100],
              backgroundColor: getDataColors(),
              borderColor: getDataColors(),
              borderWidth: 0,
            })
        }

      });

      const data = {
        labels: ["VOLUMEN DE PRODUCTOS VENDIDIDOS %"],
        datasets: array
      };


      let chart = new Chart("ratioChart", { type: "bar", data });
      document.getElementById('formPDF1').addEventListener('submit', function () {
        captureChart('ratioChart', 'imgRatio_png');
      });

    }
  })
};

const renderModelsChart2 = () => {

  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "ganancia_mensuales" },
    success: function (response) {
      let json = JSON.parse(response);

      let label = []
      let values = []

      // Iterar sobre las claves del objeto y extraer los nombres de los meses
      for (let key in json.lista[0]) {
        // Comprobar si la clave no es un número
        if (isNaN(key)) {
          label.push(key);
        }
      }
      for (const value of label) {
        values.push(json.lista[0][value])
      }


      const data = {
        labels: label,
        datasets: [
          {
            label: "Ganacias mensuales",
            data: values,
            backgroundColor: getDataColors(),
            fill: true,
            borderColor: getDataColors(),
            pointBorderWidth: 0,
            borderWidth: 0,

          },
        ],
      };

      const options = {
        plugins: {
          legend: { display: false },
        },
      };
      new Chart("gananciasChart", { type: "line", data, options });
      document.getElementById('formPDF2').addEventListener('submit', function () {
        captureChart('gananciasChart', 'imgGanancia_png');
      });
    }
  })
};

const renderModelsChart3 = () => {

  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "valor_inventario_mes" },
    success: function (response) {

      let label = []
      let value1 = []
      let value2 = []
      let value3 = []

      let json = JSON.parse(response);

      for (let key in json.lista[0]) {
        // Comprobar si la clave no es un número
        if (isNaN(key)) {
          label.push(key);
        }
      }
      for (const value of label) {
        value1.push(json.lista[0][value])
      }

      $.ajax({
        url: "api_estadisticas",
        type: "GET",
        data: { select: "coste_productos_vendidos" },
        success: function (response) {

          let json = JSON.parse(response);
          for (const value of label) {
            value2.push(json.lista[0][value])
          }


          $.ajax({
            url: "api_estadisticas",
            type: "GET",
            data: { select: "rotacion_inventario" },
            success: function (response) {

              let json = JSON.parse(response);
              for (const value of label) {
                value3.push(json.lista[0][value])
              }

              const data = {
                labels: label,
                datasets: [
                  {
                    label: "Costo de productos vendidos (Bs)",
                    data: value2,
                    borderColor: "#fff",
                    fill: false,
                    pointBorderWidth: 5,
                  },
                  {
                    label: "Valor promedio del inventario (Bs)",
                    data: value1,
                    borderColor: "rgb(1, 166, 203)",
                    fill: false,
                    pointBorderWidth: 5,
                  },
                  {
                    label: "Rotacion de inventario",
                    data: value3,
                    borderColor: "rgb(1, 166, 103)",
                    fill: false,
                    pointBorderWidth: 5,
                  }
                ],
              };
              new Chart("inventoryRotationChart", { type: "line", data });
              document.getElementById('formPDF2').addEventListener('submit', function () {
                captureChart('inventoryRotationChart', 'imgRotacion_png');
              });
            }
          })
        }
      })
    }
  })
};

const renderModelsChart4 = () => {

  let productos = []
  let ventas = [];


  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "max_ventas" },
    success: function (response) {
      let json = JSON.parse(response);
      for (const i of json.lista) {
        let nombre = i.nombre + " " + i.marca + " " + i.unidad_valor + " " + i.unidad
        let cantidad = i.cantidad == null ? 0 : i.cantidad
        productos.push(nombre)
        ventas.push(cantidad)
      }

      const data = {
        labels: productos,
        datasets: [
          {
            label: "Ventas",
            data: ventas,
            backgroundColor: getDataColors2(),
            borderColor: getDataColors2(),
          },
        ],
      };

      const options = {
        plugins: {
          legend: { position: "left" },
        },
      };

      let chart = new Chart("masVendidosChart", { type: "pie", data, options });


      // Capturar el gráfico cuando se envía el formulario
      document.getElementById('formPDF4').addEventListener('submit', function () {
        captureChart('masVendidosChart', 'imgMax_png');
      });
    }
  })
};

const renderModelsChart5 = () => {

  let productos = []
  let ventas = [];


  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "min_ventas" },
    success: function (response) {
      let json = JSON.parse(response);
      for (const i of json.lista) {
        let nombre = i.nombre + " " + i.marca + " " + i.unidad_valor + " " + i.unidad
        let cantidad = i.cantidad == null ? 0 : i.cantidad
        productos.push(nombre)
        ventas.push(cantidad)
      }

      const data = {
        labels: productos,
        datasets: [
          {
            label: "Ventas",
            data: ventas,
            backgroundColor: getDataColors2(),
            borderColor: getDataColors2(),
          },
        ],
      };

      const options = {
        plugins: {
          legend: { position: "left" },
        },
      };

      new Chart("menosVendidosChart", { type: "pie", data, options });

      // Capturar el gráfico cuando se envía el formulario
      document.getElementById('formPDF5').addEventListener('submit', function () {
        captureChart('menosVendidosChart', 'imgMin_png');
      });
    }
  })
};


printChart();


$.ajax({
  url: "api_caja",
  type: "POST",
  data: { accion: "check" },
  success: function (response) {
    let json = JSON.parse(response);
    if (json.estado == "no") {
      document.getElementById("check_box").textContent = "CERRADA";
    } else {
      document.getElementById("check_box").textContent = "ABIERTA";
    }
  }
})
