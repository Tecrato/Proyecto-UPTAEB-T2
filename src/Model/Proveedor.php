<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;

    // require('Conexion.php');
    class Proveedor extends Conexion{
        private $id;
        private $nombre;
        private $razon_social;
        private $rif;
        private $telefono;
        private $correo;
        private $direccion;
        private $active;
        private $telefono_2;
        private $like;


        function __construct($id=null, $nombre=null,$razon_social=null,$rif=null,$telefono=null,$correo=null,$direccion=null,$telefono_2=null,$active=null,$like=''){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->razon_social = $razon_social;
            $this->rif = $rif;
            $this->telefono = $telefono;
            $this->correo = $correo;
            $this->direccion = $direccion;
            $this->telefono_2 = $telefono_2;
            $this->active = $active;
            $this->like = $like;
            Conexion::__construct();

        }

        // esta funcion agrega a la tabla productos un objeto con los valores que se le estan pasando
        function agregar() {
            
            $query = $this->conn->prepare("INSERT INTO proveedores VALUES(null, :nombre, :razon, :rif, :tel, :correo, :dir,1,:tel2)");

            $query->bindValue(':nombre',$this->nombre);
            $query->bindValue(':razon',$this->razon_social);
            $query->bindValue(':rif',$this->rif);
            $query->bindValue(':tel',$this->telefono);
            $query->bindValue(':tel2',$this->telefono_2);
            $query->bindValue(':correo',$this->correo);
            $query->bindValue(':dir',$this->direccion);
            $query->execute();
            return $this->conn->lastInsertId();
        }

        // con esta funcion se elimina un elemento dependiendo de su id
        function desactivar() {
			$query = $this->conn->prepare('UPDATE proveedores SET active=0 WHERE id=:id');

			$query->bindValue(':id',$this->id);
			$query->execute();
        }

        // Con esta funcion podremos cambiar un producto segun su ID con los valores que le pasemos
        function actualizar() {
            
            $query = $this->conn->prepare("UPDATE proveedores SET nombre=:nombre, razon_social=:razon_social, rif=:rif, telefono=:tel, correo=:correo, direccion=:dir telefono_2=:tel2 WHERE ID=:id");
        
            $query->bindValue(':nombre',$this->nombre);
            $query->bindValue(':razon_social',$this->razon_social);
            $query->bindValue(':rif',$this->rif);
            $query->bindValue(':tel',$this->telefono);
            $query->bindValue(':tel2',$this->telefono_2);
            $query->bindValue(':correo',$this->correo);
            $query->bindValue(':dir',$this->direccion);
            $query->bindValue(':id',$this->id);
            $query->execute();
        }

        // Con esta otra funcion se busca entre los productos en la base de datos
        function search($n=0,$limite=9){
            $query = "SELECT * FROM proveedores WHERE razon_social LIKE :como";

            if ($this->id != null){
                $query = $query." AND id=:id";
            }
            if ($this->active != null){
                $query = $query." AND active=:active ";
            }
            $n = $n*$limite;

            $query = $query . " LIMIT :l OFFSET :n";

            $consulta = $this->conn->prepare($query);

            $consulta->bindValue(':l',$limite, PDO::PARAM_INT);
            $consulta->bindValue(':n',$n, PDO::PARAM_INT);
            $this->like = '%'.$this->like.'%';
            $consulta->bindValue(':como',$this->like, PDO::PARAM_STR);

            if ($this->id != null){
                $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
            }
            if ($this->active != null){
                $consulta->bindValue(':active',$this->active, PDO::PARAM_STR);
            }

        
            $consulta->execute();
            return $consulta->fetchAll();
        }
        
        function COUNT(){
            $query = $this->conn->prepare("SELECT COUNT(*) as 'total' FROM proveedores");
            $query->execute();
            return $query->fetch()['total'];
        }
    }
?>