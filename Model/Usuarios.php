<?php

    class Usuario extends DB{
        private $id;
        private $nombre;
        private $correo;
        private $password;
        private $rol;


        function __construct($id=null, $nombre=null,$correo=null,$password=null,$rol=null){           
            $this->id = $id;
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->password = $password;
            $this->rol = $rol;
            DB::__construct();

        }

        function agregar(){
            $query = $this->conn->prepare("INSERT INTO usuarios (nombre, correo, password, rol) VALUES(:nombre, :correo, :password, :rol)");
            
            $query->bindParam(':nombre',$this->nombre, PDO::PARAM_STR);
            $query->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $query->bindParam(':password',$this->password, PDO::PARAM_STR);
            $query->bindParam(':rol',$this->rol, PDO::PARAM_STR);
            $query->execute();
        }



        function borrar() {

            $query = $this->conn->prepare("DELETE FROM usuarios WHERE ID=:id");
            
            $query->execute([':id'=>$this->id]);
        }
        function search($n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $query = "SELECT * FROM usuarios";

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
        function actualizar(){
            $query = 'UPDATE usuarios SET nombre=:nombre, correo=:correo, password=:pass';
            if ($this->rol) {
                $query .= ', rol=:rol';
            }
            $query .= " WHERE id=:id";
            $query = $this->conn->prepare($query);
            
            $query->bindParam(':nombre',$this->nombre);
            $query->bindParam(':correo',$this->correo);
            $query->bindParam('pass',$this->password);
            $query->bindParam(':id',$this->id);
            if ($this->rol) {
                $query->bindParam(':rol',$this->rol);
            }

            $query->execute(); 
        }
        public function login(){

            $query = "SELECT * FROM usuarios WHERE correo=:correo AND password=:password";

            $consulta = $this->conn->prepare($query);
            $consulta->bindParam(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->bindParam(':password',$this->password, PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll();
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) 'total' FROM usuarios")->fetchAll()['total'];
        }
}

?>