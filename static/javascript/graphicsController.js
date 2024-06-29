Chart.defaults.color = "#fff";
Chart.defaults.borderColor = "#444";

const getDataColors = (opacity) => {
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
              backgroundColor: getDataColors()[parseInt(Math.random() * 10)],
              borderColor: getDataColors(0),
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


  // let f = document.getElementById("GenReport").addEventListener("click", () => {
  //   const link = document.createElement("a");
  //   link.href = chart.toBase64Image();

  //   link.download = "chart.png";
  //   link.click();
  //   Chart.defaults.color = "#000";
  //   Chart.defaults.borderColor = "#444";
  // });
};

const renderModelsChart2 = () => {
  let gananciasMensuales = [5000, 6000, 4500, 7000, 5500, 8000];

  const data = {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [
      {
        label: "Ganacias mensuales",
        data: gananciasMensuales,
        backgroundColor: getDataColors(80)[1],
        fill: true,
        borderColor: getDataColors()[1],
        pointBorderWidth: 5,
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
            backgroundColor: getDataColors(),
            borderColor: getDataColors(),
          },
        ],
      };

      const options = {
        plugins: {
          legend: { position: "left" },
        },
      };

      new Chart("masVendidosChart", { type: "doughnut", data, options });


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
            backgroundColor: getDataColors(),
            borderColor: getDataColors(),
          },
        ],
      };

      const options = {
        plugins: {
          legend: { position: "left" },
        },
      };

      new Chart("menosVendidosChart", { type: "doughnut", data, options });
    }
  })
};





printChart();
