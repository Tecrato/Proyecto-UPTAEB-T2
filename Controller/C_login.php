<?php
    include('../View/login.html');
    if (isset($_GET['err'])) {
        echo '<script>
                    UIkit.notification({
                        message:
                        "<span uk-icon=\'icon: close\'></span>Usuario o contraseña incorrecto",
                        status: "danger",
                        pos: "bottom-right",
                    });
            </script>';
    }
?>