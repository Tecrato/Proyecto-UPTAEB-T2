<?php
	class Registro_ventas extends DB {
        private $id;
        private $monto_final;
        private $metodo_pago;
        private $id_cliente;
        private $id_usuario;
        private $IVA;

        function __construct($id=null, $monto_final=null,$metodo_pago=null,$id_cliente=null,$id_usuario=null,$IVA=null){
            $this->id = $id;
            $this->monto_final = $monto_final;
            $this->metodo_pago = $metodo_pago;
            $this->id_cliente = $id_cliente;
            $this->id_usuario = $id_usuario;
            $this->IVA = $IVA;
            DB::__construct();

        }
		function search($n=0,$limite=9,$order='id ASC'){
			$query = "SELECT * FROM registro_ventas";

            if ($this->id != null){
                $query = $query." WHERE id=:id";
            }
            $n = $n*$limite;
			if ($this->id) {
				$query = $query . " WHERE id=:id";
			}
			$query = $query . " ORDER BY $order";
            $query = $query . " LIMIT :l OFFSET :n";


            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }

            $consulta->execute();
            return $consulta->fetchAll();
		}
		function agregar($datos){
			
			$query = $this->conn->prepare("INSERT INTO registro_ventas (monto_final,metodo_pago, id_cliente, id_usuario, IVA) VALUES(:monto, :metodo, :id1, :id2, :iva)");


			$query->bindParam(':monto',$this->monto_final);
			$query->bindParam(':metodo',$this->metodo_pago, PDO::PARAM_STR);
			$query->bindParam(':id1',$this->id_cliente, PDO::PARAM_INT);
			$query->bindParam(':id2',$this->id_usuario, PDO::PARAM_INT);
			$query->bindParam(':iva',$this->IVA, PDO::PARAM_STR);

			echo $this->IVA;

			$query->execute();
			
			$registro = $this->search(order:'id DESC')[0];

			for ($i=0; $i < count($datos); $i++) { 
				$lista = $datos[$i];
				$clase_f = new Factura(null,$registro['id'],$lista->id_product,$lista->cantidad,$lista->precio);
				$clase_f->agregar();
				$clase_l = new Entrada(null,$lista->id_product,cantidad:$lista->cantidad);
				$clase_l->descontar();
			}
		}

        function search_targeta_fact(){
            $query = "SELECT id, (SELECT nombre FROM clientes WHERE id = registro_ventas.id_cliente) AS cliente, monto_final, fecha FROM registro_ventas";
            return $this->conn->query($query)->fetchAll();
        }
	}
?>