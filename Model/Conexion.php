<?php
class DB
{

    public $dbHost = 'localhost';
    public $dbUser = 'root';
    public $dbName = 'proyecto_4';
    public $dbPass = '12345';

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
    function add_bitacora($usuario, $tabla, $accion, $detalles)
    {
        $query = 'INSERT INTO bitacora(id_usuario,tabla,accion,detalles) VALUES(:usu,:ta,:acc,:de)';
        $query = $this->conn->prepare($query);
        $query->bindParam(':usu', $usuario);
        $query->bindParam(':ta', $tabla);
        $query->bindParam(':acc', $accion);
        $query->bindParam(':de', $detalles);
        $query->execute();
    }
    function search_bitacora($id = null, $limite = 9, $n = 0, $order = " id DESC")
    {
        $query = "SELECT
                    b.id,
                    (SELECT nombre FROM usuarios WHERE usuarios.id = b.id_usuario) as nombre,
                    b.tabla,
                    b.accion,
                    b.fecha,
                    b.detalles
                    FROM bitacora b
                    INNER JOIN usuarios u ON b.id_usuario = u.id";
        if ($id != null) {
            $query .= " WHERE id_usuario=:id";
        }

        $n = $n * $limite;

        $query .= " ORDER BY " . $order;
        $query .= " LIMIT :l OFFSET :n";

        $consulta = $this->conn->prepare($query);
        if ($id != null) {
            $consulta->bindParam(":id", $id, PDO::PARAM_INT);
        }
        $consulta->bindParam(':l', $limite, PDO::PARAM_INT);
        $consulta->bindParam(':n', $n, PDO::PARAM_INT);

        $consulta->execute();
        return $consulta->fetchAll();
    }
    function COUNT()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM bitacora");
        $query->execute();
        return $query->fetch()['total'];
    }
    function COUNT_user($user)
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM bitacora WHERE id_usuario=:id");
        $query->bindParam(":id", $user, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch()['total'];
    }

    function Backup($type)
    {
        if ($type == "Insert") {
            date_default_timezone_set('America/Caracas');
            $backupFile = "../../Backups/" . $this->dbName . '_' . date('Y-m-d_H-i') . '.sql';
            $command = "mysqldump --opt -h " . $this->dbHost . " -u " . $this->dbUser . " -p" . $this->dbPass . " " . $this->dbName . " > " . $backupFile;
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
