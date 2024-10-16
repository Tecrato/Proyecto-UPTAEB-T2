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
  renderModelsChart2_1();
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
      // document.getElementById('formPDF1').addEventListener('submit', function () {
      //   captureChart('ratioChart', 'imgRatio_png');
      // });

    }
  })
};

const renderModelsChart2 = () => {
  let gananciasChart;

  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "filter_year", year: new Date().getFullYear() },
    success: function (response) {
      let json = JSON.parse(response);
      let label = [];
      let values = [];

      // Iterar sobre las claves del objeto y extraer los nombres de los meses
      for (let key in json.lista[0]) {
        // Comprobar si la clave no es un número
        if (isNaN(key)) {
          label.push(key);
        }
      }
      for (const value of label) {
        values.push(json.lista[0][value]);
      }

      const data = {
        labels: label,
        datasets: [
          {
            label: "Ganancia/Perdida Bs",
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

      // Crear el gráfico una vez
      if (!gananciasChart) {
        gananciasChart = new Chart("gananciasChart", {
          type: "line",
          data: data,
          options: options,
        });
      } else {
        // Actualizar el gráfico existente con nuevos datos
        gananciasChart.data.labels = label;
        gananciasChart.data.datasets[0].data = values;
        gananciasChart.update(); // Actualizar el gráfico
      }

      let year = document.getElementById('year');

      document.getElementById('formPDF2').addEventListener('submit', function () {
        captureChart('gananciasChart', 'imgGanancia_png');
        year.setAttribute("value", new Date().getFullYear());
      });

      let btnFilterYear = document.querySelector(".btn-filter-year");
      btnFilterYear.addEventListener("click", () => {

        let inputValue = btnFilterYear.previousElementSibling.value;

        $.ajax({
          url: "api_estadisticas",
          type: "GET",
          data: { select: "filter_year", year: inputValue },
          success: function (response) {
            let json = JSON.parse(response);
            let label = [];
            let values = [];

            // Iterar sobre las claves del objeto y extraer los nombres de los meses
            for (let key in json.lista[0]) {
              // Comprobar si la clave no es un número
              if (isNaN(key)) {
                label.push(key);
              }
            }
            for (const value of label) {
              values.push(json.lista[0][value]);
            }

            // Actualizar el gráfico con los datos filtrados por año
            gananciasChart.data.labels = label;
            gananciasChart.data.datasets[0].data = values;
            gananciasChart.update(); // Actualizar el gráfico

            document.getElementById('formPDF2').addEventListener('submit', function () {
              captureChart('gananciasChart', 'imgGanancia_png');
              year.setAttribute("value", inputValue);

            });
          }
        });
      });
    }
  });
};

