<?php
    class Producto extends DB{
        private $id;
        private $categoria;
        private $unidades;
        private $nombre;
        private $marca;
        private $imagen;
        private $stock_min;
        private $stock_max;
        private $precio_venta;
        private $IVA;
        private $like;

        function __construct(
            $id=null, $categoria=null,$unidades=null,$nombre=null,$marca=null,$imagen=null,$stock_min=null,
            $stock_max=null,$precio_venta=null,$IVA=null,$like=''){
            $this->id = $id;
            $this->categoria = $categoria;
            $this->unidades = $unidades;
            $this->nombre = $nombre;
            $this->marca = $marca;
            $this->imagen = $imagen;
            $this->stock_min = $stock_min;
            $this->stock_max = $stock_max;
            $this->precio_venta = $precio_venta;
            $this->IVA = $IVA;
            $this->like = $like;
            DB::__construct();

        }
        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar(){
            
            $query = $this->conn->prepare("INSERT INTO productos VALUES(null, :categoria, :unidades, :nombre, :marca, :imagen, :stock_min, :stock_max, :precio_venta, :IVA, 1)");

            $query->bindParam(':categoria',$this->categoria);
            $query->bindParam(':unidades',$this->unidades);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':marca',$this->marca);
            $query->bindParam(':imagen',$this->imagen);
            $query->bindParam(':stock_min',$this->stock_min);
            $query->bindParam(':stock_max',$this->stock_max);
            $query->bindParam(':precio_venta',$this->precio_venta);
            $query->bindParam(':IVA',$this->IVA);


            $query->execute();
        }


        // con esta funcion se elimina un elemento dependiendo de su id
        function borrar_logicamente() {
			$query = $this->conn->prepare('UPDATE productos SET active=0 WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function actualizar(){
            
            
            $query = "UPDATE productos SET id_categoria=:categoria, id_unidad=:unidades, nombre=:nombre, marca=:marca, stock_min=:stock_min, stock_max=:stock_max, precio_venta=:precio_venta, IVA=:IVA";
            if ($this->imagen != null) {
                $query = $query . ", imagen=:imagen ";
            }
            $query = $query . " WHERE id=:id";
            
            $query = $this->conn->prepare($query);

            $query->bindParam(':categoria',$this->categoria);
            $query->bindParam(':unidades',$this->unidades);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':marca',$this->marca);
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
                    b.nombre categoria,
                    c.nombre unidad,
                    a.nombre,
                    a.marca,
                    a.imagen,
                    (SELECT SUM(entradas.existencia) FROM entradas Where id_producto = a.id) as stock,
                    a.stock_min,
                    a.stock_max,
                    a.precio_venta,
                    a.IVA
                    FROM productos a 
                    INNER JOIN categoria b ON b.id = a.id_categoria 
                    INNER JOIN unidades c ON c.id = a.id_unidad
                    WHERE a.nombre LIKE :como AND
                    active=1 ";

                    
			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->marca){
                array_push($lista, 'marca');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND a.'.$e.'=:'.$e;
            	}
            }

            // if ($this->id != null){
            //     $query = $query." WHERE a.id=:id";
            // }
            $n = $n*$limite;

            $query = $query . " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            $this->like = '%'.$this->like.'%';
            $consulta->bindParam(':como',$this->like, PDO::PARAM_STR);
			if ($this->marca) {
                $consulta->bindParam(':marca',$this->marca, PDO::PARAM_INT);
			}

            $consulta->execute();
            return $consulta->fetchAll();
        }

        function search_marca() {
            $query = $this->conn->prepare("SELECT marca FROM productos GROUP BY marca");
            $query->execute();
            return $query->fetchAll();
            
        }

        function search_like(String $nombre){
            $query = $this->conn->prepare("SELECT * FROM productos WHERE active=1 and nombre LIKE '%$nombre%'");
            // $query->bindParam(':aaa',$nombre);
            $query->execute();
            return $query->fetchAll();
        }



        function search_inventario(){
            $query = "SELECT id,nombre,(SELECT SUM(cantidad) FROM entradas WHERE productos.id = id_producto) AS entradas,(SELECT SUM(cantidad) - (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) FROM entradas WHERE productos.id = id_producto) AS salidas, (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) AS existencia, precio_venta,(SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) * precio_venta AS Total FROM productos";
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
            LIMIT 10;");
            $query->execute();
            return $query->fetchAll();
            
        }
        function search_MasVendidos() {
            $query = $this->conn->prepare("SELECT p.nombre, SUM(f.cantidad) as total_vendido
            FROM factura f
            JOIN productos p ON f.id_productos = p.id
            GROUP BY f.id_productos
            ORDER BY total_vendido DESC;");
            $query->execute();
            return $query->fetchAll();
            
        }
        function search_MenosVendidos() {
            $query = $this->conn->prepare("SELECT p.nombre, SUM(f.cantidad) as total_vendido
            FROM factura f
            JOIN productos p ON f.id_productos = p.id
            GROUP BY f.id_productos
            ORDER BY total_vendido ASC;");
            $query->execute();
            return $query->fetchAll();
            
        }

        function COUNT(){
            
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM productos")->fetch()['total'];
        }
    }
?>