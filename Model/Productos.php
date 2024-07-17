<?php
    
    class Producto extends DB{
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
        private $algoritmo;
        private $like;

        function __construct($id=null, $id_categoria=null,$id_unidad=null,$id_marca=null,$valor_unidad=null,$nombre=null,
            $imagen=null,$stock_min=null,$stock_max=null,$precio_venta=null,$IVA=null,$codigo=null,$active=null,$algoritmo=1,$like=''){

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
            $this->codigo = $codigo;
            $this->algoritmo = $algoritmo;
            $this->algoritmo = $algoritmo;
            $this->like = $like;
            DB::__construct();

        }
        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar(){
            
            $query = $this->conn->prepare("INSERT INTO productos VALUES(null, :id_categoria, :id_unidad, :id_marca, :valor_unidad, :nombre, :imagen, :stock_min, :stock_max, :precio_venta, :IVA, 1, 0, :codigo, :algoritmo)");

            $query->bindParam(':id_categoria',$this->id_categoria);
            $query->bindParam(':id_unidad',$this->id_unidad);
            $query->bindParam(':id_marca',$this->id_marca);
            $query->bindParam(':valor_unidad',$this->valor_unidad);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':imagen',$this->imagen);
            $query->bindParam(':stock_min',$this->stock_min);
            $query->bindParam(':stock_max',$this->stock_max);
            $query->bindParam(':precio_venta',$this->precio_venta);
            $query->bindParam(':IVA',$this->IVA);
            $query->bindParam(':codigo',$this->codigo);
            $query->bindParam(':algoritmo',$this->algoritmo);
            /* $query->bindParam(':algoritmo',$this->algoritmo); */


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
            
            
            $query = "UPDATE productos SET id_categoria=:id_categoria, id_unidad=:id_unidad, id_marca=:id_marca, valor_unidad=:valor_unidad, nombre=:nombre, stock_min=:stock_min, stock_max=:stock_max, precio_venta=:precio_venta, IVA=:IVA, codigo=:codigo ";
            if ($this->imagen != null) {
                $query = $query . ", imagen=:imagen ";
            }
            $query = $query . " WHERE id=:id";
            
            $query = $this->conn->prepare($query);

            $query->bindParam(':id_categoria',$this->id_categoria);
            $query->bindParam(':id_unidad',$this->id_unidad);
            $query->bindParam(':id_marca',$this->id_marca);
            $query->bindParam(':valor_unidad',$this->valor_unidad);
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':stock_min',$this->stock_min);
            $query->bindParam(':stock_max',$this->stock_max);
            $query->bindParam(':precio_venta',$this->precio_venta);
            $query->bindParam(':IVA',$this->IVA);
            $query->bindParam(':codigo',$this->codigo);
            if ($this->imagen != null) {
                $query->bindParam(':imagen',$this->imagen);
            }
            $query->bindParam(':id',$this->id);

            return $query->execute();
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($n=0,$limite=9, $order=' nombre ASC '){
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
                    a.IVA,
                    a.codigo
                    FROM productos a 
                    INNER JOIN categoria b ON b.id = a.id_categoria 
                    INNER JOIN unidades c ON c.id = a.id_unidad
                    INNER JOIN marcas m ON m.id = a.id_marca
                    WHERE a.nombre LIKE :como ";

                    
			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_marca){
                array_push($lista, 'id_marca');
            }
            if ($this->active){
                array_push($lista, 'active');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND a.'.$e.'=:'.$e;
            	}
            }

            $n = $n*$limite;

            $query = $query . " ORDER BY $order  LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);

            $consulta->bindValue(':como','%'.$this->like.'%');

            if ($this->id){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
			if ($this->id_marca) {
                $consulta->bindParam(':id_marca',$this->id_marca, PDO::PARAM_STR);
			}
			if ($this->active) {
                $consulta->bindParam(':active',$this->active, PDO::PARAM_INT);
			}

            $consulta->execute();
            return $consulta->fetchAll();
        }


        function search_inventario(){
            $query = "SELECT id,nombre,(SELECT SUM(cantidad) FROM entradas WHERE productos.id = id_producto) AS entradas,(SELECT SUM(cantidad) - (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) FROM entradas WHERE productos.id = id_producto) AS salidas, (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) AS existencia, precio_venta,(SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) * precio_venta AS Total FROM productos WHERE active = 1";
            return $this->conn->query($query)->fetchAll();
        }

        function COUNT(){
            $query = "SELECT COUNT(*) as 'total' FROM productos a WHERE 1 ";

			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_marca){
                array_push($lista, 'marca');
            }
            if ($this->active){
                array_push($lista, 'active');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND a.'.$e.'=:'.$e;
            	}
            }
            $query = $this->conn->prepare($query);
            if ($this->id){
                $query->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
			if ($this->id_marca) {
                $query->bindParam(':marca',$this->id_marca, PDO::PARAM_STR);
			}
			if ($this->active) {
                $query->bindParam(':active',$this->active, PDO::PARAM_INT);
			}
            $query->execute();
            return $query->fetch()['total'];
        }
    }
?>