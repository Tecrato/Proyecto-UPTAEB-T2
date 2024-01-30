<?php

    class Cliente extends DB{
        private $id;
        private $nombre;
        private $cedula;
        private $documento;
        private $apellido;
        private $telefono;
        private $direccion;

        function __construct($id=null, $nombre=null,$cedula=null,$apellido=null,$documento=null,$direccion=null,$telefono=null){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->cedula = $cedula;
            $this->documento = $documento;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            DB::__construct();

        }

        function agregar(){
            $query = $this->conn->prepare("INSERT INTO clientes (nombre, cedula, apellido, documento, direccion, telefono, active) VALUES(:nombre, :cedula, :apellido, :documento, :direccion, :telefono,1)");
            
            $query->bindParam(':nombre',$this->nombre, PDO::PARAM_STR);
            $query->bindParam(':cedula',$this->cedula, PDO::PARAM_STR);
            $query->bindParam(':documento',$this->documento, PDO::PARAM_STR);
            $query->bindParam(':apellido',$this->apellido, PDO::PARAM_STR);
            $query->bindParam(':direccion',$this->direccion, PDO::PARAM_STR);
            $query->bindParam(':telefono',$this->telefono, PDO::PARAM_STR);

            $query->execute();
        }


        // con esta funcion se elimina un elemento dependiendo de su id
        function borrar_logicamente() {
			$query = $this->conn->prepare('UPDATE clientes SET active=0 WHERE id=:id');

			$query->bindParam(':id',$this->id);
			$query->execute();
        }

        // Con esta funcion podremos cambiar un cliente segun su ID con los valores que le pasemos
        function actualizar(){
            
            $query = $this->conn->prepare("UPDATE clientes SET nombre=:nombre, cedula=:cedula, documento=:documento, apellido=:apellido, Telefono=:telefono, direccion=:direccion WHERE id=:id");
            
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':cedula',$this->cedula);
            $query->bindParam(':documento',$this->documento);
            $query->bindParam(':apellido',$this->apellido);
            $query->bindParam(':telefono',$this->telefono);
            $query->bindParam(':direccion',$this->direccion);
            $query->bindParam(':id',$this->id);
            
            return $query->execute(); 
        }

        // Con esta otra funcion se busca entre los clientes en la base de datos
        function search($n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM clientes WHERE active=1";

            if ($this->id != null){
                $query = $query." AND id=:id";
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
        function search_like($val){
            $query = $this->conn->prepare("SELECT * FROM clientes WHERE cedula LIKE '%$val%'");
            // $query->bindParam(':li',$this->nombre);
            $query->execute();
            return $query->fetchAll();
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM clientes")->fetch()['total'];
        }
    }
?>