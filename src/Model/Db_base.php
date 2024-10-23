<?php
    class Db_base extends DB {
        // Ejemplo
        // $this->add_variables([
        //      "id" => $this->id,
        //      1 => [0 => "nombre", 1 => $this->nombre, 2 => "str"],
        //      ...
        // ]);
        // $this->add_variables_like([
        //     "nombre" => $this->like
        // ]);
        // $this->table = 'productos';
        // $this->select_query = "
        //     a.id,
        //     a.id_categoria,
        //     b.nombre categoria,
        //     a.id_unidad,
        //     c.nombre unidad,
        //     a.nombre,
        //     a.id_marca,
        //     m.nombre marca,
        //     a.valor_unidad,
        //     a.imagen,
        //     (SELECT SUM(entradas_2.existencia) FROM entradas_2 Where id_producto = a.id AND entradas_2.fecha_vencimiento > NOW()) as stock,
        //     a.stock_min,
        //     a.stock_max,
        //     a.precio_venta,
        //     a.IVA,
        //     a.codigo
        // ";
        // $this->joins = '
        //     INNER JOIN categoria b ON b.id = a.id_categoria 
        //     INNER JOIN unidades c ON c.id = a.id_unidad
        //     INNER JOIN marcas m ON m.id = a.id_marca 
        // ';
        private $id;
        private $variables;
        private $variables_like;
        public $table;
        public $joins;
        public $select_query;
        public function __construct($id=null, $table=""){
            $this->id = $id;
            $this->variables = array();
            $this->table = $table;
            $this->variables_like = array();
            $this->joins = "";
            $this->select_query = "*";
            DB::__construct();
        }
        public function add_variables($variables){
            foreach ($variables as $key => $value){
                if ($value == null){
                    continue;
                }
                $this->variables[$key] = $value;
            }
        }
        // public function add_variables($variables){
        //     foreach ($variables as $key => $value){
        //         if ($value[1] == null){
        //             continue;
        //         }
        //         $this->variables[$value[0]] = $value[1];
        //         if ($value[2] == "int"){
        //             $this->variables_type[$value[0]] = PDO::PARAM_INT;
        //         } else if ($value[2] == "str"){
        //             $this->variables_type[$value[0]] = PDO::PARAM_STR;
        //         }
        //     }
        // }
        public function add_variables_like($variables){
            
            foreach ($variables as $key => $value){
                if ($value != null){
                    $this->variables_like[$key] = $value;
                }
            }
        }
        public function agregar(){
            $sql = "INSERT INTO $this->table VALUES(null, ";
            foreach ($this->variables as $key => $value){
                $sql .= ":".$key.", ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " ) ";
            print_r($sql);
            print_r($this->variables);
            
            $query = $this->conn->prepare($sql);
            $query->execute($this->variables);
            return $this->conn->lastInsertId();
        }
        public function borrar(){
            $query = $this->conn->prepare("DELETE FROM $this->table WHERE ID=:id");
            $query->bindParam(':id',$this->variables['id'], PDO::PARAM_INT);
            $query->execute();
        }
        public function actualizar(){
            if (!isset($this->variables['id']) and $this->variables['id'] == null){
                return false;
            }
            $sql = "UPDATE $this->table SET ";
            foreach ($this->variables as $key => $value){
                if ($key == 'id'){
                    continue;
                }
                $sql .= "$key=:$key, ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id=:id";
            $query = $this->conn->prepare($sql);
            $query->execute($this->variables);
        }
        public function search($n=0,$limite=9, $order=' nombre ASC '){
            $query = "SELECT $this->select_query FROM $this->table AS a $this->joins";
    
            $query .= " WHERE 1";
            foreach ($this->variables_like as $key => $value){
                $query .= ' AND a.'.$key.' LIKE :alike'.$key;
            }
            foreach ($this->variables as $key => $value){
                $query .= ' AND a.'.$key.'=:a'.$key;
            }


            $query .= " ORDER BY $order ";
            $query .= " LIMIT :l OFFSET :n ";
            
            // Creamos la consulta
            $consulta = $this->conn->prepare($query);
            
            // Asignamos los parametros   
            foreach ($this->variables as $key => $value){
                $consulta->bindParam(':a'.$key,$value);
            }
            foreach ($this->variables_like as $key => $value){
                $value2 = '%'.$value.'%';
                $consulta->bindParam(':alike'.$key,$value2);
            }

            $n = $n*$limite;
            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);

            $consulta->execute();
            return $consulta->fetchAll();
        }
        public function COUNT(){
            $query = "SELECT COUNT(*) as 'total' FROM $this->table AS a $this->joins";
            
            $query .= " WHERE 1";
            foreach ($this->variables as $key => $value){
                $query .= ' AND a.'.$key.'=:a'.$key;
            }
            foreach ($this->variables_like as $key => $value){
                $query .= ' AND a.'.$key.' LIKE :alike'.$key;
            }

            
            // Creamos la consulta
            $consulta = $this->conn->prepare($query);
            
            // Asignamos los parametros   
            foreach ($this->variables as $key => $value){
                $consulta->bindParam(':a'.$key,$value);
            }
            foreach ($this->variables_like as $key => $value){
                $value2 = '%'.$value.'%';
                $consulta->bindParam(':alike'.$key,$value2);
            }

            $consulta->execute();
            return $consulta->fetch()['total'];
        }
    }