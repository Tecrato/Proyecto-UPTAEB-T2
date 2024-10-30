<?php
    namespace Shtechnologyx\Pt3\Model;

    class Producto extends Db_base{
        private $id;
        private $id_categoria;
        private $id_unidad;
        private $id_marca;
        private $valor_unidad;
        private $nombre;
        private $imagen;
        private $stock_min;
        private $stock_max;
        private $precio_venta;
        private $IVA;
        private $active;
        private $codigo;
        private $ganancia;
        private $algoritmo;
        private $like_nombre;

        function __construct($id=null, $id_categoria=null,$id_unidad=null,$id_marca=null,$valor_unidad=null,$nombre=null,
            $imagen=null,$stock_min=null,$stock_max=null,$precio_venta=null,$IVA=null,$codigo=null,$active=null,$algoritmo=null,
            $ganancia=null,$like_nombre=''){

            $this->id = $id;
            $this->id_categoria = $id_categoria;
            $this->id_unidad = $id_unidad;
            $this->id_marca = $id_marca;
            $this->valor_unidad = $valor_unidad;
            $this->nombre = $nombre;
            $this->imagen = $imagen;
            $this->stock_min = $stock_min;
            $this->stock_max = $stock_max;
            $this->precio_venta = $precio_venta;
            $this->IVA = $IVA;
            $this->active = $active;
            $this->ganancia = $ganancia;
            $this->codigo = $codigo;
            $this->algoritmo = $algoritmo;
            $this->like_nombre = $like_nombre;
            Db_base::__construct();
            $this->add_variables([
                "a.id"=> $this->id,
                "a.id_categoria"=> $this->id_categoria,
                "a.id_unidad"=> $this->id_unidad,
                "a.id_marca"=> $this->id_marca,
                "a.valor_unidad"=> $this->valor_unidad,
                "a.nombre"=> $this->nombre,
                "a.imagen"=> $this->imagen,
                "a.stock_min"=> $this->stock_min,
                "a.stock_max"=> $this->stock_max,
                "a.precio_venta"=> $this->precio_venta,
                "a.IVA"=> $this->IVA,
                "a.ganancia" => $this->ganancia,
                "a.codigo"=> $this->codigo,
                "a.active"=> $this->active,
                "a.algoritmo"=> $this->algoritmo,
                "a.ganancia" => $this->ganancia,
            ]);
            $this->add_variables_like([
                "a.nombre" => $this->like_nombre
            ]);
            $this->tabla = 'productos';
            $this->select_query = "
                a.id,
                a.id_categoria,
                b.nombre categoria,
                a.id_unidad,
                c.nombre unidad,
                a.nombre,
                a.id_marca,
                m.nombre marca,
                a.valor_unidad,
                a.imagen,
                (SELECT SUM(detalles_entradas.existencia) FROM detalles_entradas Where id_producto = a.id AND detalles_entradas.fecha_vencimiento > NOW()) as stock,
                a.stock_min,
                a.stock_max,
                a.precio_venta,
                a.IVA,
                a.codigo,
                a.active
            ";
            $this->joins = '
                INNER JOIN categoria b ON b.id = a.id_categoria 
                INNER JOIN unidades c ON c.id = a.id_unidad
                INNER JOIN marcas m ON m.id = a.id_marca
            ';
            // $this->select_query = "a.id, a.id_categoria, a.id_unidad, a.id_marca, a.valor_unidad, a.nombre, a.imagen, a.stock_min, a.stock_max, a.precio_venta, a.IVA, a.active, c.nombre AS categoria, u.nombre AS unidad, m.nombre AS marca, (SELECT SUM(e.cantidad) FROM detalles_entradas e WHERE e.id_producto = a.id) AS stock";
        }

        function set_id($id){
            $this->id = $id;
            $this->add_variables([
                "id" => $this->id
            ]);
        }

        function set_id_categoria($id_categoria){
            $this->id_categoria = $id_categoria;
            $this->add_variables([
                "id_categoria" => $this->id_categoria
            ]);
        }

        function set_id_unidad($id_unidad){
            $this->id_unidad = $id_unidad;
            $this->add_variables([
                "id_unidad" => $this->id_unidad
            ]);
        }

        function set_id_marca($id_marca){
            $this->id_marca = $id_marca;
            $this->add_variables([
                "id_marca" => $this->id_marca
            ]);
        }

        function set_valor_unidad($valor_unidad){
            $this->valor_unidad = $valor_unidad;
            $this->add_variables([
                "valor_unidad" => $this->valor_unidad
            ]);
        }

        function set_nombre($nombre){
            $this->nombre = $nombre;
            $this->add_variables([
                "nombre" => $this->nombre
            ]);
        }

        function set_imagen($imagen){
            $this->imagen = $imagen;
            $this->add_variables([
                "imagen" => $this->imagen
            ]);
        }

        function set_stock_min($stock_min){
            $this->stock_min = $stock_min;
            $this->add_variables([
                "stock_min" => $this->stock_min
            ]);
        }

        function set_stock_max($stock_max){
            $this->stock_max = $stock_max;
            $this->add_variables([
                "stock_max" => $this->stock_max
            ]);
        }

        function set_precio_venta($precio_venta){
            $this->precio_venta = $precio_venta;
            $this->add_variables([
                "precio_venta" => $this->precio_venta
            ]);
        }

        function set_IVA($IVA){
            $this->IVA = $IVA;
            $this->add_variables([
                "IVA" => $this->IVA
            ]);
        }

        function set_active($active){
            $this->active = $active;
            $this->add_variables([
                "active" => $this->active
            ]);
        }

        function set_codigo($codigo){
            $this->codigo = $codigo;
            $this->add_variables([
                "codigo" => $this->codigo
            ]);
        }

        function set_algoritmo($algoritmo){
            $this->algoritmo = $algoritmo;
            $this->add_variables([
                "algoritmo" => $this->algoritmo
            ]);
        }

        function get_id(){
            return $this->id;
            
        }

        function get_id_categoria(){
            return $this->id_categoria;
        }

        function get_id_unidad(){
            return $this->id_unidad;
        }

        function get_id_marca(){
            return $this->id_marca;
        }

        function get_valor_unidad(){
            return $this->valor_unidad;
        }

        function get_nombre(){
            return $this->nombre;
        }

        function get_imagen(){
            return $this->imagen;
        }

        function get_stock_min(){
            return $this->stock_min;
        }

        function get_stock_max(){
            return $this->stock_max;
        }

        function get_precio_venta(){
            return $this->precio_venta;
        }

        function get_IVA(){
            return $this->IVA;
        }

        function get_codigo(){
            return $this->codigo;
        }

        function get_algoritmo(){
            return $this->algoritmo;
        }
        
        function search_inventario(){
            $query = "SELECT id,nombre,(SELECT SUM(cantidad) FROM entradas WHERE productos.id = id_producto) AS entradas,(SELECT SUM(cantidad) - (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) FROM entradas WHERE productos.id = id_producto) AS salidas, (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) AS existencia, precio_venta,(SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) * precio_venta AS Total FROM productos WHERE active = 1";
            return $this->conn->query($query)->fetchAll();
        }
        function toggle_active() {
			$query = $this->conn->prepare('UPDATE productos SET active=(NOT active) WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
        }
    }
?>