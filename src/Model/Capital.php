<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

	class Capital extends Db_base {

		private $id;
		private $monto;
        private $descripcion;

		function __construct($id=null, $descripcion=null, $monto=null){
			$this->id = $id;
			$this->monto = $monto;
            $this->descripcion = $descripcion;
            Db_base::__construct();
            $this->tabla = "movimientos_capital";
            $this->add_variables([
                "id" => $this->id,
                "monto" => $this->monto,
                "descripcion" => $this->descripcion,
            ]);
		}

        function detallesCapital(){
            $query = $this->conn->prepare('SELECT * FROM detalles_capital');
            $query->execute();
            return $query->fetchAll();

        }
    }
?>