const renderModelsChart2_1 = () => {
  let chartInstance = null; // Variable para almacenar la instancia del gráfico

  function obtenerInicioYFinSemana() {
    const hoy = new Date(); // Fecha actual
    const diaSemana = hoy.getDay();
    const inicioSemana = new Date(hoy);
    inicioSemana.setDate(hoy.getDate() - ((diaSemana === 0 ? 7 : diaSemana) - 1));
    const finSemana = new Date(inicioSemana);
    finSemana.setDate(inicioSemana.getDate() + 6);

    const formatearFecha = (fecha) => {
      const año = fecha.getFullYear();
      const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // Sumar 1 porque los meses empiezan en 0
      const dia = String(fecha.getDate()).padStart(2, '0');
      return `${año}-${mes}-${dia}`;
    };

    const inicioFormateado = formatearFecha(inicioSemana);
    const finFormateado = formatearFecha(finSemana);
    return {
      inicioSemana: inicioFormateado,
      finSemana: finFormateado
    };
  }

  const semana = obtenerInicioYFinSemana();

  function inicializarGrafica(init, finish) {
    $.ajax({
      url: "api_estadisticas",
      type: "GET",
      data: { select: "filter_week", init: init, finish: finish },
      success: function (response) {
        console.log(response);
        let json = JSON.parse(response);

        let label = [];
        let values = [];

        for (const value of json.lista) {
          values.push(value.Ganancia);
          label.push(`Semana ${value.Semana}`);
        }

        const data = {
          labels: label,
          datasets: [
            {
              label: "Ganancias Semanales",
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

        // Si ya existe una instancia del gráfico, actualiza sus datos
        if (chartInstance) {
          chartInstance.data.labels = data.labels; // Actualiza las etiquetas
          chartInstance.data.datasets[0].data = data.datasets[0].data; // Actualiza los datos del primer conjunto
          chartInstance.update(); // Llama a update para redibujar el gráfico
        } else {
          // Crear una nueva instancia del gráfico si no existe
          chartInstance = new Chart("gananciasChartWeek", { type: "bar", data, options });
        }





      }
    });
  }
  let weakInit = document.getElementById('weekStart');
  let weakEnd = document.getElementById('weekEnd');

  // Inicializa la gráfica con la fecha predeterminada
  inicializarGrafica(semana.inicioSemana, semana.finSemana);

  document.getElementById('formPDF2-1').addEventListener('submit', function () {
    captureChart('gananciasChartWeek', 'imgGananciaWeek_png');
    weakInit.setAttribute("value", semana.inicioSemana);
    weakEnd.setAttribute("value", semana.finSemana);
  });

  let btnFilterWeek = document.querySelector(".btn-filter-week");
  btnFilterWeek.addEventListener("click", () => {
    // Obtén las fechas desde los campos de entrada
    let dateEnd = btnFilterWeek.previousElementSibling.value;
    let dateInit = btnFilterWeek.previousElementSibling.previousElementSibling.previousElementSibling.value;

    // Llama a la función para inicializar la gráfica con las nuevas fechas
    inicializarGrafica(dateInit, dateEnd);


    document.getElementById('formPDF2-1').addEventListener('submit', function () {
      captureChart('gananciasChartWeek', 'imgGananciaWeek_png');
      weakInit.setAttribute("value", dateInit);
      weakEnd.setAttribute("value", dateEnd);
    });
  });
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
                    borderColor: "#999",
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
              document.getElementById('formPDF3').addEventListener('submit', function () {
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
  let maxChart;
  let DATE = document.getElementById("date_enviroment")
  DATE.setAttribute("value", new Date().getFullYear() + '-' + (parseInt(new Date().getMonth()) + 1))


  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "filter_max_anio", year: new Date().getFullYear() },
    success: function (response) {
      let json = JSON.parse(response);
      let productos = []
      let ventas = [];
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

      if (!maxChart) {
        maxChart = new Chart("masVendidosChart", {
          type: "pie",
          data: data,
          options: options,
        });
      } else {
        // Actualizar el gráfico existente con nuevos datos
        maxChart.data.labels = label;
        maxChart.data.datasets[0].data = values;
        maxChart.update(); // Actualizar el gráfico
      }

      // let chart = new Chart("masVendidosChart", { type: "pie", data, options });


      // Capturar el gráfico cuando se envía el formulario
      document.getElementById('formPDF4').addEventListener('submit', function () {
        captureChart('masVendidosChart', 'imgMax_png');
      });

      let btn = document.querySelector(".filter-max")
      btn.addEventListener('click', function () {
        let value = btn.previousElementSibling.value
        let filterValue;
        let url = {};
        let filter_max_type = document.querySelectorAll(".filter-max-type")
        filter_max_type.forEach(element => {
          if (element.checked) {
            filterValue = element.value
          }
        })

        if (filterValue == "Año") {
          url = {
            select: "filter_max_anio",
            year: value.slice(0, 4),
          }
        } else {
          url = {
            select: "filter_max_mes-anio",
            year: value.slice(0, 4),
            month: value.slice(5, Infinity),
          }
        }

        $.ajax({
          url: "api_estadisticas",
          type: "GET",
          data: url,
          success: function (response) {
            let productos = []
            let ventas = [];
            let json = JSON.parse(response);
            for (const i of json.lista) {
              let nombre = i.nombre + " " + i.marca + " " + i.unidad_valor + " " + i.unidad
              let cantidad = i.cantidad == null ? 0 : i.cantidad
              productos.push(nombre)
              ventas.push(cantidad)
            }
            maxChart.data.labels = productos
            maxChart.data.datasets[0].data = ventas
            maxChart.update()
          }
        })

        document.getElementById('formPDF4').addEventListener('submit', function () {
          captureChart('masVendidosChart', 'imgMax_png');
          DATE.setAttribute("value", value)
        });
      })


    }
  })
};

// const renderModelsChart5 = () => {

//   let productos = []
//   let ventas = [];


//   $.ajax({
//     url: "api_estadisticas",
//     type: "GET",
//     data: { select: "min_ventas" },
//     success: function (response) {
//       let json = JSON.parse(response);
//       for (const i of json.lista) {
//         let nombre = i.nombre + " " + i.marca + " " + i.unidad_valor + " " + i.unidad
//         let cantidad = i.cantidad == null ? 0 : i.cantidad
//         productos.push(nombre)
//         ventas.push(cantidad)
//       }

//       const data = {
//         labels: productos,
//         datasets: [
//           {
//             label: "Ventas",
//             data: ventas,
//             backgroundColor: getDataColors2(),
//             borderColor: getDataColors2(),
//           },
//         ],
//       };

//       const options = {
//         plugins: {
//           legend: { position: "left" },
//         },
//       };

//       new Chart("menosVendidosChart", { type: "pie", data, options });

//       // Capturar el gráfico cuando se envía el formulario
//       document.getElementById('formPDF5').addEventListener('submit', function () {
//         captureChart('menosVendidosChart', 'imgMin_png');
//       });
//     }
//   })
// };

const renderModelsChart5 = () => {
  let minChart;
  let DATE = document.getElementById("date_enviroment_min")
  DATE.setAttribute("value", new Date().getFullYear() + '-' + (parseInt(new Date().getMonth()) + 1))

  $.ajax({
    url: "api_estadisticas",
    type: "GET",
    data: { select: "filter_min_anio", year: new Date().getFullYear() },
    success: function (response) {
      let json = JSON.parse(response);
      let productos = []
      let ventas = [];
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

      if (!minChart) {
        minChart = new Chart("menosVendidosChart", {
          type: "pie",
          data: data,
          options: options,
        });
      } else {
        // Actualizar el gráfico existente con nuevos datos
        minChart.data.labels = label;
        minChart.data.datasets[0].data = values;
        minChart.update(); // Actualizar el gráfico
      }

      // let chart = new Chart("masVendidosChart", { type: "pie", data, options });


      // Capturar el gráfico cuando se envía el formulario
      document.getElementById('formPDF5').addEventListener('submit', function () {
        captureChart('menosVendidosChart', 'imgMin_png');
      });

      let btn = document.querySelector(".filter-min")
      btn.addEventListener('click', function () {
        let value = btn.previousElementSibling.value
        let filterValue;
        let url = {};
        let filter_min_type = document.querySelectorAll(".filter-min-type")
        filter_min_type.forEach(element => {
          if (element.checked) {
            filterValue = element.value
          }
        })

        if (filterValue == "Año") {
          url = {
            select: "filter_min_anio",
            year: value.slice(0, 4),
          }
        } else {
          url = {
            select: "filter_min_mes-anio",
            year: value.slice(0, 4),
            month: value.slice(5, Infinity),
          }
        }

        $.ajax({
          url: "api_estadisticas",
          type: "GET",
          data: url,
          success: function (response) {
            let productos = []
            let ventas = [];
            let json = JSON.parse(response);
            for (const i of json.lista) {
              let nombre = i.nombre + " " + i.marca + " " + i.unidad_valor + " " + i.unidad
              let cantidad = i.cantidad == null ? 0 : i.cantidad
              productos.push(nombre)
              ventas.push(cantidad)
            }
            minChart.data.labels = productos
            minChart.data.datasets[0].data = ventas
            minChart.update()
          }
        })

        document.getElementById('formPDF5').addEventListener('submit', function () {
          captureChart('menosVendidosChart', 'imgMin_png');
          DATE.setAttribute("value", value)
        });
      })


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
