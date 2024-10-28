<?php
    namespace Shtechnologyx\Pt3\Model;
use Exception;
	class Entrada extends Db_base{
        private $id;
        private $id_proveedor;
        private $fecha_compra;
        private $codigo;
        private $detalles;

        function __construct($id=null, $id_proveedor=null,$fecha_compra=null,$codigo=null,$detalles=null){
            $this->id = $id;
            $this->id_proveedor = $id_proveedor;
            $this->fecha_compra = $fecha_compra;
            $this->codigo = $codigo;
            $this->detalles = $detalles;
            Db_base::__construct();
            $this->tabla = 'entradas';
            $this->select_query = "
                a.id,
                a.id_proveedor,
                b.nombre proveedor,
                a.fecha_compra,
                a.codigo,
                a.detalles
            ";
            $this->joins = '
                INNER JOIN proveedores b ON b.id = a.id_proveedor
            ';
            $this->add_variables([
                "id" => $this->id,
                "id_proveedor" => $this->id_proveedor,
                "fecha_compra" => $this->fecha_compra,
                "codigo" => $this->codigo,
                "detalles" => $this->detalles,
            ]);
        }
}