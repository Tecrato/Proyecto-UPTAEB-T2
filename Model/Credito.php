<?php

    class Credito extends DB {
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


        DB::__construct();
    }

    function agregar($usuario){
        $query = $this->conn->prepare("INSERT INTO credito (fecha_limite, id_rv, monto_final, status) VALUES(:fecha_limite, :id_rv, :monto_final,1)");
        $query->bindParam(':id_rv',$this->id_rv, PDO::PARAM_STR);
        $query->bindParam(':fecha_limite',$this->fecha_limite, PDO::PARAM_STR);
        $query->bindParam(':monto_final',$this->monto_final, PDO::PARAM_STR);
        $query->execute();
        $this->add_bitacora($usuario,"Credito","Registrar","Credito Registrado");
    }

    function desactivar($usuario){
        $query = $this->conn->prepare('UPDATE credito SET active=0 WHERE id=:id');
        $query->bindParam(':id',$this->id);
        $query->execute();
        $this->add_bitacora($usuario,"Credito","Desactivado","Credito".$this->id." Eliminado");
    }

    function actualizar($usuario){
        $query = $this->conn->prepare("UPDATE INTO credito (id, fecha_limite, id_rv, monto_final, telefono, active) VALUES(:id, :id_cliente, :fecha_limite, :id_rv, :monto_final,1)");
        $query->bindParam(':id',$this->id, PDO::PARAM_STR);
        $query->bindParam(':id_rv',$this->id_rv, PDO::PARAM_STR);
        $query->bindParam(':fecha_limite',$this->fecha_limite, PDO::PARAM_STR);
        $query->bindParam(':monto_final',$this->monto_final, PDO::PARAM_STR);
        $query->execute();
        $this->add_bitacora($usuario,"Credito","Modificar","Credito Modificado");
    }

    function COUNT(){
        return $this->conn->query("SELECT COUNT(*) as 'total' FROM credito")->fetch()['total'];
    }

    function search($n=0,$limite=9){
        $query = "SELECT 
        
        FROM credito
        INNER JOIN registro_ventas rv ON credito.id_rv = rv.id
        INNER JOIN caja j ON rv.id_caja = j.id
        INNER JOIN usuarios u ON j.id_usuario = u.id
        INNER JOIN clientes c ON rv.id_cliente = c.id
        ";

        if ($this->id != null){
            $query = $query." WHERE id=:id";
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