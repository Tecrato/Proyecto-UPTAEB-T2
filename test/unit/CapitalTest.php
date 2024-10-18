<?php declare(strict_types=1);
require '../src/Model/Conexion.php'; // Ruta a tu archivo de conexión
require '../src/Model/Capital.php'; // Ruta a tu modelo de Capital

use PHPUnit\Framework\TestCase;

class CapitalTest extends TestCase {

    protected $capital;

    // Este método se ejecuta antes de cada prueba
    protected function setUp(): void {
        // Inicializa la clase Capital (opcionalmente con un ID para filtrar)
        $this->capital = new Capital();
    }

    // Prueba unitaria para el método search()
    public function testSearchCapital() {
        // Configura el ID del capital que se va a buscar (puedes cambiar el ID a algo que exista en tu base de datos)
        $this->capital->setId(1); // Filtrar por ID = 1

        // Realiza la búsqueda
        $resultados = $this->capital->search();

        // Asegúrate de que la búsqueda devuelva resultados (en este caso, debería devolver al menos 1 fila)
        $this->assertNotEmpty($resultados, "No se encontraron resultados en la búsqueda.");

        // Verifica que el primer resultado tenga el ID correcto
        $this->assertEquals(1, $resultados[0]['id'], "El ID del primer resultado no coincide con el valor esperado.");
    }
}
