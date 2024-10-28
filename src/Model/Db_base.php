<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;
    use Shtechnologyx\Pt3\Model\Conexion;
    class Db_base extends Conexion{
        // Ejemplo
        // $this->add_variables([
        //      "id" => $this->id,
        //      "nombre"=> $this->nombre,
        //      ...
        // ]);
        // $this->add_variables_like([
        //     "nombre" => $this->like
        // ]);
        // $this->tabla = 'productos';
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
        public $tabla;
        public $joins;
        public $select_query;
        public function __construct($id=null, $tabla=""){
            $this->id = $id;
            $this->variables = array();
            $this->tabla = $tabla;
            $this->variables_like = array();
            $this->joins = "";
            $this->select_query = " a.* ";
            Conexion::__construct();
        }
        public function add_variables($variables){
            foreach ($variables as $key => $value){
                if ($value == null){
                    continue;
                }
                $this->variables[$key] = $value;
            }
        }
        public function add_variables_like($variables){
            foreach ($variables as $key => $value){
                if ($value == null){
                    continue;
                }
                $this->variables_like[$key] = $value;
            }
        }
        public function agregar(){
            $sql = "INSERT INTO $this->tabla( ";
            $sql .= implode(", ", array_keys($this->variables));
            $sql .= " ) VALUES(:";
            $sql .= implode(", :", array_keys($this->variables));
            $sql .= " ) ";
            print_r($sql);
            $query = $this->conn->prepare($sql);
            $query->execute($this->variables);
            return $this->conn->lastInsertId();
        }
        public function borrar(){
            $query = $this->conn->prepare("DELETE FROM $this->tabla WHERE ID=:id");
            $query->bindParam(':id',$this->variables['id'], PDO::PARAM_INT);
            $query->execute();
        }
        public function actualizar(){
            if (!isset($this->variables['id']) or $this->variables['id'] == null){
                return false;
            }
            $sql = "UPDATE $this->tabla SET ";
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
        public function search($n=0,$limite=9, $order=' id ASC '){
            $query = "SELECT $this->select_query FROM $this->tabla AS a $this->joins";
    
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
                $consulta->bindParam(':alike'.$key,$value2, PDO::PARAM_STR);
            }

            $n = $n*$limite;
            $consulta->bindParam(':l',$limite, PDO::PARAM_INT);
            $consulta->bindParam(':n',$n, PDO::PARAM_INT);

            $consulta->execute();
            return $consulta->fetchAll();
        }
        public function COUNT(){
            $query = "SELECT COUNT(*) as 'total' FROM $this->tabla AS a $this->joins WHERE 1";
            
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