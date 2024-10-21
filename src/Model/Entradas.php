<?php
	class Entrada extends DB{
        private $id;
        private $id_proveedor;
        private $fecha_compra;
        private $codigo;
        private $detalles;

        function __construct($id=null, $id_proveedor=null,$fecha_compra=null,$codigo=null,$detalles=null){
            $this->id = $id;
            $this->id_proveedor = $id_proveedor;
            $this->fecha_compra = $fecha_compra;
            $this->codigo = $codigo;
            $this->detalles = $detalles;
            DB::__construct();
        }

		function agregar($lista){
            try {
                $this->conn->beginTransaction();
                echo "123123";
                $query = $this->conn->prepare("INSERT INTO entradas
                (id, id_proveedor, fecha_compra, codigo, detalles)
                VALUES(null, :id_proveedor, :fecha_compra, :codigo, :detalles)");
    
                $query->bindParam(':id_proveedor',$this->id_proveedor, PDO::PARAM_INT);
                $query->bindParam(':fecha_compra',$this->fecha_compra, PDO::PARAM_STR);
                $query->bindParam(':codigo',$this->codigo, PDO::PARAM_INT);
                $query->bindParam(':detalles',$this->detalles, PDO::PARAM_STR);


                $query->execute();
                $last_id = $this->conn->lastInsertId();

                echo "123123";
                
                for ($i = 0; $i < count($lista); $i++) {
                    $entrada = $lista[$i];

                    echo "<br> <h1> entrada $i</h1>";
                    print_r($entrada);
                    echo "<br>";
                    $clase = new Detalle_entrada(
                        null,
                        $last_id,
                        $entrada->id_producto,
                        $entrada->mercancia,
                        $entrada->t_mercancia,
                        $entrada->fecha_vencimiento,
                        $entrada->precio_compra,
                        $entrada->t_mercancia  * $entrada->cantidad_mercancia, 
                        $entrada->cantidad_mercancia
                    );
                    $clase->agregar();
                    echo "<br> <h1> entrada $i terminada</h1>";
                    print_r($entrada);
                }
                $this->conn->commit();
                return 1;
            } catch (Exception $e) {
                print_r($e);
                $this->conn->rollBack();
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
                    a.id_proveedor,
                    b.nombre proveedor,
                    a.fecha_compra,
                    a.codigo,
                    a.detalles
                    FROM entradas a 
                    INNER JOIN proveedores b ON b.id = a.id_proveedor
                    WHERE a.existencia=:existencia";

			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_proveedor){
                array_push($lista, 'id_proveedor');
            }
            if ($this->fecha_compra){
                array_push($lista, 'fecha_compra');
            }
            if ($this->codigo){
                array_push($lista, 'codigo');
            }
            if ($this->detalles){
                array_push($lista, 'detalles');
            }

            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND '.$e.'=:'.$e;
            	}
            }

			if ($this->id){
                $query .= ' AND a.id=:id';
			}
			$query = $query . " ORDER BY $order ";
			$query = $query . " LIMIT :l OFFSET :n ";


            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);

            if ($this->id){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
			if ($this->id_proveedor) {
                $consulta->bindParam(':id_proveedor',$this->id_proveedor, PDO::PARAM_INT);
			}
			if ($this->fecha_compra) {
                $consulta->bindParam(':fecha_compra',$this->fecha_compra, PDO::PARAM_STR);
			}
			if ($this->codigo) {
                $consulta->bindParam(':codigo',$this->codigo, PDO::PARAM_STR);
			}
			if ($this->detalles) {
                $consulta->bindParam(':detalles',$this->detalles, PDO::PARAM_STR);
			}

            $consulta->execute();
            return $consulta->fetchAll();
		}
        function COUNT(){
            $sql = "SELECT COUNT(*) as 'total' FROM entradas WHERE 1 ";
            if ($this->id){
                $sql .= " AND id=:id";
            }
            if ($this->id_proveedor){
                $sql .= " AND id_proveedor=:id_proveedor";
            }
            if ($this->fecha_compra){
                $sql .= " AND fecha_compra=:fecha_compra";
            }
            if ($this->codigo){
                $sql .= " AND codigo=:codigo";
            }

            $query = $this->conn->prepare($sql);

            if ($this->id) {
                $query->bindParam(":id", $this->id, PDO::PARAM_INT);
            }
            if ($this->id_proveedor) {
                $query->bindParam(":id_proveedor", $this->id_proveedor, PDO::PARAM_INT);
            }
            if ($this->fecha_compra) {
                $query->bindParam(":fecha_compra", $this->fecha_compra, PDO::PARAM_STR);
            }
            if ($this->codigo) {
                $query->bindParam(":codigo", $this->codigo, PDO::PARAM_STR);
            }
            
            $query->execute();
            return $query->fetch()['total'];
        }
}