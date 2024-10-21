<?php
	class Detalle_entrada extends DB{
        private $id;
        private $id_entrada;
        private $id_producto;
        private $mercancia;
        private $tamaño_mercancia;
        private $fecha_vencimiento;
        private $precio_compra;
        private $existencia;
        private $cantidad;

        function __construct($id=null ,$id_entrada=null, $id_producto=null,$mercancia=null,$tamaño_mercancia=null,$fecha_vencimiento=null,$precio_compra=null,$existencia=1, $cantidad=1){
            $this->id = $id;
            $this->id_entrada = $id_entrada;
            $this->id_producto = $id_producto;
            $this->mercancia = $mercancia;
            $this->tamaño_mercancia = $tamaño_mercancia;
            $this->fecha_vencimiento = $fecha_vencimiento;
            $this->precio_compra = $precio_compra;
            $this->existencia = $existencia;
            $this->cantidad = $cantidad;
            DB::__construct();
        }

		function agregar($transaccion = false){
            echo "iniciando agregar";
			$query = $this->conn->prepare("INSERT INTO entradas_2 VALUES(null, :id1, :mercancia, :tm, :precio_compra, :id2, :fecha_vencimiento, :cantidad, :existencia)");
            
            $query->bindParam(':id1',$this->id_producto, PDO::PARAM_INT);
            $query->bindParam(':mercancia',$this->mercancia, PDO::PARAM_INT);
            $query->bindParam(':tm',$this->tamaño_mercancia, PDO::PARAM_INT);
            $query->bindParam(':precio_compra',$this->precio_compra, PDO::PARAM_INT);
            $query->bindParam(':id2',$this->id_entrada, PDO::PARAM_INT);
            $query->bindParam(':fecha_vencimiento',$this->fecha_vencimiento, PDO::PARAM_STR);
            $query->bindParam(':cantidad',$this->cantidad, PDO::PARAM_INT);
            $query->bindParam(':existencia',$this->existencia, PDO::PARAM_INT);
            
            echo "terminando agregar";
            if ($transaccion) {
                $query->execute();
            }
            echo "terminando execute agregar";

            return $this->conn->lastInsertId();
		}

		function descontar($cantidad){

			$entradas = $this->search(0,10000,order:' fecha_vencimiento ASC');
            try {
                
                for ($i = 0; $cantidad >= 1; $i++) {
                    $entrada = $entradas[$i];
                    if ($entrada['existencia'] > $cantidad) {
                        $query = "UPDATE entradas_2 SET existencia=" . $entrada['existencia'] - $cantidad . " WHERE id=" . $entrada['id'];
                        $this->conn->query($query);
                        $cantidad = 0;
                    } else {
                        $query = "UPDATE entradas_2 SET existencia=0 WHERE id=" . $entrada['id'];
                        $this->conn->query($query);
                        $cantidad -= $entrada['existencia'];
                    }
                }
                return 1;
            }
            catch (Exception $e){
                return 0;
            }
		}

		function borrar() {
			$query = $this->conn->prepare('DELETE FROM entradas WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
		}

		function search($n=0,$limite=9, $order = ' id ASC '){
            $query = "SELECT 
                    a.id,
                    a.id_producto,
                    b.nombre producto,
                    a.mercancia,
                    c.razon_social proveedor,
                    a.tamaño_mercancia,
                    a.fecha_compra,
                    a.fecha_vencimiento,
                    a.precio_compra,
                    a.existencia
                    FROM entradas_2 a 
                    INNER JOIN productos b ON b.id = a.id_producto
                    INNER JOIN proveedores c ON c.id = a.mercancia
                    WHERE a.existencia=:existencia AND b.existencia=1";

			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_producto){
                array_push($lista, 'id_producto');
            }
            if ($this->mercancia){
                array_push($lista, 'mercancia');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND '.$e.'=:'.$e;
            	}
            }


            $n = $n*$limite;
			$query = $query . " ORDER BY $order ";
			$query = $query . " LIMIT :l OFFSET :n ";


            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            $consulta->bindParam(':existencia',$this->existencia, PDO::PARAM_INT);

            if ($this->id){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
			if ($this->id_producto) {
                $consulta->bindParam(':id_producto',$this->id_producto, PDO::PARAM_INT);
			}
			if ($this->mercancia) {
                $consulta->bindParam(':mercancia',$this->mercancia, PDO::PARAM_INT);
			}

            $consulta->execute();
            return $consulta->fetchAll();
		}
        function COUNT(){
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM entradas WHERE existencia=:existencia");
			$query->bindParam(':existencia',$this->existencia, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['total'];
        }
}
