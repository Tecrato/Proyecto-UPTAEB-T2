<?php

//verifica que exista la vista de
//la pagina

if (!is_file("src/Model/" . $pagina . ".php")) {
  //si no existe envio mensaje y me salgo, hace falta que mande a una pagina de error
  echo "Falta definir la clase " . $pagina;
  exit;
}
require_once("src/Model/" . $pagina . ".php");



//primero chequea si existe la view
//hace require y renderiza
if (is_file("src/View/" . $pagina . ".php")) {
  require_once("src/View/" . $pagina . ".php");
} else {
    //si no existe envio mensaje y me salgo, hace falta que mande a una pagina de error
  echo "pagina en construccion";
}