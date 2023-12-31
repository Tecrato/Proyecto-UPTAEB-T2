<?php

    class Usuarios extends DB{
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
        // public function search(){
        //     // $query = "SELECT * FROM usuarios WHERE";
        //     // if ($this->id != null){
        //     //     $query->array_push(" ID=:id");
        //     // }
        //     // if ($this->nombre != null) {
        //     //     if (count($querys) > 0){
        //     //         $querys->array_push(" AND");
        //     //     }
        //     //     $querys->array_push(" Nombre=:nombre");
        //     // }
        //     // if ($this->correo != null) {
        //     //     if (count($querys) > 0){
        //     //         $querys->array_push(" AND");
        //     //     }
        //     //     array_push($querys," correo=:correo");
        //     // }
        //     // if ($this->password != null) {
        //     //     if (count($querys) > 0){
        //     //         array_push($querys," AND");
        //     //     }
        //     //     array_push($querys," contraseña=:passsword");
        //     // }
        //     // if ($this->rol != null) {
        //     //     if (count($querys) > 0){
        //     //         $querys->array_push(" AND");
        //     //     }
        //     //     $querys->array_push(" rol=:rol");
        //     // }

        //     // if (count($querys) < 1) {
        //     //     $query = "SELECT * FROM usuarios";
        //     // } else {
        //     //     foreach ($querys as $q) {
        //     //         $query = $query . $q;
        //     //     }
        //     // }
        //     $consulta = $this->conn->prepare('SELECT * FROM usuarios');
        //     $consulta->execute();
        //     return $consulta->fetchAll();
        // }
        // Que de momento solo busca, ya que solo se podra loguear al sistema
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