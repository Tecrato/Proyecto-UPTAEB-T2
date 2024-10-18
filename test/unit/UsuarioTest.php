<?php

require '../src/Model/Conexion.php';
require '../src/Model/Usuarios.php'; 

class UsuarioTest extends PHPUnit\Framework\TestCase
{
    public function testLoginValido()
    {
        // Crear instancia de la clase Usuario
        $usuario = new Usuario();

        // Definir credenciales correctas
        $correo = 'nose@gmail.com';
        $hash = "12345678";

        // Ejecutar el método login
        $resultado = $usuario->login($correo, $hash);

        // Verificar si el login fue exitoso
        $this->assertTrue($resultado, "El login debería ser exitoso con credenciales válidas.");
    }
}
