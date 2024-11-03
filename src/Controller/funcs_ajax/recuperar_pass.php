<?php
    use Shtechnologyx\Pt3\Model\Usuario;

    print_r($_POST);

    if ($_POST['metodo'] == 'correo') {
        $correo = $_POST['correo'];

        $clase = new Usuario(correo:$correo);
        $id = $clase->search()[0]['id'];

        $nueva_semilla = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 10);
        $nueva_semilla_encriptada = password_hash($nueva_semilla,PASSWORD_DEFAULT);

        $clase = new Usuario(id:$id,semilla:$nueva_semilla_encriptada);
        $clase->actualizar();

        print_r(is_file("./Controller/funcs_ajax/mandar_correo.py"));
        $var = exec('"./Controller/funcs_ajax/mandar_correo.py" "'.$correo.'" "Tu semilla para el sistema Minimarket es es: '.$nueva_semilla.'"');
        var_dump($var);
        var_dump('"./Controller/funcs_ajax/mandar_correo.py" "'.$correo.'" "Tu semilla para el sistema Minimarket es es: '.$nueva_semilla.'"');
        echo json_encode(['status' => 'active']);
    } elseif ($_POST['metodo'] == 'semilla') {
        $clase = new Usuario(semilla:$_POST['semilla'],correo:$_POST['email']);
        if ($_POST['password'] == "" or $_POST['email'] == "" or $_POST['semilla'] == "") {
            echo json_encode(['status' => 'error','error'=>'Falta de datos']);

        }
        else if (count($clase->search()) >0) {
            $clave = $_POST['password'];
            $hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
            $clase2 = new Usuario(correo:$_POST['email'],hash:$hash);
            $clase2->cambiar_password();
            echo json_encode(['status' => 'active']);
        } else {
            echo json_encode(['status' => 'error','error'=>'Semilla incorrecta']);
        }
    }
?>
