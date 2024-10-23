<?php

namespace Shtechnologyx\Pt3\Model;
use PDO;

    class Bitacora extends Conexion {
        private $id;
        private $id_usuario;
        private $tabla;
        private $accion;
        private $detalles;

        function __construct($id=null,$id_usuario=null,$tabla=null,$accion=null,$detalles=null){
            $this->id = $id;
            $this->id_usuario = $id_usuario;
            $this->tabla = $tabla;
            $this->accion = $accion;
            $this->detalles = $detalles;

            Conexion::__construct();
        }

        function agregar(){
            $query = $this->conn->prepare("INSERT INTO bitacora (id_usuario, tabla, accion, detalles) VALUES(:id_usuario, :tabla, :accion, :detalles)");
            $query->bindParam(':id_usuario',$this->id_usuario, PDO::PARAM_INT);
            $query->bindParam(':tabla',$this->tabla, PDO::PARAM_STR);
            $query->bindParam(':accion',$this->accion, PDO::PARAM_STR);
            $query->bindParam(':detalles',$this->detalles, PDO::PARAM_STR);
            $query->execute();
            return $this->conn->lastInsertId();
        }

        static function add_bitacora($usuario, $tabla, $accion, $detalles){
            $clase = new Bitacora(null, $usuario, $tabla, $accion, $detalles);
            $clase->agregar();
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM bitacora")->fetch()['total'];
        }

        function search($n=0,$limite=9){
            $query = "SELECT 
            b.id,
            u.id id_usuario,
            u.nombre,
            b.tabla,
            b.accion,
            b.detalles,
            b.fecha
            FROM bitacora b
            INNER JOIN usuarios u ON b.id_usuario = u.id
            WHERE 1
            ";

            $lista = [];

            if ($this->id){
                array_push($lista,'id');
            }
            if ($this->id_usuario){
                array_push($lista, 'id_usuario');
            }
            if ($this->tabla){
                array_push($lista, 'tabla');
            }
            if ($this->accion){
                array_push($lista, 'accion');
            }
            if ($lista) {
                foreach ($lista as $e){
                    $query .= ' AND b.'.$e.'=:'.$e;
                }
            }

            $n = $n*$limite;
            $query = $query . " LIMIT :l OFFSET :n";
            $consulta = $this->conn->prepare($query);

            if ($this->id){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            if ($this->id_usuario){
                $consulta->bindParam(':id_usuario',$this->id_usuario, PDO::PARAM_INT);
            }
            if ($this->tabla){
                $consulta->bindParam(':tabla',$this->tabla, PDO::PARAM_STR);
            }
            if ($this->accion){
                $consulta->bindParam(':accion',$this->accion, PDO::PARAM_STR);
            }


            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll();
        }

    }
?>
