<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;
	class Detalle_entrada extends Db_base {
        private $id;
        private $id_entrada;
        private $id_producto;
        private $mercancia;
        private $tamaño_mercancia;
        private $fecha_vencimiento;
        private $precio_compra;
        private $existencia;
        private $cantidad;
        private $between_fecha_compra;

        function __construct($id=null ,$id_entrada=null, $id_producto=null,$mercancia=null,$tamaño_mercancia=null,$fecha_vencimiento=null,$precio_compra=null,$existencia=1, $cantidad=1, $between_fecha_compra=null){
            $this->id = $id;
            $this->id_entrada = $id_entrada;
            $this->id_producto = $id_producto;
            $this->mercancia = $mercancia;
            $this->tamaño_mercancia = $tamaño_mercancia;
            $this->fecha_vencimiento = $fecha_vencimiento;
            $this->precio_compra = $precio_compra;
            $this->existencia = $existencia;
            $this->cantidad = $cantidad;
            $this->between_fecha_compra = $between_fecha_compra;
            Db_base::__construct();
            $this->tabla = "detalles_entradas";
            $this->add_variables([
                "a.id" => $this->id,
                "a.id_entrada" => $this->id_entrada,
                "a.id_producto" => $this->id_producto,
                "a.id_empaquetado" => $this->mercancia,
                "a.tamaño_mercancia" => $this->tamaño_mercancia,
                "a.fecha_vencimiento" => $this->fecha_vencimiento,
                "a.precio_compra" => $this->precio_compra,
                "a.cantidad" => $this->cantidad,
                "a.existencia" => $this->existencia
            ]);
            $this->add_variables_interval([
                "b.fecha_compra" => $this->between_fecha_compra,
            ]);
            $this->select_query = "
                b.id,
                p.razon_social as proveedor,
                b.fecha_compra,
                b.codigo,
                a.id_empaquetado,
                pr.nombre as producto,
                m.nombre as marca,
                pr.valor_unidad,
                u.nombre as unidad,
                c.nombre as categoria,
                a.fecha_vencimiento,
                a.precio_compra,
                a.tamaño_mercancia,
                a.cantidad,
                a.existencia
            ";
            $this->joins = "
                INNER JOIN entradas as b ON b.id = a.id_entrada
                INNER JOIN proveedores AS p ON b.id_proveedor = p.id
                INNER JOIN productos as pr ON a.id_producto = pr.id
                INNER JOIN marcas as m ON m.id = pr.id_marca
                INNER JOIN unidades as u ON u.id = pr.id_unidad
                INNER JOIN categoria as c ON c.id = pr.id_categoria
            ";
        }
        
		public function agregar() : int{
			$query = $this->conn->prepare("INSERT INTO detalles_entradas VALUES(null, :id1, :id_empaquetado, :tm, :precio_compra, :id2, :fecha_vencimiento, :cantidad, :existencia)");
            
            $query->bindParam(':id1',$this->id_producto, PDO::PARAM_INT);
            $query->bindParam(':id_empaquetado',$this->mercancia, PDO::PARAM_INT);
            $query->bindParam(':tm',$this->tamaño_mercancia, PDO::PARAM_INT);
            $query->bindParam(':precio_compra',$this->precio_compra, PDO::PARAM_INT);
            $query->bindParam(':id2',$this->id_entrada, PDO::PARAM_INT);
            $query->bindParam(':fecha_vencimiento',$this->fecha_vencimiento, PDO::PARAM_STR);
            $query->bindParam(':cantidad',$this->cantidad, PDO::PARAM_INT);
            $query->bindParam(':existencia',$this->existencia, PDO::PARAM_INT);
        
            $query->execute();
            return $this->conn->lastInsertId();
		}
		function descontar($cantidad){

			// $entradas = $this->search(0,10000,order:' fecha_vencimiento ASC');
            $entradas = $this->conn->query("SELECT * FROM detalles_entradas WHERE id_producto=$this->id_producto AND existencia > 0")->fetchAll();
            try {
                
                for ($i = 0; $cantidad >= 1; $i++) {
                    $entrada = $entradas[$i];
                    if ($entrada['existencia'] > $cantidad) {
                        $query = "UPDATE detalles_entradas SET existencia=" . $entrada['existencia'] - $cantidad . " WHERE id=" . $entrada['id'];
                        $this->conn->query($query);
                        $cantidad = 0;
                    } else {
                        $query = "UPDATE detalles_entradas SET existencia=0 WHERE id=" . $entrada['id'];
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
            
    }
