<?php declare(strict_types=1);
require '../src/Model/Conexion.php';
require '../src/Model/Capital.php';

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DBTest extends TestCase{

protected $db;
protected function setUp(): void{
    $this->db = new DB();
}

    public function testBitacoratest(){

        $usuario = 6; // ID de usuario de prueba
        $tabla = "productos";
        $accion = "insertar";
        $detalles = "Se agregó un nuevo producto.";

        $this->db->add_bitacora($usuario, $tabla, $accion, $detalles);
        $registros = $this->db->search_bitacora();
        $ultimoRegistro = $registros[0];

        $this->assertEquals("Edouard", $ultimoRegistro['nombre'], "El nombre de usuario no coincide.");
        $this->assertEquals($tabla, $ultimoRegistro['tabla'], "La tabla no coincide.");
        $this->assertEquals($accion, $ultimoRegistro['accion'], "La acción no coincide.");
        $this->assertEquals($detalles, $ultimoRegistro['detalles'], "Los detalles no coinciden.");
    
    }
    
}