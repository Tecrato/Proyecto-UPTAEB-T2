<?php
	class Caja extends DB {

		private $id;
		private $id_usuario;
		private $monto_inicial;
		private $monto_final;
		private $fecha;
		private $status;

		function __construct($id=null, $id_usuario=null, $monto_inicial=null, $monto_final=null, $fecha=null, $estado=null){
			DB::__construct();
			$this->id = $id;
			$this->id_usuario = $id_usuario;
			$this->monto_inicial = $monto_inicial;
			$this->monto_final = $monto_final;
			$this->fecha = $fecha;
			$this->estado = $estado;
		}

        function abrir(){
            $query = $this->conn->prepare("INSERT INTO caja(id_usuario,monto_inicial,monto_final,estado) VALUES(null, :id_usuario, :monto_inicial, :monto_final, :estado)");
            $query->bindParam(':id_usuario',$this->id_usuario);
            $query->bindParam(':monto_inicial',$this->monto_inicial);
            $query->bindParam(':monto_final',$this->monto_final);
            $query->bindParam(':estado',0);
            $query->execute();
			$this->add_bitacora($this->id_usuario,"Caja","Abriendo","Caja abierta");
        }

        function search($n=0,$limite=100, $order=' id DESC '){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM caja";

                    
			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->id_usuario){
                array_push($lista, 'id_usuario');
            }
            if ($this->estado){
                array_push($lista, 'estado');
            }
            if ($lista) {
            	foreach ($lista as $e){
            		$query .= ' AND a.'.$e.'=:'.$e;
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
			if ($this->id_usuario) {
                $consulta->bindParam(':id_usuario',$this->id_usuario, PDO::PARAM_INT);
			}
			if ($this->estado) {
                $consulta->bindParam(':estado',$this->estado, PDO::PARAM_INT);
			}
            $consulta->execute();
            return $consulta->fetchAll();
        }

        function cerrar(){
            $caja = new Caja(id_usuario:$this->id_usuario, estado:1);
            $caja = $this->search(order:' id DESC')[0];
            $query = $this->conn->prepare('UPDATE caja SET estado=1 WHERE id = :id');
            $query->bindParam(':id',$caja->id);
            $query->execute();
			$this->add_bitacora($this->id_usuario,"Caja","Cerrar","Caja cerrada");
        }

	}
?>