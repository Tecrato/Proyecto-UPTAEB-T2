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
      // console.log(json);
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
    }
  })
};

const renderModelsChart2 = () => {
  let gananciasMensuales = [5000, 6000, 4500, 7000, 5500, 8000];

  const data = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [
      {
        label: "Ganacias mensuales",
        data: gananciasMensuales,
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
};

const renderModelsChart3 = () => {
  let gananciasMensuales = [1000, 1500, 1200, 1800, 2000, 1700];

  const data = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [
      {
        label: "Costo de productos vendidos",
        data: gananciasMensuales,
        borderColor: "#fff",
        fill: false,
        pointBorderWidth: 5,
      },
      {
        label: "Valor promedio del inventario",
        data: [500, 600, 550, 700, 800, 750],
        borderColor: "rgb(1, 166, 203)",
        fill: false,
        pointBorderWidth: 5,
      },
    ],
  };
  new Chart("inventoryRotationChart", { type: "line", data });
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
      function captureChart() {
        var canvas = document.getElementById('masVendidosChart');
        var imgData = canvas.toDataURL('image/png');
        document.getElementById('imgMax_png').value = imgData;
      }

      // Capturar el gráfico cuando se envía el formulario
      document.getElementById('formPDF4').addEventListener('submit', function () {
        
        captureChart();
        Chart.defaults.color = "#000";
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
      console.log(json);
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

      function captureChart() {
        var canvas = document.getElementById('menosVendidosChart');
        var imgData = canvas.toDataURL('image/png');
        document.getElementById('imgMin_png').value = imgData;
      }

      // Capturar el gráfico cuando se envía el formulario
      document.getElementById('formPDF5').addEventListener('submit', function () {
        
        captureChart();
        Chart.defaults.color = "#000";
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
      console.log(response);
      let json = JSON.parse(response);
      if (json.estado == "no") {
          document.getElementById("check_box").textContent = "CERRADA";
      } else {
          document.getElementById("check_box").textContent = "ABIERTA";
      }
  }
}) 

const fecha = (f) => {
    const fecha = new Date(f);
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    const fechaFormateada = `${dia}/${mes}/${anio}`;
    return fechaFormateada
  }