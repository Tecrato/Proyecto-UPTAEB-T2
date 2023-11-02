<?php

    class Cliente extends DB{

        function agregar($nombre,$cedula,$documento,$apellido,$telefono,$direccion){
            $query = $this->conn->prepare("INSERT INTO clientes (nombre, cedula, apellido, documento, direccion, telefono) VALUES(?, ?,?,?,?,?)");
            
            $query->bindParam(1,$nombre);
            $query->bindParam(2,$cedula);
            $query->bindParam(3,$documento);
            $query->bindParam(4,$apellido);
            $query->bindParam(5,$telefono);
            $query->bindParam(6,$direccion);

            $query->execute();
        }


        // con esta funcion se elimina un elemento dependiendo de su id
        function DELETE($id) {
            $query = "DELETE FROM clientes WHERE ID=$id";
            
            $this->conn->query($query);
        }

        // Con esta funcion podremos cambiar un cliente segun su ID con los valores que le pasemos
        function UPDATE($id,$nombre,$cedula,$apellido,$Telefono,$Direccion){
            
            $query = $this->conn->prepare("UPDATE clientes SET nombre=?, cedula=?, apellido=?, Telefono=?, Direccion=? WHERE id=?");
            
            $query->bindParam(1,$nombre);
            $query->bindParam(2,$cedula);
            $query->bindParam(3,$documento);
            $query->bindParam(4,$apellido);
            $query->bindParam(5,$telefono);
            $query->bindParam(6,$direccion);
            $query->bindParam(7,$id);
            
            return $this->conn->query($query); //$conn->fetch_assoc() // Y devuelve el resultado al controlador
        }

        // Con esta otra funcion se busca entre los clientes en la base de datos
        function search($id=null,$n=0,$limite=9){
            // Al igual que la clase anterior, puede buscar segun muchos valores o solo algunos
            $querys = [];
            $query = "SELECT * FROM clientes";

            if ($id != null){
                $query = $query." WHERE id=$id";
            }

            if($limite) {
                $n = $n*$limite;
                $query = $query . " LIMIT 9 OFFSET ".$n;
            }
            
            return $this->conn->query($query)->fetchAll();
        }
        function search_like($nombre){
            $query = "SELECT * FROM clientes WHERE nombre LIKE '%$nombre%'";

            return $this->conn->query($query);
        }
        function COUNT(){
            return $this->conn->query("SELECT COUNT(*) as 'total' FROM clientes")->fetch_assoc()['total'];
        }
    }
?>