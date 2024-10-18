<?php declare(strict_types=1);
require '../src/Model/Conexion.php'; // Ruta a tu archivo de conexión
require '../src/Model/Productos.php'; // Ruta a tu modelo de productos

use PHPUnit\Framework\TestCase;

class ProductosTest extends TestCase {

    protected $db;

    // Este método se ejecuta antes de cada prueba
    protected function setUp(): void {
        // Inicializa el objeto Producto con la conexión a la base de datos
        $this->db = new Producto();
    }

    // Prueba unitaria para agregar un producto
    public function testAgregarProducto() {

        // Datos de prueba para insertar un producto
        $id_categoria = 1;
        $id_unidad = 1;
        $id_marca = 1;
        $valor_unidad = 50;
        $nombre = "Producto de prueba";
        $imagen = "imagen.png";
        $stock_min = 10;
        $stock_max = 100;
        $precio_venta = 150;
        $IVA = 12;
        $codigo = "PR001";
        $algoritmo = 1;

        // Asignar los valores al objeto Producto
        $this->db->setIdCategoria($id_categoria);
        $this->db->setid_unidad($id_unidad);
        $this->db->setid_marca($id_marca);
        $this->db->setvalor_unidad($valor_unidad);
        $this->db->setnombre($nombre);
        $this->db->setImagen($imagen);
        $this->db->setStockMin($stock_min);
        $this->db->setStockMax($stock_max);
        $this->db->setPrecioVenta($precio_venta);
        $this->db->setIVA($IVA);
        $this->db->setCodigo($codigo);
        $this->db->setAlgoritmo($algoritmo);

        // Insertar producto en la base de datos
        $this->db->agregar();

        // Consultar el último producto insertado
        $query = $this->db->conn->query("SELECT * FROM productos ORDER BY id DESC LIMIT 1");
        $ultimoRegistro = $query->fetch(PDO::FETCH_ASSOC);

        // Comprobaciones (asserts) para verificar que los valores son correctos
        $this->assertEquals($id_categoria, $ultimoRegistro['id_categoria'], "El ID de categoría no coincide.");
        $this->assertEquals($id_unidad, $ultimoRegistro['id_unidad'], "El ID de unidad no coincide.");
        $this->assertEquals($id_marca, $ultimoRegistro['id_marca'], "El ID de marca no coincide.");
        $this->assertEquals($valor_unidad, $ultimoRegistro['valor_unidad'], "El valor de la unidad no coincide.");
        $this->assertEquals($nombre, $ultimoRegistro['nombre'], "El nombre no coincide.");
        $this->assertEquals($imagen, $ultimoRegistro['imagen'], "La imagen no coincide.");
        $this->assertEquals($stock_min, $ultimoRegistro['stock_min'], "El stock mínimo no coincide.");
        $this->assertEquals($stock_max, $ultimoRegistro['stock_max'], "El stock máximo no coincide.");
        $this->assertEquals($precio_venta, $ultimoRegistro['precio_venta'], "El precio de venta no coincide.");
        $this->assertEquals($IVA, $ultimoRegistro['IVA'], "El IVA no coincide.");
        $this->assertEquals($codigo, $ultimoRegistro['codigo'], "El código no coincide.");
        $this->assertEquals($algoritmo, $ultimoRegistro['algoritmo'], "El algoritmo no coincide.");
    }
}
