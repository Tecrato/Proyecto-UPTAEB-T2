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

        function __construct($id=null, $categoria=null,$unidades=null,$nombre=null,$marca=null,$imagen=null,$stock_min=null,$stock_max=null,$precio_venta=null,$IVA=null){
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
            DB::__construct();

        }
        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar(){
            
            $query = $this->conn->prepare("INSERT INTO productos VALUES(null, :categoria, :unidades, :nombre, :marca, :imagen, :stock_min, :stock_max, :precio_venta, :IVA)");

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
        function borrar() {

            $query = $this->conn->prepare("DELETE FROM productos WHERE ID=:id");
                
            $query->bindParam(':id',$this->id);

            $query->execute();
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function actualizar(){
            
            
            $query = "UPDATE productos SET id_categoria=:categoria, id_unidad=:unidades, nombre=:nombre, marca=:descripcion, stock_min=:stock_min, stock_max=:stock_max, precio_venta=:precio_venta, IVA=:IVA";
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

            return $this->conn->execute($query);
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM productos";

            if ($this->id != null){
                $query = $query." WHERE id=:id";
            }
            $n = $n*$limite;

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
        function search_stock(){
            $query = $this->conn->prepare("SELECT SUM(restante) as stock FROM entradas WHERE id_producto=:id");

            $query->bindParam(':id',$this->id, PDO::PARAM_INT);

            $query->execute();
            $r = $query->fetch()['stock'];
            return $r ?: 0;
        }
        function search_like(){
            $query = $this->conn->prepare("SELECT * FROM productos WHERE nombre LIKE '%:nombre%'");

            $query->bindParam(':nombre',$this->nombre);

            $query->execute();
            return $query->fetchAll();
        }

        function search_Product_RegistroVentas(){
            $query = "SELECT id, nombre,(SELECT SUM(existencia) FROM entradas Where id_producto = p.id) as stock,precio_venta,IVA FROM `productos` as p ORDER BY id";

            return $this->conn->query($query)->fetchAll();
        }

        function search_targeta($n, $limite){
            $query = $this->conn->prepare("SELECT id,nombre,marca,imagen,(SELECT nombre FROM categoria WHERE productos.id_categoria = id) AS categoria, (SELECT MAX((SELECT razon_social FROM proveedores WHERE entradas.id_proveedor = id)) FROM entradas WHERE id_producto = productos.id) AS proveedor FROM productos LIMIT :l OFFSET :n");
            
            $n = $n*$limite;
            $query->bindParam(':l',$limite, PDO::PARAM_INT);
            $query->bindParam(':n',$n, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll();
        }

        function search_inventario(){
            $query = "SELECT id,marca,(SELECT SUM(cantidad) FROM entradas WHERE productos.id = id_producto) AS entradas,(SELECT SUM(cantidad) - (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) FROM entradas WHERE productos.id = id_producto) AS salidas, (SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) AS existencia, precio_venta,(SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) * precio_venta AS Total FROM productos";
            return $this->conn->query($query)->fetchAll();
        }

        function search_ValorInventario(){
            $query = "SELECT SUM((SELECT SUM(existencia) FROM entradas WHERE productos.id = id_producto) * precio_venta) AS Total FROM productos";

            return $this->conn->query($query)->fetchAll();
        }

        function COUNT(){
            
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM productos")->fetch()['total'];
        }
    }
?>