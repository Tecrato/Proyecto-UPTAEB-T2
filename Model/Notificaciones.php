<?php
	class Notificacion extends DB {
		private $id;
		private $id_usuario;
		private $mensaje;
		private $status;
		function __construct($id=null, $id_usuario=null, $mensaje=null, $status=null){
			DB::__construct();
			$this->id = $id;
			$this->id_usuario = $id_usuario;
			$this->mensaje = $mensaje;
			$this->status = $status;
		}
		
		function desactivar(){
			$query = $this->conn->prepare("UPDATE notificaciones SET status=1 WHERE id=:id");
            $query->bindParam(':id',$this->id);
            $query->execute();

		}
        function COUNT(){
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM notificaciones WHERE status = 0");
            $query->execute();
            return $query->fetch()['total'];
        }
		function search($n=0, $limite=9){
            $query = "SELECT * FROM notificaciones WHERE status = 0 ORDER BY id DESC";

			$lista = [];
            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_usuario){
                array_push($lista, 'id_usuario');
            }
            if ($this->status != null){
                array_push($lista, 'status');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND '.$e.'=:'.$e;
            	}
            }
            $n = $n*$limite;

            $query = $query . " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);

            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }    
            if ($this->id_usuario != null){
                $consulta->bindParam(':id_usuario',$this->id_usuario, PDO::PARAM_INT);
            }    
            if ($this->status != null){
                $consulta->bindParam(':status',$this->status, PDO::PARAM_INT);
            }    
            $consulta->execute();
            return $consulta->fetchAll();
		}
	}
?>