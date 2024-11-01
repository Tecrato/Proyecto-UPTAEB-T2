<?php
    include('View/login.php');
    if (isset($_GET['err'])) {
        if ($_GET['err'] == '1'){
            echo '<script>
                        UIkit.notification({
                            message:
                            "<span uk-icon=\'icon: close\'></span>Usuario o contraseña incorrecto",
                            status: "danger",
                            pos: "bottom-right",
                        });
                </script>';
        }
        else if ($_GET['err'] == '2') {
            echo '<script>
                        UIkit.notification({
                            message:
                            "<span uk-icon=\'icon: close\'></span>Codigo inválido.",
                            status: "danger",
                            pos: "bottom-right",
                        });
                </script>';
        }
        else if ($_GET['err'] == '2') {
            echo '<script>
                        UIkit.notification({
                            message:
                            "<span uk-icon=\'icon: close\'></span>Session ya iniciada.",
                            status: "danger",
                            pos: "bottom-right",
                        });
                </script>';
        }
    }
?>