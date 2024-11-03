<?php
    namespace Shtechnologyx\Pt3\Model;

	class Backup {
        function insert(){
            date_default_timezone_set('America/Caracas');
            $backupFile = "src/Backups/" . $GLOBALS['db_name'] . '_' . date('Y-m-d_H-i') . '.sql';
            $command = "mysqldump -h " . $GLOBALS['db_host'] . " -u " . $GLOBALS['db_user'] . " " . $GLOBALS['db_name'] . " > $backupFile";
            $output = shell_exec($command . " 2>&1");

            if ($output === null) {
                return "Respaldo realizado con éxito";
            } else {
                return "Error al realizar el respaldo";
            }
        }

        function search($n=0,$limite=9, $order = "ASC"){
            $archivos = scandir("src/Backups");
            $archivos = array_diff($archivos, array('.', '..'));

            return  array_values($archivos);
        }

        function delete(){
            $arc = array();
            $directorio = 'src/Backups';
            $archivos = scandir($directorio);
            $archivos = array_diff($archivos, array('.', '..'));
            foreach ($archivos as $archivo) {
                if ($archivo !== '.' && $archivo !== '..') {
                    $rutaArchivo = $directorio . '/' . $archivo;
                    array_push($arc, $archivo);
                }
            }
            return $arc;
        }
        function COUNT(){
            $elementos = scandir("src/Backups");
            $archivos = array_diff($elementos, array('.', '..'));
            return count($archivos);
        }
	}
?>