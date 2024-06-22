let show = false;
document.getElementById('Tooltip-help').addEventListener("click", function(event) {
    if (show == false) {
        show = true;
        introJs().refresh()
        introJs().setOptions({
            exitOnOverlayClick: false,
            disableInteraction: true,
            nextLabel: 'Siguiente',
            prevLabel: 'Anterior',
            doneLabel: 'Hecho',
            'steps': [{
                    'element': document.getElementById('iconNotification'),
                    'title': 'Centro de Notificaciones.',
                    'intro': 'Aqui puede visualizar las notificaciones del sistema.',
                    'position': 'auto'
                },
                {
                    'element': document.getElementById('iconSets'),
                    'intro': 'Administrar/Cierre de sesión.',
                    'position': 'auto'
                },
                {
                    'element': document.getElementById('tasaDolar'),
                    'intro': 'Estado de la caja/Tasa del Dolar del día.',
                    'position': 'auto'
                },
                {
                    'element': document.getElementById('linkInicio'),
                    'title': 'Sección de Inicio.',
                    'intro': 'Sección del sistema donde se visualizan datos de interés.',
                    'position': 'auto'
                }
            ]
        }).start();
        introJs().setOptions({
            'hintButtonLabel': 'Ok',
            'hints': [
                // NAV
                {
                    'element': document.getElementById('linkProductos'),
                    'hint': 'Sección del sistema donde se gestionan los productos y datos relacionados con ellos.'
                },
                {
                    'element': document.getElementById('linkProveedores'),
                    'hint': 'Sección del sistema donde se gestionan los proveedores.'
                },
                {
                    'element': document.getElementById('linkClientes'),
                    'hint': 'Sección del sistema donde se gestionan los clientes.'
                },
                {
                    'element': document.getElementById('linkVentas'),
                    'hint': 'Sección del sistema donde se gestionan las ventas y datos relacionados con ellas.'
                },
                {
                    'element': document.getElementById('linkEstadisticas'),
                    'hint': 'Sección del sistema donde se visualizan las Estadisticas del MiniMarket.'
                },
                //PRODUCTOS
                {
                    'element': document.getElementById('aProductos'),
                    'hint': 'Sección de los productos activos en el sistema.'
                },
                {
                    'element': document.getElementById('aEntradas'),
                    'hint': 'Gestión de entradas de productos al sistema.'
                },
                {
                    'element': document.getElementById('aOtros'),
                    'hint': 'Gestión de otros datos del sistema(Marcas, Unidades & Categorías).'
                },
                {
                    'element': document.getElementById('aProductsDesct'),
                    'hint': 'Gestión de productos inhabilitados del sistema.'
                },
                {
                    'element': document.getElementById('formSearch'),
                    'hint': 'Buscador de productos activos.'
                },
                {
                    'element': document.getElementById('iconReportInv'),
                    'hint': 'Generar reporte de Inventario.'
                },
                {
                    'element': document.getElementById('registerProduct'),
                    'hint': 'Registrar nuevo producto.'
                },
                {
                    'element': document.getElementById('productFilterAll'),
                    'hint': 'Mostrar todos los productos activos.'
                },
                {
                    'element': document.getElementById('productFilterCategory'),
                    'hint': 'Filtrar productos activos por su categoria.'
                },
                {
                    'element': document.getElementById('productFilterMarca'),
                    'hint': 'Filtrar productos activos por su marca.'
                },
                {
                    'element': document.getElementById('SupplierFilterAll'),
                    'hint': 'Filtrar las entradas de los proveedores registrados.'
                },
                {
                    'element': document.getElementById('SupplierFilterOne'),
                    'hint': 'Filtrar las entradas de un proveedor en especifico.'
                },
                {
                    'element': document.getElementById('SupplierFilterProducts'),
                    'hint': 'Filtrar las entradas de un producto en especifico.'
                },
                {
                    'element': document.getElementById('entrada'),
                    'hint': 'Buscador de entradas.'
                },
                {
                    'element': document.getElementById('liMarcas'),
                    'hint': 'Gestión de Marcas.'
                },
                {
                    'element': document.getElementById('liUnidades'),
                    'hint': 'Gestión de Unidades.'
                },
                {
                    'element': document.getElementById('liCategorias'),
                    'hint': 'Gestión de Categorias.'
                },
                {
                    'element': document.getElementById('SearchProductsOff'),
                    'hint': 'Buscador de productos inhabilitados.'
                },
                {
                    'element': document.getElementById('productOffFilterAll'),
                    'hint': 'Mostrar todos los productos inhabilitados.'
                },
                {
                    'element': document.getElementById('productOffFilterCategory'),
                    'hint': 'Filtrar productos inhabilitados por su categoria.'
                },
                {
                    'element': document.getElementById('productOffFilterMarca'),
                    'hint': 'Filtrar productos inhabilitados por su marca.'
                },
                //PROVEEDORES
                {
                    'element': document.getElementById('SearchSupplier'),
                    'hint': 'Buscador de los proovedores.'
                },
                {
                    'element': document.getElementById('registerSupplier'),
                    'hint': 'Registrar nuevo proveedor.'
                },
                //CLIENTES
                {
                    'element': document.getElementById('SearchCustomer'),
                    'hint': 'Buscador de los clientes.'
                },
                {
                    'element': document.getElementById('registerCustomer'),
                    'hint': 'Registrar nuevo cliente.'
                },
                //ESTADISTICAS
                {
                    'element': document.getElementById('inventoryValue'),
                    'hint': 'Estadistica del valor total del inventario según categoría.'
                },
                {
                    'element': document.getElementById('monthlyEntries'),
                    'hint': 'Estadistica de las entradas mensuales.'
                },
                {
                    'element': document.getElementById('inventoryRotation'),
                    'hint': 'Estadistica de la Rotación del inventario mensual.'
                },
                {
                    'element': document.getElementById('MostSelledProducts'),
                    'hint': 'Estadistica de los Productos más vendidos.'
                },
                {
                    'element': document.getElementById('LeastSelledProducts'),
                    'hint': 'Estadistica de los Productos menos vendidos.'
                },
                //REGISTRO DE VENTAS
                {
                    'element': document.getElementById('FACTURA'),
                    'hint': 'Gestión de Facturas.'
                },
                {
                    'element': document.getElementById('billSearch'),
                    'hint': 'Buscador de las facturas registradas.'
                },
                {
                    'element': document.getElementById('iconReportBills'),
                    'hint': 'Reporte de Facturas.'
                },
                {
                    'element': document.getElementById('registerBill'),
                    'hint': 'Registrar nueva Facturas.'
                },
                {
                    'element': document.getElementById('billsFilterDate'),
                    'hint': 'Filtras facturas por fecha.'
                },
                {
                    'element': document.getElementById('CREDITO'),
                    'hint': 'Gestión de Facturas a crédito.'
                },
                {
                    'element': document.getElementById('CAJA'),
                    'hint': 'Gestión de Caja.'
                },
                {
                    'element': document.getElementById('LeastSelledProducts'),
                    'hint': 'Estadistica de los Productos menos vendidos.'
                },
                //PERFIL
                {
                    'element': document.getElementById('aUser'),
                    'hint': 'Gestión de usuarios.'
                },
                {
                    'element': document.getElementById('aBinnacle'),
                    'hint': 'Visualizar Registro de actividades en el sistema'
                },
                {
                    'element': document.getElementById('aCapital'),
                    'hint': 'Gestión de Capital de la empresa.'
                },
                {
                    'element': document.getElementById('aSets'),
                    'hint': 'Ajustes del Sistema.'
                },
                {
                    'element': document.getElementById('btnRegisterUser'),
                    'hint': 'Registrar nuevo usuario en el sistema.'
                },
                {
                    'element': document.getElementById('seedGenerator'),
                    'hint': 'Semilla para recuperar contraseña. Esta debe almacenarse en un lugar seguro'
                },
                {
                    'element': document.getElementById('tableUsers'),
                    'hint': 'Tabla de los usuarios registrados en el sistema'
                },
            ]
        }).addHints().start()
        
    } else {
        introJs().hideHints();
        introJs().exit();
        introJs().refresh()
        show = false;
    }
});