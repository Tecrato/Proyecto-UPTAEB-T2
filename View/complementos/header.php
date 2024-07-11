<!DOCTYPE html>
<html lang="es" style="background-color: #111;" id="html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/MainInformation.css">
    </link>
    <link rel="stylesheet" href="Plugins/build/css/intlTelInput.css">
    </link>
    <link rel="stylesheet" href="static/css/loader.css">
    <link rel="stylesheet" href="static/css/uikit.css">
    <link rel="stylesheet" href="static/css/Style.css">
    <link rel="stylesheet" href="static/css/dataTables.css">
    <link rel="stylesheet" href="static/css/responsive.dataTables.css">
    <link rel="stylesheet" href="static/css/introjs.min.css">
    <link rel="stylesheet" href="static/css/introjs-modern.css">
    <script src="static/javascript/librerias/jquery.js"></script>
    <script src="static/javascript/librerias/intro.min.js"></script>
    <script src="static/javascript/Tooltip-help.js" defer></script>
    <script src="static/javascript/librerias/uikit.js"></script>
    <script src="static/javascript/librerias/uikit-icons.js"></script>
    <script src="static/javascript/FuncionesGenerales.js" defer></script>
    <script src="static/javascript/Ajax/notification.js"defer></script>
    <script src="static/javascript/Color.js" defer></script>
    <link rel="shortcut icon" href="static/images/logo_m.png" type="image/x-icon">
    <title id="title">Inventario-Inicio</title>
