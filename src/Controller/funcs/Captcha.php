<?php
// Iniciar la sesión para almacenar el código de verificación

// namespace Shtechnologyx\Pt3\Controller\funcs;

session_start();


// Configuraciones
define('ANCHO', 190);
define('ALTO', 50);
define('TAMANIO_FUENTE', 30);
define('CODIGO_LENGTH', 6);
define('NUM_LINEAS', 6);
define('NUM_PUNTOS', 500);

// Genera un código aleatorio de 5 caracteres
$codigo = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, CODIGO_LENGTH);
$fuente = realpath('../../Plugins/font_captcha/Consolas.ttf');

// Guardar el código en la sesión después de aplicar hash (sha1)
$_SESSION['codigo_verificacion'] = sha1($codigo);

// Crear una imagen en blanco
$imagen = imagecreate(ANCHO, ALTO);
$colorFondo = imagecolorallocate($imagen, 255, 255, 255);
imagefill($imagen, 0, 0, $colorFondo);

// Colores para texto, líneas y puntos
$colorText = imagecolorallocate($imagen, 50, 50, 50);
$colorSecundario = imagecolorallocate($imagen, 0, 0, 128);

// Agrega líneas
for ($i = 0; $i < NUM_LINEAS; $i++) {
    imageline($imagen, 0, rand(0, ALTO), ANCHO, rand(0, ALTO), $colorSecundario);
}

// Agrega puntos aleatorios
for ($i = 0; $i < NUM_PUNTOS; $i++) {
    imagesetpixel($imagen, rand(0, ANCHO), rand(0, ALTO), $colorSecundario);
}

// Escribe el código en la imagen usando una fuente TrueType
imagettftext($imagen, TAMANIO_FUENTE, -5, 10, 35, $colorText, $fuente, $codigo);

// Mostrar la imagen en el navegador y liberar la memoria
header('Content-Type: image/png');
imagepng($imagen);
imagedestroy($imagen);
