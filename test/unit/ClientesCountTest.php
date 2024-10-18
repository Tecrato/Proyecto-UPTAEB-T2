<?php declare(strict_types=1);
require '../src/Model/Conexion.php';
require '../src/Model/Clientes.php';

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ClientesCountTest extends TestCase {

    protected $db;

    // Se ejecuta antes de cada prueba
    protected function setUp(): void {
        // Inicializa el objeto Cliente con la conexión a la base de datos
        $this->db = new Cliente();
    }

    // Prueba unitaria para agregar un cliente
    public function testSearchNoresultados() {
        $nombre = "Noexiste";
        // Prueba cuando no hay clientes en la base de datos.
        $this->db->setlike_nombre($nombre);
        $result = $this->db->search();
        
        // Se espera que no haya resultados.
        $this->assertEmpty($result, "No debería haber resultados cuando el nombre no existe.");
    }

    public function testSearchPocosresultados() {
        $nombre = "Jose";
        // Prueba cuando hay menos resultados que el límite.
        $this->db->setlike_nombre($nombre);
        $result = $this->db->search(0, 10); // Límite de 10, pocos resultados.

        // Se espera que haya pocos resultados, menos de 10.
        $this->assertLessThanOrEqual(10, count($result), "Debería haber menos o igual de 10 resultados.");
    }

    public function testSearchMuchosresultados() {
        $nombre = "[value-2]";
        // Prueba cuando hay más resultados que el límite.
        $this->db->setlike_nombre($nombre);
        $result = $this->db->search(n: 0, limite: 5); // Límite de 5, muchos resultados.

        // Se espera que haya exactamente 5 resultados en la primera página.
        $this->assertEquals(5, count($result), "Debería haber exactamente 5 resultados en la primera página.");
    }
}
