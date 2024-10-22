<?php
	class Pago_entrada extends DB {
        private $id;
        private $id_metodo_pago;
        private $id_entrada;
        private $monto;

        function __construct($id=null, $id_metodo_pago=null, $id_entrada=null, $monto=null){
            DB::__construct();
            $this->id = $id;
            $this->id_metodo_pago = $id_metodo_pago;
            $this->id_entrada = $id_entrada;
            $this->monto = $monto;
        }
        
        function search($n=0, $limite=9, $order=' p.id DESC '){
            $query = "SELECT
            p.monto as monto,
            mp.nombre as metodo
            FROM pagos_entradas as p
            JOIN metodo_pago as mp ON mp.id=p.id_metodo_pago
            WHERE 1
            "; 

            $lista = [];

            if ($this->id != null){
                array_push($lista,'id');
            }
            if ($this->id_metodo_pago != null){
                array_push($lista, 'id_metodo_pago');
            }
            if ($this->id_entrada != null){
                array_push($lista, 'id_entrada');
            }
            if ($lista) {
                foreach ($lista as $e){
                    $query .= ' AND p.'.$e.'=:'.$e;
                }
            }
            $query .= " ORDER BY $order  LIMIT :l OFFSET :n";
            $query = $this->conn->prepare($query);

            $n = $n*$limite;
            $query->bindParam(':l', $limite, PDO::PARAM_INT);
            $query->bindParam(':n', $n, PDO::PARAM_INT);
            if ($this->id != null) {
                $query->bindParam(':id', $this->id, PDO::PARAM_INT);
            }
            if ($this->id_metodo_pago != null){
                $query->bindParam(':id_metodo_pago', $this->id_metodo_pago, PDO::PARAM_INT);
            }
            if ($this->id_entrada != null){
                $query->bindParam(':id_entrada', $this->id_entrada, PDO::PARAM_INT);
            }

            $query->execute();
            return $query->fetchAll();
        }

        function agregar(){
            $query = $this->conn->prepare('INSERT INTO pagos_entradas (id_metodo_pago,id_entrada,monto) VALUES (:id_metodo_pago,:id_entrada,:monto)');
            $query->bindParam(':id_metodo_pago',$this->id_metodo_pago);
            $query->bindParam(':id_entrada',$this->id_entrada);
            $query->bindParam(':monto',$this->monto);
            $query->execute();
            return $this->conn->lastInsertId();
        }
        
    }
?>