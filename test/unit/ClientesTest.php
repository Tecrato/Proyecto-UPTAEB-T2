<?php declare(strict_types=1);
require '../src/Model/Conexion.php';
require '../src/Model/Clientes.php';

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ClientesTest extends TestCase {

    protected $db;

    // Se ejecuta antes de cada prueba
    protected function setUp(): void {
        // Inicializa el objeto Cliente con la conexión a la base de datos
        $this->db = new Cliente();
    }

    // Prueba unitaria para agregar un cliente
    public function testAgregarCliente() {

        
        $nombre = "Prueba";
        $cedula = "28150004";
        $apellido = "Prueba";
        $documento = "P";
        $direccion = "Calle Prueba";
        $telefono = "+584121338031";
        $usuario = "6"; // Usuario de prueba

        //asigna los valores a las propiedades del objeto 
        $this->db->setNombre($nombre);
        $this->db->setCedula($cedula);
        $this->db->setApellido($apellido);
        $this->db->setDocumento($documento);
        $this->db->setDireccion($direccion);
        $this->db->setTelefono($telefono);

        //agrega con el metodo que llega d clientes
        $this->db->agregar($usuario);

        
        // aqui busca el último cliente
        $query = $this->db->conn->query("SELECT * FROM clientes ORDER BY id DESC LIMIT 1");
        $ultimoRegistro = $query->fetch(PDO::FETCH_ASSOC);

        // 5. Comprobar que los datos del cliente insertado coinciden con los esperados
        $this->assertEquals($nombre, $ultimoRegistro['nombre'], "El nombre del cliente no coincide.");
        $this->assertEquals($cedula, $ultimoRegistro['cedula'], "La cédula no coincide.");
        $this->assertEquals($apellido, $ultimoRegistro['apellido'], "El apellido no coincide.");
        $this->assertEquals($documento, $ultimoRegistro['documento'], "El tipo de documento no coincide.");
        $this->assertEquals($direccion, $ultimoRegistro['direccion'], "La dirección no coincide.");
        $this->assertEquals($telefono, $ultimoRegistro['telefono'], "El teléfono no coincide.");
    }
}
