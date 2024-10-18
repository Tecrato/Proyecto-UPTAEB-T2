<?php declare (strict_types=1);
require '../src/Model/Conexion.php';
require '../src/Model/Proveedores.php';
require '../src/Model/Productos.php';
require '../src/Model/Entradas.php';

use PHPUnit\Framework\TestCase;

class Entradas2Test extends TestCase{    
    //protected $proveedor;
    protected $producto;
    protected $entrada;

    protected function setUp(): void{
        $this->producto = new Producto(id:"999", nombre: "productodeprueba", id_categoria: "1", precio_venta: "100", id_unidad: 1, id_marca:1, valor_unidad:150, imagen:'banner_productos.png', stock_min:1, stock_max:10, IVA:0, codigo:12345678);
        $this->entrada = new Entrada(id_producto: null, id_proveedor:8, cantidad: "99", fecha_compra: "2024-10-17", fecha_vencimiento:"2024-10-17", precio_compra: "10");
    }

    public function testEntradaTest(){

        //agregar el producto
        $this->producto->agregar();
        $queryProducto = $this->producto->conn->query("SELECT * FROM productos ORDER BY id DESC LIMIT 1");
        $ultimoProducto = $queryProducto->fetch(PDO::FETCH_ASSOC);
        //aquí se prueba si el producto ingresado es igual al que está en la BD
        $this->assertEquals('productodeprueba', $ultimoProducto['nombre'], "El producto no se ha agregado correctamente");
       
        //agregar el proveedor
       /* $this->proveedor->agregar();
        $queryProveedor = $this->proveedor->conn->query("SELECT * FROM proveedores ORDER BY id DESC LIMIT 1");
        $ultimoProveedor = $queryProveedor->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals('proveedordeprueba'); */

        //agregar la entrada
        $this->entrada->setIdProducto($ultimoProducto['id']);
        $this->entrada->agregar();

        $queryEntrada = $this->entrada->conn->query("SELECT * FROM entradas ORDER BY id DESC LIMIT 1");
        $ultimaentrada = $queryEntrada->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals($ultimoProducto['id'], $ultimaentrada['id_producto'], "el producto no coincide");
        $this->assertEquals(99, $ultimaentrada["cantidad"], "las cantidades no coinciden");
        $this->assertEquals('2024-10-17', $ultimaentrada["fecha_compra"], "las fechas no coinciden");
    
    }

}


