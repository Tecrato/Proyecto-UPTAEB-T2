<?php

    class Usuario extends DB{
        private $id;
        private $nombre;
        private $correo;
        private $hash;
        private $rol;
        private $semilla;
        private $sesion_id;


        function __construct($id=null, $nombre=null,$correo=null,$hash=null,$rol=null,$semilla=null,$sesion_id=null){           
            $this->id = $id;
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->hash = $hash;
            $this->rol = $rol;
            $this->semilla = $semilla;
            $this->sesion_id = $sesion_id;
            DB::__construct();

        }

        function agregar($usuario = 0){
            $query = $this->conn->prepare("INSERT INTO usuarios (nombre, correo, hash, rol,semilla) VALUES(:nombre, :correo, :hash, :rol,:semilla)");
            
            $query->bindParam(':nombre',$this->nombre, PDO::PARAM_STR);
            $query->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $query->bindParam(':hash',$this->hash, PDO::PARAM_STR);
            $query->bindParam(':rol',$this->rol, PDO::PARAM_STR);
            $query->bindParam(':semilla',$this->semilla, PDO::PARAM_STR);
            $query->execute();
            $this->add_bitacora($usuario,"Usuarios","Registrar","Usuario Registrado");
        }



        function borrar($usuario) {

            $query = $this->conn->prepare("DELETE FROM usuarios WHERE ID=:id");
            
            $query->execute([':id'=>$this->id]);
            $this->add_bitacora($usuario,"Usuarios","Eliminados","Usuario".$this->id." Eliminado");
        }
        function search($n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM usuarios WHERE 1";
   
			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->correo != null){
                array_push($lista, 'correo');
            }
            if ($this->rol != null){
                array_push($lista, 'rol');
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
            if ($this->correo != null){
                $consulta->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            }
            if ($this->rol != null){
                $consulta->bindParam(':rol',$this->rol, PDO::PARAM_STR);
            }
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function actualizar($usuario){
            $query = 'UPDATE usuarios SET nombre=:nombre, correo=:correo, hash=:pass';
            if ($this->rol) {
                $query .= ', rol=:rol';
            }
            $query .= " WHERE id=:id";
            $query = $this->conn->prepare($query);
            
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':correo',$this->correo);
            $query->bindParam('pass',$this->hash);
            $query->bindParam(':id',$this->id);
            if ($this->rol) {
                $query->bindParam(':rol',$this->rol);
            }

            $query->execute(); 
            $this->add_bitacora($usuario,"Usuario","Modificar","Usuario "."$id"." Modificado");
        }
        public function login($usuario){
            $query = $this->conn->prepare('UPDATE usuarios SET active=1 , sesion_id=:sesion_id WHERE id=:id');
            $query->bindParam(':id',$this->id);
            $query->bindParam(':sesion_id', $this->sesion_id);
            $query->execute();
            $this->add_bitacora($usuario,"Usuarios","Login","Usuario ".$this->nombre." logueado");
        }
        function logout($usuario) {
            $query = $this->conn->prepare('UPDATE usuarios SET active=0 WHERE id=:id');
            $query->bindParam(':id',$this->id);
            $query->execute(); 
            $this->add_bitacora($usuario,"Usuarios","Logout","Usuario ".$this->nombre." des-logueado");
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM usuarios")->fetch()['total'];
        }
        function verificar($contraseña){
            $query = "SELECT * FROM usuarios WHERE correo=:correo";
            $consulta = $this->conn->prepare($query);
            $consulta->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = password_verify($contraseña,$consulta->fetchAll()[0]['hash']);
            return $resultado;
        }
        function cambiar_password() {
            $query = "UPDATE usuarios SET hash=:hash WHERE correo=:correo";
            $consulta = $this->conn->prepare($query);
            $consulta->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->bindParam(':hash',$this->hash, PDO::PARAM_STR);
            $consulta->execute();
        }
        function cambiar_rol() {
            $query = "UPDATE usuarios SET rol=:rol WHERE id=:id";
            $consulta = $this->conn->prepare($query);
            $consulta->bindParam(':id',$this->id, PDO::PARAM_STR);
            $consulta->bindParam(':rol',$this->rol, PDO::PARAM_STR);
            $consulta->execute();
            $this->add_bitacora($this->id,"Usuarios","Modifcar","Usuario ".$this->nombre." Cambio de rol");
        }
}       

?>