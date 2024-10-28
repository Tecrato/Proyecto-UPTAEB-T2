<?php
    namespace Shtechnologyx\Pt3\Model;

	class DB {
        function insert(){
            require_once "Controller/variables.php";
            date_default_timezone_set('America/Caracas');
            $backupFile = "Backups/" . $this->dbName . '_' . date('Y-m-d_H-i') . '.sql';
            $command = "mysqldump -h $this->dbHost -u $this->dbUser $this->dbName > $backupFile";
            $output = shell_exec($command . " 2>&1");

            if ($output === null) {
                return "Respaldo realizado con éxito";
            } else {
                return "Error al realizar el respaldo";
            }
        }

        function search($n=0,$limite=9){
            return  $archivos = scandir("Backups");
        }

        function delete(){
            $arc = array();
            $directorio = 'Backups';
            $archivos = scandir($directorio);

            foreach ($archivos as $archivo) {
                if ($archivo !== '.' && $archivo !== '..') {
                    $rutaArchivo = $directorio . '/' . $archivo;
                    array_push($arc, $archivo);
                }
            }
            return $arc;
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM backups")->fetch()['total'];
        }
	}
?>