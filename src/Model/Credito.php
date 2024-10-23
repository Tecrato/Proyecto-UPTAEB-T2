<?php
namespace Shtechnologyx\Pt3\Model;
use PDO;

    class Credito extends Conexion {
       private $id;
       private $id_rv;
       private $fecha_limite;
       private $monto_final;
       private $status;
       
       function __construct($id=null,$id_rv=null,$fecha_limite=null,$monto_final=null,$status=null){
            $this->id = $id;
            $this->id_rv = $id_rv;
            $this->fecha_limite = $fecha_limite;
            $this->monto_final = $monto_final;
            $this->status = $status;


            Conexion::__construct();
        }

        function agregar(){
            $query = $this->conn->prepare("INSERT INTO credito (fecha_limite, id_rv, monto_final, status) VALUES(:fecha_limite, :id_rv, :monto_final,1)");
            $query->bindParam(':id_rv',$this->id_rv, PDO::PARAM_STR);
            $query->bindParam(':fecha_limite',$this->fecha_limite, PDO::PARAM_STR);
            $query->bindParam(':monto_final',$this->monto_final, PDO::PARAM_STR);
            $query->execute();
        }

        function desactivar(){
            $query = $this->conn->prepare('UPDATE credito SET active=0 WHERE id=:id');
            $query->bindParam(':id',$this->id);
            $query->execute();
        }

        function actualizar(){
            $query = $this->conn->prepare("UPDATE INTO credito (id, fecha_limite, id_rv, monto_final, telefono, active) VALUES(:id, :id_cliente, :fecha_limite, :id_rv, :monto_final,1)");
            $query->bindParam(':id',$this->id, PDO::PARAM_STR);
            $query->bindParam(':id_rv',$this->id_rv, PDO::PARAM_STR);
            $query->bindParam(':fecha_limite',$this->fecha_limite, PDO::PARAM_STR);
            $query->bindParam(':monto_final',$this->monto_final, PDO::PARAM_STR);
            $query->execute();
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM credito")->fetch()['total'];
        }

        function pagar($pagos){
            $query = $this->conn->prepare("UPDATE credito SET status=0 WHERE id_rv=:id");
            $query->bindParam(':id',$this->id_rv);
            $query->execute();
            
            for ($i = 0; $i < count($pagos); $i++) {
                $lista = $pagos[$i];
                $clase_f = new Pago(null, $this->id_rv, $lista["metodo"], $lista['monto']);
                $clase_f->agregar();
            }
        }

        function search($n=0,$limite=9){
            $query = "SELECT 
            cr.id,
            rv.id id_rv,
            rv.fecha fecha_inicio,
            cr.fecha_limite,
            cr.monto_final,
            c.nombre,
            c.apellido,
            cr.status
            FROM credito cr
            INNER JOIN registro_ventas rv ON cr.id_rv = rv.id
            INNER JOIN caja j ON rv.id_caja = j.id
            INNER JOIN usuarios u ON j.id_usuario = u.id
            INNER JOIN clientes c ON rv.id_cliente = c.id
            WHERE 1
            ";

            if ($this->id != null){
                $query = $query." and cr.id=:id";
            }
            $n = $n*$limite;
            

            $query = $query . " LIMIT :l OFFSET :n";
            $consulta = $this->conn->prepare($query);


            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            $consulta->execute();
            return $consulta->fetchAll();
        }

    }

?>