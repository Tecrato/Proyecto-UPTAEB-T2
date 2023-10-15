Chart.defaults.color = '#fff'
Chart.defaults.borderColor = '#444'

const getDataColors = opacity => {
    const colors = ['#7448c2', '#21c0d7', '#d99e2b', '#cd3a81', '#9c99cc', '#e14eca', '#ffffff', '#ff0000', '#d6ff00', '#0038ff']
    return colors.map(color => opacity ? `${color + opacity}` : color)
}


const printChart = () => {
    renderModelsChart1();
    renderModelsChart2();
    renderModelsChart3();
    renderModelsChart4();
    renderModelsChart5();
}

const renderModelsChart1 = () => {
    // const data = {
    //     labels: ['Charcuteria', 'Cesta Basica', 'Aseo Personal'],
    //     datasets: [{
    //         label:'Valor del inventario',
    //         data: [5000, 4000, 3000, 2000],
    //         backgroundColor: ['rgb(0, 156, 0)', 'rgb(255, 100, 0)', 'rgb(85, 0, 150)'],
    //         borderColor: ['#fff', '#fff', '#fff']
    //     }]
    // }


    const data = {
        labels: ['Valor del inventario'],
        datasets: [{
            label:'Charcuteria',
            data: [90],
            backgroundColor: getDataColors(80)[0],
            borderColor: getDataColors()[0],
            borderWidth: 3
        }, {
            label:'Cesta Basica',
            data: [60],
            backgroundColor: getDataColors(80)[1],
            borderColor: getDataColors()[1],
            borderWidth: 3
        },
        {
            label:'Aseo Personal',
            data: [30,10],
            backgroundColor: getDataColors(80)[2],
            borderColor: getDataColors()[2],
            borderWidth: 3 
        }]
    }
    new Chart('inventoryChart', { type: 'bar', data})
}
   




const renderModelsChart2 = () => {

    let gananciasMensuales = [5000, 6000, 4500, 7000, 5500, 8000];

    const data = {
        labels: ['Enero', 'Febrero', 'Marzo','Abril', 'Mayo', 'Junio'],
        datasets: [{
            label:'Ganacias mensuales',
            data: gananciasMensuales,
            backgroundColor: getDataColors(80)[1],
            fill: true,
            borderColor: getDataColors()[1],
            pointBorderWidth: 5
        }]
    }

    const options = {
        plugins: {
            legend: { display: false }
        }
    }
    new Chart('gananciasChart', { type: 'line', data, options})
}






const renderModelsChart3 = () => {

    let gananciasMensuales = [1000, 1500, 1200, 1800, 2000, 1700];

    const data = {
        labels: ['Enero', 'Febrero', 'Marzo','Abril', 'Mayo', 'Junio'],
        datasets: [{
            label:'Costo de productos vendidos',
            data: gananciasMensuales,
            borderColor: '#fff',
            fill: false,
            pointBorderWidth: 5
        }, {
            label:'Valor promedio del inventario',
            data: [500, 600, 550, 700, 800, 750],
            borderColor: 'rgb(1, 166, 203)',
            fill: false,
            pointBorderWidth: 5
        }]
    }
    new Chart('inventoryRotationChart', { type: 'line', data})
}





const renderModelsChart4 = () => {
    //Datos de ejemplo nose

    let productos = ["Harina Pan", "Mantequilla Deline 500g", "Pasta Mary 1kg", "Azúcar La Pastora 1kg", "Harina Kaly"];
    let ventas = [150, 200, 100, 50, 75];

    //Obtener los indices de los productos ordenados de mayor a menor

    let indicesMasVendidos = ventas.map((valor, indice) => indice).sort((a,b) => ventas[b] - ventas[a]);



    
    //Obtener los indices de los productos ordenados de menor a mayor

    let indicesMenosVendidos = ventas.map((valor, indice) => indice).sort((a,b) => ventas[a] - ventas[b]);


    //obtener nombres
    let productosMasVendidos = indicesMasVendidos.map(indice => productos[indice]);
    let productosMenosVendidos = indicesMenosVendidos.map(indice => productos[indice]);

    const data = {
        labels: productosMasVendidos,
        datasets: [{
            label:'ventas',
            data: indicesMasVendidos.map(indice => ventas[indice]),
            backgroundColor: getDataColors(80),
            borderColor: getDataColors()
        }]
    }

    const options = {
        plugins: {
            legend: { position: 'left' }
        }
    }

    new Chart('masVendidosChart', { type: 'doughnut', data, options})
}



const renderModelsChart5 = () => {
    //Datos de ejemplo nose

    let productos = ["Leche La Campiña 500g", "Arroz 500g", "Pasta Mary 500kg", "Refresco Glup 1.5L", "Sardina 250g"];
    let ventas = [150, 200, 100, 50, 75];

    //Obtener los indices de los productos ordenados de mayor a menor
    let indicesMasVendidos = ventas.map((valor, indice) => indice).sort((a,b) => ventas[b] - ventas[a]);

    //Obtener los indices de los productos ordenados de menor a mayor
    let indicesMenosVendidos = ventas.map((valor, indice) => indice).sort((a,b) => ventas[a] - ventas[b]);


    //obtener nombres
    let productosMasVendidos = indicesMasVendidos.map(indice => productos[indice]);
    let productosMenosVendidos = indicesMenosVendidos.map(indice => productos[indice]);

    const data = {
        
        labels: productosMenosVendidos,
        datasets: [{
            label:'ventas',
            data: indicesMenosVendidos.map(indice => ventas[indice]),
            backgroundColor: getDataColors(80),
            borderColor: getDataColors()
        }]
    }

    const options = {
        plugins: {
            legend: { position: 'left' }
        }
    }

    new Chart('menosVendidosChart', { type: 'doughnut', data, options })
}

printChart();
