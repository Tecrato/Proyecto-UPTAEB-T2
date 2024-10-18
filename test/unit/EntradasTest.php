<?php declare(strict_types=1);
require '../src/Model/Conexion.php'; // Ruta a tu archivo de conexión
require '../src/Model/Entradas.php'; // Ruta a tu modelo de productos

use PHPUnit\Framework\TestCase;

class EntradasTest extends TestCase {

    protected $db;

    // Este método se ejecuta antes de cada prueba
    protected function setUp(): void {
        // Inicializa el objeto Producto con la conexión a la base de datos
        $this->db = new Entrada();
    }

    // Prueba unitaria para agregar un producto
    public function testAgregarEntrada() {

        
        $id_producto = 1;
        $id_proveedor = 8;
        $cantidad = 10;
        $fecha_compra = "2024-07-01";
        $fecha_vencimiento = "2024-12-31";
        $precio_compra = 15.50;
        $active = 1;


        $this->db->setIdProducto($id_producto);
        $this->db->setIdProveedor($id_proveedor);
        $this->db->setCantidad($cantidad);
        $this->db->setFechaCompra($fecha_compra);
        $this->db->setFechaVencimiento($fecha_vencimiento);
        $this->db->setPrecioCompra($precio_compra);
        $this->db->setActive($active);

        // Insertar producto en la base de datos
        $this->db->agregar();

        // Consultar el último producto insertado
        $query = $this->db->conn->query("SELECT * FROM entradas ORDER BY id DESC LIMIT 1");
        $ultimaEntrada = $query->fetch(PDO::FETCH_ASSOC);

        // Comprobaciones (asserts) para verificar que los valores son correctos
        $this->assertEquals($id_producto, $ultimaEntrada['id_producto'], "El ID del producto no coincide.");
        $this->assertEquals($id_proveedor, $ultimaEntrada['id_proveedor'], "El ID del proveedor no coincide.");
        $this->assertEquals($cantidad, $ultimaEntrada['cantidad'], "La cantidad no coincide.");
        $this->assertEquals($fecha_compra, $ultimaEntrada['fecha_compra'], "La fecha de compra no coincide.");
        $this->assertEquals($fecha_vencimiento, $ultimaEntrada['fecha_vencimiento'], "La fecha de vencimiento no coincide.");
        $this->assertEquals($precio_compra, $ultimaEntrada['precio_compra'], "El precio de compra no coincide.");
        $this->assertEquals($active, $ultimaEntrada['active'], "El estado activo no coincide.");
    }
}
