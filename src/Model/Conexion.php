<?php
class DB
{

    public $dbHost = 'localhost';
    public $dbUser = 'root';
    public $dbName = 'proyecto_ciego';
    public $dbPass = '';

    public $conn;
    function __construct()
    {
        $this->conn = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function __destruct()
    {
        $this->conn = null;
    }

    function Backup($type)
    {
        if ($type == "Insert") {
            date_default_timezone_set('America/Caracas');
            $backupFile = "../../Backups/" . $this->dbName . '_' . date('Y-m-d_H-i') . '.sql';
            $command = "mysqldump -h $this->dbHost -u $this->dbUser $this->dbName > $backupFile";
            $output = shell_exec($command . " 2>&1");

            if ($output === null) {
                return "Respaldo realizado con éxito";
            } else {
                return "Error al realizar el respaldo";
            }
        } else if ($type == "Search") {
            $directorio = '../../Backups';
            return  $archivos = scandir($directorio);
        } else if ($type == "Delete") {
            $arc = array();
            $directorio = '../../Backups';
            $archivos = scandir($directorio);

            foreach ($archivos as $archivo) {
                if ($archivo !== '.' && $archivo !== '..') {
                    $rutaArchivo = $directorio . '/' . $archivo;
                    array_push($arc, $archivo);
                }
            }
            return $arc;
        }
    }
}
