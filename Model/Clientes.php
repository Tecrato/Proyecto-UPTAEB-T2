<?php

    class Cliente extends DB {
        private $id;
        private $nombre;
        private $cedula;
        private $documento;
        private $apellido;
        private $telefono;
        private $direccion;
        private $like_nombre;
        private $like_cedula;

        function __construct($id=null, $nombre=null,$cedula=null,$apellido=null,$documento=null,$direccion=null,$telefono=null,$like_nombre='',$like_cedula=''){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->cedula = $cedula;
            $this->documento = $documento;
            $this->apellido = $apellido;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->like_nombre = $like_nombre;
            $this->like_cedula = $like_cedula;
            DB::__construct();
        }

        function set_id($id){
            $this->id = $id;
        }

        function set_nombre($nombre){
            $this->nombre = $nombre;
        }

        function set_cedula($cedula){
            $this->cedula = $cedula;
        }

        function set_documento($documento){
            $this->documento = $documento;
        }

        function set_apellido($apellido){
            $this->apellido = $apellido;
        }

        function set_telefono($telefono){
            $this->telefono = $telefono;
        }

        function set_direccion($direccion){
            $this->direccion = $direccion;
        }

        function set_like_nombre($like_nombre){
            $this->like_nombre = $like_nombre;
        }

        function set_like_cedula($like_cedula){
            $this->like_cedula = $like_cedula;
        }

        function get_id(){
            return $this->id;
        }

        function get_nombre(){
            return $this->nombre;
        }

        function get_cedula(){
            return $this->cedula;
        }

        function get_documento(){
            return $this->documento;
        }

        function get_apellido(){
            return $this->apellido;
        }

        function get_telefono(){
            return $this->telefono;
        }

        function get_direccion(){
            return $this->direccion;
        }

        function get_active(){
            return $this->active;
        }

        function agregar($usuario){
            $query = $this->conn->prepare("INSERT INTO clientes (nombre, cedula, apellido, documento, direccion, telefono, active) VALUES(:nombre, :cedula, :apellido, :documento, :direccion, :telefono,1)");
            $query->bindParam(':nombre',$this->nombre, PDO::PARAM_STR);
            $query->bindParam(':cedula',$this->cedula, PDO::PARAM_STR);
            $query->bindParam(':documento',$this->documento, PDO::PARAM_STR);
            $query->bindParam(':apellido',$this->apellido, PDO::PARAM_STR);
            $query->bindParam(':direccion',$this->direccion, PDO::PARAM_STR);
            $query->bindParam(':telefono',$this->telefono, PDO::PARAM_STR);
            $query->execute();
            $this->add_bitacora($usuario,"Cliente","Registrar","Cliente Registrado");
            return $this->conn->lastInsertId();
        }

        function desactivar($usuario){
			$query = $this->conn->prepare('UPDATE clientes SET active=0 WHERE id=:id');
			$query->bindParam(':id',$this->id);
			$query->execute();
			$this->add_bitacora($usuario,"Cliente","Eliminar","Cliente".$this->id." Eliminado");
        }

        function actualizar($usuario){
            $query = $this->conn->prepare("UPDATE clientes SET nombre=:nombre, cedula=:cedula, documento=:documento, apellido=:apellido, Telefono=:telefono, direccion=:direccion WHERE id=:id");
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':cedula',$this->cedula);
            $query->bindParam(':documento',$this->documento);
            $query->bindParam(':apellido',$this->apellido);
            $query->bindParam(':telefono',$this->telefono);
            $query->bindParam(':direccion',$this->direccion);
            $query->bindParam(':id',$this->id);
			$this->add_bitacora($usuario,"Cliente","Modificar","Cliente ".$this->id." Modificado");
            return $query->execute(); 
        }

        function search($n=0,$limite=9){
            $query = "SELECT * FROM clientes WHERE active=1 AND 
            nombre LIKE :like_nombre AND 
            cedula LIKE :like_cedula";

            if ($this->id != null){
                $query = $query." AND id=:id";
            }
            $n = $n*$limite;
            

            $query = $query . " LIMIT :l OFFSET :n";
            $consulta = $this->conn->prepare($query);

            
            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);
            
            $this->like_nombre = '%'.$this->like_nombre.'%';
            $consulta->bindParam(':like_nombre',$this->like_nombre, PDO::PARAM_STR);
            
            $this->like_cedula = '%'.$this->like_cedula.'%';
            $consulta->bindParam(':like_cedula',$this->like_cedula, PDO::PARAM_STR);

            if ($this->id != null){
                $consulta->bindParam(':id',$this->id, PDO::PARAM_INT);
            }
            $consulta->execute();
            return $consulta->fetchAll();
        }

        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM clientes")->fetch()['total'];
        }
    }
?>