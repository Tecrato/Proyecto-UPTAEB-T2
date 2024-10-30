<?php
    namespace Shtechnologyx\Pt3\Model;
use Exception;
	class Entrada extends Db_base{
        private $id;
        private $id_proveedor;
        private $fecha_compra;
        private $codigo;
        private $detalles;
        private $between_fecha;

        function __construct($id=null, $id_proveedor=null,$fecha_compra=null,$codigo=null,$detalles=null, $between_fecha=null){
            $this->id = $id;
            $this->id_proveedor = $id_proveedor;
            $this->fecha_compra = $fecha_compra;
            $this->codigo = $codigo;
            $this->detalles = $detalles;
            $this->between_fecha = $between_fecha;
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
                "a.id" => $this->id,
                "a.id_proveedor" => $this->id_proveedor,
                "a.fecha_compra" => $this->fecha_compra,
                "a.codigo" => $this->codigo,
                "a.detalles" => $this->detalles,
            ]);
            $this->add_variables_interval([
                "a.fecha_compra" => $this->between_fecha
            ]);
        }
}