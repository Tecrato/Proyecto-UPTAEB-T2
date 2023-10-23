<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("./funcs/verificar.php") ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/uikit.css">
    <link rel="stylesheet" href="static/css/Style.css">
    <script src="static/javaScript/uikit.js"></script>
    <script src="static/javaScript/uikit-icons.js"></script>
    <link rel="shortcut icon" href="static/images/logo_m.png" type="image/x-icon">
    <title>Inventario-Inicio</title>
</head>
<?php 
echo "
<script>var sesion_user = '".$_SESSION['usuario']."'</script>
<script>var sesionID = ".$_SESSION['id']."</script>

"
?>
<body class="Bg-Main-home">

           <!-- **********************************  Menu de PC (1024 en adelante)  ********************************** -->




 <!-- **********************************  Menu de usuario  ********************************** -->

<header class="Header-Pc">
    <nav class="Nav-bg uk-light Header">
        <div>
            <div uk-navbar class="uk-flex uk-flex-middle Nav-links">
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav ">
                        <li class="uk-flex uk-flex-middle">
                            <a href="inicio"><img src="static/images/Logo Minimarket 2.png" alt="" class="Nav-img uk-margin-medium-right"></a>
                            
                            <form action="" class="uk-flex uk-flex-middle ">
                                <input class="uk-input uk-margin-small-right uk-border-pill" type="text" placeholder="Buscar">
                                <button class="uk-button uk-button-link" type="submit">
                                    <span uk-icon="search"></span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <nav uk-dropnav="mode: click">
                        <ul class="uk-subnav uk-margin-remove">
                            <li>
                                <a class="uk-flex uk-flex-center uk-flex-middle" href="#">
                                    <span class="uk-badge">1</span>
                                    <span uk-icon="icon: bell; ratio: 1.5"></span>
                                    <span uk-drop-parent-icon></span>
                                </a>
                                <div class="uk-dropdown uk-padding-remove uk-border-rounded uk-light">
                                    <ul class="uk-nav uk-dropdown-nav uk-border-rounded">
                                        <li class="item_notification-header"><strong>Centro de Notificaciones</strong></li>
                                        <li>
                                            <a href="#" class="uk-flex Container_notify">
                                                <div>
                                                    <span class="uk-margin-small-right" uk-icon="icon: info; ratio: 2"></span>
                                                </div>
                                                <div>
                                                    <p class="uk-margin-remove date_notify">20/20/2000</p>
                                                    <p class="uk-margin-remove"><b>Datos de notificacion</b></p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>

                    <nav class="Nav1" uk-dropnav="mode: click">
                        <ul class="uk-subnav uk-margin-remove">
                            <li>
                                <a href="#">
                                    <!-- <span class="uk-icon uk-margin-small-right Bg-user" uk-icon="icon: user; ratio: 1.5"></span> -->
                                    <img class="uk-preserve-width uk-border-circle uk-margin-small-right" src="static/images/undraw_profile.svg" width="40" height="40" alt="">
                                    <p class="Link-nav"><?php echo $_SESSION['usuario']; ?></p>
                                </a>
                                <div class="uk-dropdown uk-border-rounded">
                                    <ul class="uk-nav uk-dropdown-nav ">
                                        <li class="uk-active"><a href="#"><?php echo $_SESSION['usuario']; ?></a></li>
                                        <li>
                                            <a class="uk-padding-remove-vertical" href="Administrar_perfil">
                                                <span class="uk-margin-small-right" uk-icon="cog"></span>
                                                <p>Administrar</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="uk-padding-remove-vertical" href="Salir">
                                                <span class="uk-margin-small-right" uk-icon="sign-out"></span>
                                                <p>Cerrar Sesión</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </nav>




       <!-- **********************************  Menu de modulos  ********************************** -->

    <nav class="uk-background-secondary uk-light"  uk-navbar>
        <div class="uk-navbar-left ">
            <ul class="uk-navbar-nav uk-margin-large-left">
                <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Inicio">
                    <a class="uk-button uk-button-text enlace_nav" href="Inicio">
                        <span uk-icon="thumbnails" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Productos">
                    <a class="uk-button uk-button-text enlace_nav" href="Productos">
                        <span uk-icon="product" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                        <p>Productos</p>
                    </a>
                </li>
                <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Proveedores">
                    <a class="uk-button uk-button-text enlace_nav" href="Proveedores">
                        <span uk-icon="bookmark" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                        <p>Proveedores</p>
                    </a>
                </li>
                <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Clientes">
                    <a class="uk-button uk-button-text enlace_nav" href="Clientes">
                        <span uk-icon="users" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                        <p>Clientes</p>
                    </a>
                </li>
                <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Estadisticas">
                    <a class="uk-button uk-button-text enlace_nav" href="Estadisticas">
                        <span uk-icon="statitics" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                        <p>Estadisticas</p>
                    </a>
                </li>
                <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Facturas">
                    <a class="uk-button uk-button-text enlace_nav" href="Facturas">
                        <span uk-icon="factura" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                        <p>Registro de ventas</p>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</header>


        <!-- **********************************  Menu responsive (1024 descendente)  ********************************** -->


