<?php
	class Factura extends DB {
        private $id;
        private $id_registro_ventas;
        private $id_productos;
        private $cantidad;
        private $coste_producto_total;

        function __construct($id=null, $id_registro_ventas=null,$id_productos=null,$cantidad=null,$coste_producto_total=null){
            $this->id = $id;
            $this->id_registro_ventas = $id_registro_ventas;
            $this->id_productos = $id_productos;
            $this->cantidad = $cantidad;
            $this->coste_producto_total = $coste_producto_total;
            DB::__construct();

        }
		function search($id=null,$order='id DESC'){
			$query = "SELECT * FROM factura";
			if ($this->id) {
				$query = $query . " WHERE id=:id";
			}
			$query = $query . " ORDER BY $order";

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }

            $consulta->execute();
            return $consulta->fetchAll();
		}

		function agregar(){
            $query = $this->conn->prepare("INSERT INTO factura VALUES(null, ?, ?, ?, ?)");

            $query->bindParam(1,$this->id_registro_ventas);
            $query->bindParam(2,$this->id_productos);
            $query->bindParam(3,$this->cantidad);
            $query->bindParam(4,$this->coste_producto_total);
            
            $query->execute();
		}
        function borrar() {
            if ($this->id_registro){
                $query = $this->conn->prepare("DELETE FROM lotes WHERE id_registro_ventas=:id_registro");
                $query->bindParam(':id_registro',$this->id_registro_ventas);
            }
            else {
            	throw new Exception("Error, debe pasar el id del registro asociado", 1);
            	
            }
            
            $query->execute($query);
        }
	}

?>