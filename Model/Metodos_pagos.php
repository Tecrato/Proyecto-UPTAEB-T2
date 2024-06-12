<?php
class Metodo_pago extends DB {
    private $id;
    private $nombre;
    private $descripcion;

    function __construct($id=null, $nombre=null){
        DB::__construct();
        $this->id = $id;
        $this->nombre = $nombre;
    }

    function search($n=0, $limite=9){
        $query = "SELECT * FROM metodo_pago";
        return $this->conn->query($query)->fetchAll();
    }

    function agregar($usuario){
        $query = $this->conn->prepare('INSERT INTO metodo_pago (nombre) VALUES (:nombre)');
        $query->bindParam(':nombre',$this->nombre);
        $query->execute();
        $this->add_bitacora($usuario,"Metodos_pago","Registrar","Metodo de pagoRegistrado");
    }

    function borrar($usuario){
        $query = $this->conn->prepare('DELETE FROM metodo_pago WHERE id = :id');
        $query->bindParam(':id',$this->id);
        $query->execute();
        $this->add_bitacora($usuario,"Metodos_pago","Eliminar","Metodo de pago".$this->id." Eliminado");
    }

    function actualizar($usuario, $id){
        $query = 'UPDATE metodo_pago SET nombre=:nombre WHERE id=:id';
        $query = $this->conn->prepare($query);
        $query->bindParam(':nombre',$this->nombre);
        $query->bindParam(':id',$this->id);
        $query->execute(); 
        $this->add_bitacora($usuario,"Metodos_pago","Modificar","Metodo de pago".$id." Modificado");
    }
}
?>