<section class="Header-responsive">
    <nav class="Nav-bg-2 uk-light Header-2" uk-navbar>
        <div class="nav-overlay uk-navbar-left">
            <a href="incio">
                <img src="static/images/logo Minimarket 2.png" alt="" class="Nav-img-2 uk-margin-medium-right">
            </a>
        </div>

        <div class="nav-overlay uk-navbar-right" style="flex-wrap: nowrap !important">
            <a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
            <button id="btnOffCanvas" class="uk-button uk-button-link" type="button" uk-toggle="#offcanvas-nav">
                <span class="uk-margin-small-left uk-light" uk-icon="icon: menu; ratio: 2"></span>
            </button>
        </div>

        <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>
            <div class="uk-navbar-item uk-width-expand">
                <form class="uk-search uk-search-navbar uk-width-1-1">
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search" autofocus>
                </form>
            </div>
            <a class="uk-navbar-toggle" uk-close uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
        </div>
    </nav>

    <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-transparent uk-light; cls-inactive: uk-navbar-transparent uk-light">
        <nav class="uk-background-secondary uk-light uk-navbar-container navbar-container-responsive"  uk-navbar>
            <div class="uk-navbar-center">
                <ul class="uk-navbar-nav gap_nav">
                    <li class="Link">
                        <a class="uk-button uk-button-text" href="Inicio">
                            <span uk-icon="thumbnails" class="uk-icon uk-icon-button"></span>
                        </a>
                    </li>
                    <li class="Link">
                        <a class="uk-button uk-button-text" href="Productos">
                            <span uk-icon="product" class="uk-icon uk-icon-button"></span>
                        </a>
                    </li>
                    <li class="Link">
                        <a class="uk-button uk-button-text" href="Clientes">
                            <span uk-icon="users" class="uk-icon uk-icon-button"></span>
                        </a>
                    </li>
                    <li class="Link">
                        <a class="uk-button uk-button-text" href="Estadisticas">
                            <span uk-icon="bell" class="uk-icon uk-icon-button"></span>
                        </a>
                        
                    </li>
                    <li class="Link">
                        <a class="uk-button uk-button-text" href="Facturas">
                            <span uk-icon="factura" class="uk-icon uk-icon-button"></span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
    <div id="offcanvas-nav" uk-offcanvas="overlay: true">
        <div class="uk-offcanvas-bar">
            <ul class="uk-nav uk-nav-default">
                <li class="uk-active">
                    <a href="#">
                        <img class="uk-preserve-width uk-border-circle uk-margin-small-right" src="static/images/undraw_profile.svg" width="40" height="40" alt="">
                        <p><?php echo $_SESSION['usuario']; ?></p>
                    </a>
                </li>
                <li class="uk-parent">
                    <a href="#">Opciones</a>
                    <ul class="uk-nav-sub">
                        <li>
                            <a href="Administrar_perfil">
                                <span class="uk-margin-small-right" uk-icon="cog"></span>
                                <p>Administrar</p>
                            </a>
                        </li>
                        <li class="Link-subMenu">
                            <a href="Salir">
                                <span class="uk-margin-small-right" uk-icon="sign-out"></span>
                                <p>Salir</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <hr class="uk-divider-icon">

                <li class="uk-active Link-subMenu">
                    <a href="#">
                        <p>OTRAS OPCIONES</p>
                    </a>
                </li>
                <li class="Link Link-subMenu">
                    <a href="Proveedores">
                        <span class="uk-margin-small-right" uk-icon="icon: bookmark">
                            
                        </span>
                        <p>Proveedores</p>
                    </a>
                </li>
                <li class="Link Link-subMenu">
                    <a href="Estadisticas">
                        <span class="uk-margin-small-right" uk-icon="statitics"></span>
                        <p>Estadisticas</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>