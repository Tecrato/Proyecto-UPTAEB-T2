<?php
    use Shtechnologyx\Pt3\Model\Usuario;
    use Shtechnologyx\Pt3\Model\Bitacora;

    // print_r($_POST);

    if ($_POST['metodo'] == 'correo') {
        $correo = $_POST['correo'];

        $clase = new Usuario(correo:$correo);
        $id = $clase->search();

        $nueva_semilla = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 10);
        $nueva_semilla_encriptada = password_hash($nueva_semilla,PASSWORD_DEFAULT);

        $clase = new Usuario(id:$id[0]['id'],semilla:$nueva_semilla_encriptada);
        $clase->actualizar();

        $var = exec('"src/Controller/funcs_ajax/mandar_correo.py" "'.$correo.'" "Tu semilla para el sistema Minimarket es es: '.$nueva_semilla.'"');
        // var_dump($var);
        // var_dump('"src/Controller/funcs_ajax/mandar_correo.py" "'.$correo.'" "Tu semilla para el sistema Minimarket es es: '.$nueva_semilla.'"');
        if ($var == "listo") {
            $clase2 = new Bitacora(null,$row['id'],"Usuarios","Semilla enviada","Usuario ".$id[0]['nombre']." a solicitado una nueva semilla");
            $clase2->agregar();
        }
        echo json_encode(['status' => 'active', 'correo' => $correo, 'resultado' => $var]);
    } elseif ($_POST['metodo'] == 'semilla') {
        $clase = new Usuario(correo:$_POST['email']);
        $resultado = $clase->search();
        var_dump($resultado);
        $semilla = password_verify($_POST['semilla'],$resultado[0]['semilla']);
        if ($_POST['password'] == "" or $_POST['email'] == "" or $_POST['semilla'] == "") {
            echo json_encode(['status' => 'error','error'=>'Falta de datos']);
        }
        else if ($semilla == true) {
            $clave = $_POST['password'];
            $hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
            $clase2 = new Usuario(id:$resultado[0]['id'],hash:$hash);
            $clase2->actualizar();
            echo json_encode(['status' => 'active']);
        } else {
            echo json_encode(['status' => 'error','error'=>'Semilla incorrecta']);
        }
    }
?>
