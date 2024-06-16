<?php
    
    class Producto extends DB{
        private $id;
        private $id_categoria;
        private $id_unidades;
        private $id_marcas;
        private $valor_unidad;
        private $nombre;
        private $imagen;
        private $stock_min;
        private $stock_max;
        private $precio_venta;
        private $IVA;
        private $active;
        private $like;

        function __construct($id=null, $id_categoria=null,$id_unidades=null,$id_marcas=null,$valor_unidad=null,$nombre=null,
            $imagen=null,$stock_min=null,$stock_max=null,$precio_venta=null,$IVA=null,$active=1,$like=''){

            $this->id = $id;
            $this->id_categoria = $id_categoria;
            $this->id_unidades = $id_unidades;
            $this->id_marcas = $id_marcas;
            $this->valor_unidad = $valor_unidad;
            $this->nombre = $nombre;
            $this->imagen = $imagen;
            $this->stock_min = $stock_min;
            $this->stock_max = $stock_max;
            $this->precio_venta = $precio_venta;
            $this->IVA = $IVA;
            $this->active = $active;
            $this->like = $like;
            DB::__construct();

        }
        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar(){
            
            $query = $this->conn->prepare("INSERT INTO productos VALUES(null, :id_categoria, :id_unidades, :id_marcas, :valor_unidad, :nombre, :imagen, :stock_min, :stock_max, :precio_venta, :IVA, 1)");

            $query->bindParam(':id_categoria',$this->id_categoria);
            $query->bindParam(':id_unidades',$this->id_unidades);
            $query->bindParam(':id_marcas',$this->id_marcas);
            $query->bindParam(':valor_unidad',$this->valor_unidad);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':imagen',$this->imagen);
            $query->bindParam(':stock_min',$this->stock_min);
            $query->bindParam(':stock_max',$this->stock_max);
            $query->bindParam(':precio_venta',$this->precio_venta);
            $query->bindParam(':IVA',$this->IVA);


            return $query->execute();
        }


        // con esta funcion se elimina un elemento dependiendo de su id
        function toggle_active() {
			$query = $this->conn->prepare('UPDATE productos SET active=(NOT active) WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
        }
        function borrar() {
			$query = $this->conn->prepare('DELETE FROM productos WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
        }


        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function actualizar(){
            
            
            $query = "UPDATE productos SET id_categoria=:id_categoria, id_unidad=:id_unidades, id_marca=:id_marcas, valor_unidad=:valor_unidad, nombre=:nombre, stock_min=:stock_min, stock_max=:stock_max, precio_venta=:precio_venta, IVA=:IVA";
            if ($this->imagen != null) {
                $query = $query . ", imagen=:imagen ";
            }
            $query = $query . " WHERE id=:id";
            
            $query = $this->conn->prepare($query);

            $query->bindParam(':id_categoria',$this->id_categoria);
            $query->bindParam(':id_unidades',$this->id_unidades);
            $query->bindParam(':id_marcas',$this->id_marcas);
            $query->bindParam(':valor_unidad',$this->valor_unidad);
            $query->bindParam(':nombre',$this->nombre);
            // $query->bindParam(':marca',$this->marca);
            $query->bindParam(':stock_min',$this->stock_min);
            $query->bindParam(':stock_max',$this->stock_max);
            $query->bindParam(':precio_venta',$this->precio_venta);
            $query->bindParam(':IVA',$this->IVA);
            if ($this->imagen != null) {
                $query->bindParam(':imagen',$this->imagen);
            }
            $query->bindParam(':id',$this->id);

            return $query->execute();
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT 
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
                    (SELECT SUM(entradas.existencia) FROM entradas Where id_producto = a.id AND entradas.fecha_vencimiento > NOW()) as stock,
                    a.stock_min,
                    a.stock_max,
                    a.precio_venta,
                    a.IVA
                    FROM productos a 
                    INNER JOIN categoria b ON b.id = a.id_categoria 
                    INNER JOIN unidades c ON c.id = a.id_unidad
                    INNER JOIN marcas m ON m.id = a.id_marca
                    WHERE a.nombre LIKE :como AND
                    active=:active ";

                    
			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_marcas){
                array_push($lista, 'marca');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND a.'.$e.'=:'.$e;
            	}
            }

            $n = $n*$limite;

            $query = $query . " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':active',$this->active, PDO::PARAM_INT);
            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            $this->like = '%'.$this->like.'%';
            $consulta->bindParam(':como',$this->like, PDO::PARAM_STR);
			if ($this->id_marcas) {
                $consulta->bindParam(':marca',$this->id_marcas, PDO::PARAM_INT);
			}

            $consulta->execute();
            return $consulta->fetchAll();
        }

        function search_marca() {
            $query = $this->conn->prepare("SELECT marca FROM productos GROUP BY marca");
            $query->execute();
            return $query->fetchAll();
            
        }

        function search_inventario(){
            $query = "SELECT id,nombre,(SELECT SUM(cantidad) FROM entradas WHERE productos.id = id_producto) AS entradas,(SELECT SUM(cantidad) - (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) FROM entradas WHERE productos.id = id_producto) AS salidas, (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) AS existencia, precio_venta,(SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) * precio_venta AS Total FROM productos WHERE active = 1";
            return $this->conn->query($query)->fetchAll();
        }

        function search_ValorInventario(){
            $query = "SELECT SUM((SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) * precio_venta) AS Total FROM productos";

            return $this->conn->query($query)->fetchAll();
        }

        function stock_segun_categorias()  {
            $query = "SELECT c.nombre, SUM(e.existencia) AS 'maximo_stock'
                FROM categoria c
                JOIN productos p ON c.id = p.id_categoria
                JOIN entradas e ON p.id = e.id_producto
                GROUP BY c.id";
            $query = $this->conn->prepare($query);
            $query->execute();
            return $query->fetchAll();
        }

        function search_RecienAgregado() {
            $query = $this->conn->prepare("SELECT * FROM productos
            WHERE active = 1
            ORDER BY id DESC
            LIMIT 5;");
            $query->execute();
            return $query->fetchAll();
            
        }
        function search_MasVendidos() {
            $query = $this->conn->prepare("SELECT p.nombre, SUM(f.cantidad) as total_vendido
            FROM factura f
            JOIN productos p ON f.id_productos = p.id
            GROUP BY f.id_productos
            ORDER BY total_vendido DESC
            LIMIT 3;");
            $query->execute();
            return $query->fetchAll();
            
        }
        function search_MenosVendidos() {
            $query = $this->conn->prepare("SELECT p.nombre, SUM(f.cantidad) as total_vendido
            FROM factura f
            JOIN productos p ON f.id_productos = p.id
            GROUP BY f.id_productos
            ORDER BY total_vendido ASC
            LIMIT 3;");
            $query->execute();
            return $query->fetchAll();
            
        }

        function COUNT(){
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM productos WHERE active=:active");
			$query->bindParam(':active',$this->active, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['total'];
        }
    }
?>