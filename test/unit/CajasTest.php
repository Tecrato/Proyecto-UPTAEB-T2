<?php declare(strict_types=1);
require '../src/Model/Conexion.php'; // Ruta a tu archivo de conexión
require '../src/Model/Cajas.php'; // Ruta a tu modelo de caja

use PHPUnit\Framework\TestCase;

class CajasTest extends TestCase {

    protected $caja;
   
    // Este método se ejecuta antes de cada prueba
    protected function setUp(): void {
        // Inicializa la clase Caja con un id de usuario y monto inicial
        $this->caja = new Caja(id_usuario: 6, monto_inicial: 500);
    }

    // Prueba unitaria para abrir la caja
    public function testAbrirCaja() {
        // Abre la caja (inserta en la base de datos)
        $this->caja->abrir();

        // Verifica que la caja se haya insertado correctamente en la base de datos
        $query = $this->caja->conn->query("SELECT * FROM caja ORDER BY id DESC LIMIT 1");
        $registro = $query->fetch(PDO::FETCH_ASSOC);

        // Comprobaciones (asserts) para verificar que los valores sean correctos
        $this->assertEquals(6, $registro['id_usuario'], "El ID de usuario no coincide.");
        $this->assertEquals(500, $registro['monto_inicial'], "El monto inicial no coincide.");
        $this->assertEquals(0, $registro['monto_final'], "El monto final debería ser 0 al abrir.");
        $this->assertEquals(0, $registro['estado'], "El estado debería ser 0 al abrir.");

        $this->caja->setId = $registro['id']; // Establecer el ID de la caja recién creada
        $this->caja->cerrar();
        $queryCerrar = $this->caja->conn->query("SELECT * FROM caja WHERE id = " . $registro['id']);
        $registroCerrar = $queryCerrar->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals(0, $registroCerrar['estado'], "El estado debería ser 0 al cerrar la caja.");
    }
}
