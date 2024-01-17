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



        // function agregar() {
            
        //     $query = $this->conn->prepare("INSERT INTO usuarios VALUES(null,?, ?, ?, ?,?)");
            
        //     $query->bindParam(1,$this->id);
        //     $query->bindParam(2,$this->nombre);
        //     $query->bindParam(3,$this->correo);
        //     $query->bindParam(4,$this->password);
        //     $query->bindParam(5,$this->rol);
        //     $query->execute();
        // }
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
            
            $query = $this->conn->prepare("UPDATE usuarios SET nombre=?, correo=?, password=?, rol=? WHERE id=?");
            
            $query->bindParam(1,$this->nombre);
            $query->bindParam(2,$this->correo);
            $query->bindParam(3,$this->password);
            $query->bindParam(4,$this->rol);
            $query->bindParam(5,$this->id);
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