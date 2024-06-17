<?php

    class Usuario extends DB{
        private $id;
        private $nombre;
        private $correo;
        private $hash;
        private $rol;


        function __construct($id=null, $nombre=null,$correo=null,$hash=null,$rol=null){           
            $this->id = $id;
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->hash = $hash;
            $this->rol = $rol;
            DB::__construct();

        }

        function agregar($usuario){
            $query = $this->conn->prepare("INSERT INTO usuarios (nombre, correo, hash, rol) VALUES(:nombre, :correo, :hash, :rol)");
            
            $query->bindParam(':nombre',$this->nombre, PDO::PARAM_STR);
            $query->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $query->bindParam(':hash',$this->hash, PDO::PARAM_STR);
            $query->bindParam(':rol',$this->rol, PDO::PARAM_STR);
            $query->execute();
            $this->add_bitacora($usuario,"Usuarios","Registrar","Usuario Registrado");
        }



        function borrar() {

            $query = $this->conn->prepare("DELETE FROM usuarios WHERE ID=:id");
            
            $query->execute([':id'=>$this->id]);
            $this->add_bitacora($usuario,"Usuarios","Eliminados","Usuario"." $id". " Eliminado");
        }
        function search($n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM usuarios WHERE active=1";
   
			$lista = [];

            if ($this->id){
            	array_push($lista,'id');
            }
            if ($this->correo){
                array_push($lista, 'correo');
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
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function actualizar(){
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
        public function login(){

            $query = "SELECT * FROM usuarios WHERE correo=:correo AND hash=:hash";

            $consulta = $this->conn->prepare($query);
            $consulta->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->bindParam(':hash',$this->hash, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM usuarios")->fetchAll()['total'];
        }
        # metodo para verificar la contraseña
        function verificar($contraseña){
            $query = "SELECT * FROM usuarios WHERE correo=:correo";
            $consulta = $this->conn->prepare($query);
            $consulta->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = password_verify($contraseña,$consulta->fetchAll()[0]['hash']);
            return $resultado;
        }
}

?>