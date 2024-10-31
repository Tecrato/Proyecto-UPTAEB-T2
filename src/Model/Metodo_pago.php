<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Metodo_pago extends Db_base{
        private $id;
        private $nombre;
        private $like;

        function __construct($id=null, $nombre=null, $like=null){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->like = $like;
            Db_base::__construct();
            $this->tabla = "metodo_pago";
            $this->add_variables([
                "a.id" => $this->id,
                "a.nombre" => $this->nombre
            ]);
            $this->add_variables_like([
                "a.nombre" => $this->like
            ]);
        }
        function desactivar(){
			$query = $this->conn->prepare('UPDATE metodo_pago SET active=0 WHERE id=:id');
			$query->bindValue(':id',$this->id);
			$query->execute();
        }
}

?>