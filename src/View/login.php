<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/LogReg.css">
    <link rel="stylesheet" href="static/css/uikit.css">
    <link rel="stylesheet" href="static/css/aos.css">
    <link rel="shortcut icon" href="static/images/logo_m.png" type="image/x-icon">
    <title>Iniciar Sesion</title>
</head>

<body>
    <section class="uk-light  sectionP">
        <section class="uk-flex uk-flex-center uk-flex-middle" style="height: 100%;">
            <article class="Item uk-flex-center uk-flex-middle Login" data-aos="zoom-in-up">
                <div class="Register">
                    <div class="uk-text-center">
                        <img src="static/images/logo_m.png" alt="" width="130px">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <form class="uk-grid-small" uk-grid action="Controller/funcs/login.php" method="POST">

                        <div class="uk-width-1-1@s uk-flex uk-flex-center">

                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" placeholder="Correo Electronico" type="email" aria-label="Not clickable icon" name="correo" pattern="([A-Za-z0-9\.]+)@([\w]{3,8})\.([\w]{2,3})(\.[\w]{2,4})?(\.[\w]{2,3})?" required>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-flex uk-flex-center">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input class="uk-input" placeholder="Contraseña" type="password" aria-label="Not clickable icon" name="contraseña" pattern="^[\w\S]{8,}$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-flex uk-flex-center">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: question"></span>
                                <input class="uk-input uk-form-blank" placeholder="Ingrese Codigo CAPTCHA" type="text" aria-label="Not clickable icon" name="codigo" required autocomplete="off">
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-flex uk-flex-middle uk-flex-column">
                            <label class="uk-form-label uk-margin-small-bottom" for="form-stacked-text">Codigo Captcha</label>
                            <div class="uk-width-1-1@s uk-flex uk-flex-middle uk-flex-center">
                                <img src="Controller/funcs/Captcha.php" alt="" width="150" id="img-codigo">
                                <button class="uk-icon-button uk-margin-small-left" uk-icon="refresh" type="button" id="regenera"></button>
                            </div>
                        </div>


                        <div class="uk-flex uk-flex-column uk-flex-middle uk-width-1-1@s">
                            <a class="uk-margin-small-bottom registerSystem">Registrarse</a>
                            <a class="uk-margin-small-bottom recuperarPass">¿Olvido su contraseña?</a>
                            <button class="uk-button uk-button-default uk-margin-small-top" type="submit">Ingresar</button>
                        </div>
                    </form>
                </div>
            </article>

            <article class="Item uk-flex-center uk-flex-middle SetPassword display-none">
                <div class="Register">
                    <div class="uk-text-center">
                        <img src="static/images/logo_m.png" alt="" width="130px">
                        <h3>Recuperar Contraseña</h3>
                    </div>
                    <div class="uk-flex uk-flex-column uk-flex-middle" method="POST">
                        <div class="uk-margin uk-flex uk-flex-column uk-flex-middle">
                            <div class="uk-inline uk-margin-small-bottom">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" placeholder="Correo Electronico" type="email" id="email" aria-label="Not clickable icon" name="correo" required>
                            </div>
                            <div class="uk-inline uk-margin-small-bottom">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" placeholder="Semilla de recuperación" type="text" id="semillaRecuperacion" aria-label="" name="semilla" required>
                            </div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" placeholder="Nueva Contraseña" type="text" id="newPassRecuperacion" aria-label="" name="password" required>
                            </div>
                        </div>
                    </div>
                    <!--     
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <textarea class="uk-textarea" placeholder="Asunto" name="" id="" cols="30" rows="5" required></textarea>
                            </div>
                        </div> -->
                    <div class="uk-flex uk-flex-center">
                        <div>
                            <button class="uk-button uk-button-default uk-margin-small-top" id="forget-pass" type="submit">ENVIAR</button>
                            <button class="uk-button uk-button-default uk-margin-small-top" id="cancel" type="submit">CANCELAR</button>
                        </div>
                    </div>
                </div>
                </div>
            </article>

            <article class="Item uk-flex-center uk-flex-middle SetRegister display-none">
                <div class="Register">
                    <div class="uk-text-center">
                        <img src="static/images/logo_m.png" alt="" width="130px">
                        <h3>Registrarse</h3>
                    </div>
                    <!-- <div class="uk-flex uk-flex-column uk-flex-middle" method="POST">
                        <div class="uk-margin uk-flex uk-flex-column uk-flex-middle">
                            <div class="uk-inline uk-margin-small-bottom">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" placeholder="Correo Electronico" type="email" id="email" aria-label="Not clickable icon" name="correo" required>
                            </div>
                            <div class="uk-inline uk-margin-small-bottom">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" placeholder="Semilla de recuperación" type="text" id="semillaRecuperacion" aria-label="" name="semilla" required>
                            </div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" placeholder="Nueva Contraseña" type="text" id="newPassRecuperacion" aria-label="" name="password" required>
                            </div>
                        </div>
                    </div> -->
                    <form id="formRegisterUser" class="uk-grid-small uk-flex-center" uk-grid>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-stacked-text">NOMBRE</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-stacked-text" type="text" placeholder="Nombre" name="nombre" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-2@s">
                            <label class="uk-form-label" for="form-stacked-text">APELLIDO</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-stacked-text" type="text" placeholder="Apellido" name="apellido" pattern="^([A-Zñ+áéó]|[a-zñáéó]){3,}( ([A-Zñ+áéó]|[a-zñáéó]){3,})?$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <label class="uk-form-label" for="form-stacked-text">CORREO</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="form-stacked-text" type="email" placeholder="Correo" name="correo" pattern="^([A-Za-z0-9\.\_]+)@([\w]{3,8})\.([\w]{2,3})(\.[\w]{2,4})?(\.[\w]{2,3})?$" required>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s">
                            <label class="uk-form-label" for="form-stacked-text">CONTRASEÑA</label>
                            <div class="uk-form-controls">
                                <div class="uk-inline">
                                    <a class="uk-form-icon controller_icon_eye uk-form-icon-flip" href="#" uk-icon="icon: eye"></a>
                                    <input class="uk-input valid-pass uk-form-width-large" id="form-stacked-text" type="password" placeholder="Contraseña" name="password" required>
                                </div>
                                <label class="uk-article-meta" id="msj" for=""></label>
                            </div>
                        </div>

                        <div class="uk-margin-top uk-flex uk-flex-center">
                            <div>
                                <button class="uk-button uk-button-default uk-margin-small-top" id="" type="submit">REGISTRARSE</button>
                                <button class="uk-button uk-button-default uk-margin-small-top" id="cancelRegister" type="button">CANCELAR</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
                </div>
            </article>
        </section>

    </section>

    <script src="static/javascript/librerias/uikit.js"></script>
    <script src="static/javascript/librerias/uikit-icons.js"></script>
    <script src="static/javascript/librerias/aos.js"></script>
    <script src="static/javascript/librerias/jquery.js"></script>
    <script src="static/javascript/Ajax/recuperaPass.js"></script>

    <script>
        AOS.init({
            easing: 'ease-in-out-sine',
            delay: 300
        });

        document.addEventListener('DOMContentLoaded', () => {
            const imgCodigo = document.getElementById('img-codigo');
            const btnGenera = document.getElementById('regenera');

            if (imgCodigo && btnGenera) {
                btnGenera.addEventListener('click', generaCodigo);
            }

            /**
             * Función que realiza una solicitud fetch para obtener una imagen generada.
             * La imagen se asigna dinámicamente a la propiedad 'src' de la imagen en el documento.
             */
            function generaCodigo() {
                let url = 'Controller/funcs/Captcha.php';

                fetch(url)
                    .then(response => response.blob())
                    .then(data => {
                        if (data) {
                            imgCodigo.src = URL.createObjectURL(data);
                        }
                    });
            }
        });
    </script>

</body>

</html>