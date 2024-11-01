<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    class Usuario extends Db_base{
        private $id;
        private $nombre;
        private $correo;
        private $hash;
        private $rol;
        private $semilla;
        private $sesion_id;
        private $nombre_like;
        private $correo_like;


        function __construct($id=null, $nombre=null,$correo=null,$hash=null,$rol=null,$semilla=null,$sesion_id=null,$nombre_like=null,$correo_like=null){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->correo = $correo;
            $this->hash = $hash;
            $this->rol = $rol;
            $this->semilla = $semilla;
            $this->sesion_id = $sesion_id;
            $this->nombre_like = $nombre_like;
            $this->correo_like = $correo_like;
            Db_base::__construct();
            $this->tabla = "usuarios";
            $this->add_variables([
                "a.id" => $this->id,
                "a.nombre" => $this->nombre,
                "a.correo" => $this->correo,
                "a.rol" => $this->rol,
                "a.semilla" => $this->semilla,
                "a.hash" => $this->hash,
                "a.sesion_id" => $this->sesion_id
            ]);
            $this->add_variables_like([
                "a.nombre" => $this->nombre_like,
                "a.correo" => $this->correo_like,
            ]);
        }

        public function login(){
            $query = $this->conn->prepare('UPDATE usuarios SET active=1 , sesion_id=:sesion_id WHERE id=:id');
            $query->bindValue(':id',$this->id);
            $query->bindValue(':sesion_id', $this->sesion_id);
            $query->execute();
        }
        function logout() {
            $query = $this->conn->prepare('UPDATE usuarios SET active=0 WHERE id=:id');
            $query->bindValue(':id',$this->id);
            $query->execute(); 
        }
        function verificar($contraseña){
            $query = "SELECT * FROM usuarios WHERE correo=:correo";
            $consulta = $this->conn->prepare($query);
            $consulta->bindValue(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = password_verify($contraseña,$consulta->fetchAll()[0]['hash']);
            return $resultado;
        }
        function cambiar_password() {
            $query = "UPDATE usuarios SET hash=:hash WHERE correo=:correo";
            $consulta = $this->conn->prepare($query);
            $consulta->bindValue(':correo',$this->correo, PDO::PARAM_STR);
            $consulta->bindValue(':hash',$this->hash, PDO::PARAM_STR);
            $consulta->execute();
        }
        function cambiar_rol() {
            $query = "UPDATE usuarios SET rol=:rol WHERE id=:id";
            $consulta = $this->conn->prepare($query);
            $consulta->bindValue(':id',$this->id, PDO::PARAM_STR);
            $consulta->bindValue(':rol',$this->rol, PDO::PARAM_STR);
            $consulta->execute();
        }
}       

?>