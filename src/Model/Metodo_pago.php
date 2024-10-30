<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Metodo_pago extends Db_base{
        private $id;
        private $nombre;

        function __construct($id=null, $nombre=null){           
            $this->id = $id;
            $this->nombre = $nombre;
            Db_base::__construct();
            $this->tabla = "metodo_pago";
            $this->add_variables([
                "a.id" => $this->id,
                "a.nombre" => $this->nombre
            ]);
        }
        function desactivar(){
			$query = $this->conn->prepare('UPDATE metodo_pago SET active=0 WHERE id=:id');
			$query->bindParam(':id',$this->id);
			$query->execute();
        }
}

?>