</head>
<?php
echo "
<script>var session_user_name = '" . $_SESSION['user_name'] . "'</script>
<script>const session_user_id = " . $_SESSION['user_id'] . "</script>
<script>const session_user_rol = '" . $_SESSION['rol'] . "'</script>
<script>const session_user_rol_num = '" . $_SESSION['rol_num'] . "'</script>
"
?>
<?php require("../View/complementos/loader.php"); ?>
<body class="Bg-Main-home controller-modal">

    <!-- **********************************  Menu de PC (1024 en adelante)  ********************************** -->




    <!-- **********************************  Menu de usuario  ********************************** -->

    <header class="Header-Pc">
        <nav class="Nav-bg uk-light Header">
            <div>
                <div uk-navbar class="uk-flex uk-flex-middle Nav-links">
                    <div class="uk-navbar-left">
                        <ul class="uk-navbar-nav ">
                            <li class="uk-flex uk-flex-middle">
                                <a href="Inicio"><img src="static/images/Logo Minimarket 2.png" alt="" class="Nav-img uk-margin-medium-right"></a>

                                <!-- <form action="" class="uk-flex uk-flex-middle formSearchHeader">
                                    <input class="uk-input uk-margin-small-right uk-border-pill" type="text" placeholder="Buscar">
                                    <button class="uk-button uk-button-link" type="submit">
                                        <span uk-icon="search"></span>
                                    </button>
                                </form> -->
                            </li>
                        </ul>
                    </div>
                    <div class="uk-navbar-right">
                        <nav id="iconNotification" class="iconNotification" uk-dropnav="mode: click">
                            <ul class="uk-subnav uk-margin-remove">
                                <li>
                                    <a class="uk-flex uk-flex-center uk-flex-middle messi" href="#">
                                        <span class="uk-badge"></span>
                                        <span uk-icon="icon: bell; ratio: 1.5" id="btn_notify"></span>
                                        <span uk-drop-parent-icon></span>
                                    </a>
                                    <div class="uk-dropdown uk-padding-remove uk-border-rounded uk-light">
                                        <ul class="uk-nav uk-dropdown-nav uk-border-rounded">
                                            <div>
                                                <li class="item_notification-header"><strong>Centro de Notificaciones</strong></li>
                                            </div>
                                            <div class="cont_notify">
                                                <li>
                                                    <a href="#" class="uk-flex Container_notify">
                                                        <div>
                                                            <span class="uk-margin-small-right" style="color: #333;" uk-icon="icon: info; ratio: 2"></span>
                                                        </div>
                                                        <div>
                                                            <p class="uk-margin-remove date_notify" style="color: #888;">20/20/2000</p>
                                                            <p class="uk-margin-remove" style="color: #888;"><b>Datos de notificacion</b></p>
                                                        </div>
                                                    </a>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>

                        <span id="Tooltip-help" uk-icon="icon: question; ratio: 1.5" style="cursor: pointer;"></span>

                        <nav class="Nav1" uk-dropnav="mode: click">
                            <ul class="uk-subnav uk-margin-remove">
                                <li id="iconSets">
                                    <a href="#">
                                        <!-- <span class="uk-icon uk-margin-small-right Bg-user" uk-icon="icon: user; ratio: 1.5"></span> -->
                                        <img class="uk-preserve-width uk-border-circle uk-margin-small-right" src="static/images/undraw_profile.svg" width="40" height="40" alt="">
                                        <p class="Link-nav"><?php echo $_SESSION['user_name']; ?></p>
                                    </a>
                                    <div class="uk-dropdown uk-border-rounded">
                                        <ul class="uk-nav uk-dropdown-nav ">
                                            <li class="uk-active uk-flex uk-flex-middle uk-flex-between">
                                                <a href="#"><?php echo $_SESSION['user_name']; ?></a>

                                                <div class="theme-switch">
                                                    <input type="checkbox" id="theme-checkbox" />
                                                    <label for="theme-checkbox">
                                                        <div></div>
                                                        <span>
                                                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                                <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </span>
                                                        <span>
                                                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                                <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"></path>
                                                            </svg>
                                                        </span>
                                                    </label>
                                                </div>

                                                <!-- <span class="btn-ModeColorView" uk-icon="icon: sun; ratio: 1.5"></span>
                                                <span class="btn-ModeColorView2 invisible" uk-icon="icon: moon; ratio: 1.5"></span> -->
                                            </li>
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


        <div class="dolar">
            <marquee id="tasaDolar" behavior="alternative" direction="right" scrollamount="12" style="padding-top: 8px;width: 99%;">
                <div class="uk-flex uk-flex-middle">
                    <div class="uk-flex uk-flex-middle uk-margin-medium-right">
                        <span class="uk-light uk-margin-small-right" uk-icon="icon: bag; ratio: 1.3"></span>
                        <h5 class="uk-text-bolder uk-margin-remove" style="color: #fff;">CAJA: <span id="check_box">mmgvo</span></h5>
                    </div>
                    <div class="uk-margin-medium-right uk-flex uk-flex-middle">
                        <img class="uk-margin-small-right" src="static/images/bcv.png" alt="" width="28px" height="25px">
                        <h5 class="uk-text-bolder uk-margin-remove" style="color: #fff;">BCV: <span id="BCV">35.85</span> BS</h5>
                    </div>
                </div>
            </marquee>
        </div>

        <!-- **********************************  Menu de modulos  ********************************** -->

        <nav class="uk-background-secondary uk-light" uk-navbar>
            <div class="uk-navbar-left ">
                <ul class="uk-navbar-nav uk-margin-large-left">
                    <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Inicio">
                        <a id="linkInicio" class="uk-button uk-button-text enlace_nav" href="Inicio">
                            <span uk-icon="thumbnails" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Productos">
                        <a id="linkProductos" class="uk-button uk-button-text enlace_nav" href="Productos">
                            <span uk-icon="product" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                            <p>Productos</p>
                        </a>
                    </li>
                    <?php if ($_SESSION['rol_num'] <= 2) { ?>

                        <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Proveedores">
                            <a id="linkProveedores" class="uk-button uk-button-text enlace_nav" href="Proveedores">
                                <span uk-icon="bookmark" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                                <p>Proveedores</p>
                            </a>
                        </li>
                    <?php }; ?>
                    <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Clientes">
                        <a id="linkClientes" class="uk-button uk-button-text enlace_nav" href="Clientes">
                            <span uk-icon="users" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                            <p>Clientes</p>
                        </a>
                    </li>
                    <?php if ($_SESSION['rol_num'] <= 2) { ?>
                        <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Estadisticas">
                            <a id="linkEstadisticas" class="uk-button uk-button-text enlace_nav" href="Estadisticas">
                                <span uk-icon="statitics" class="uk-icon uk-margin-small-right uk-icon-button"></span>
                                <p>Estadisticas</p>
                            </a>
                        </li>
                    <?php }; ?>

                    <li class="uk-margin-small-right Link" href="/Proyecto-UPTAEB-T2/Ventas">
                        <a id="linkVentas" class="uk-button uk-button-text enlace_nav" href="Ventas">
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
                <a href="Inicio">
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
            <nav class="uk-background-secondary uk-light uk-navbar-container navbar-container-responsive" uk-navbar>
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
                            <a class="uk-button uk-button-text" href="Ventas">
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
                    <li class="uk-active uk-flex uk-flex-middle uk-flex-between">
                        <a href="#">
                            <img class="uk-preserve-width uk-border-circle uk-margin-small-right" src="static/images/undraw_profile.svg" width="40" height="40" alt="">
                            <p><?php echo $_SESSION['user_name']; ?></p>
                        </a>
                        <div class="uk-overflow-hidden btn-ModeColorView2">
                            <img class="iconMoon2" src="static/images/moon-solid.svg" alt="" width="18px">
                        </div>
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
                    <li>
                        <hr class="uk-divider-icon">
                    </li>

                    <li class="uk-active Link-subMenu">
                        <a href="#">
                            <p>OTRAS OPCIONES</p>
                        </a>
                    </li>
                    <li class="Link Link-subMenu">
                        <a href="Proveedores">
                            <span class="uk-margin-small-right" uk-icon="icon: bookmark"></span>
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