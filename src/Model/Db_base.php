<?php
    namespace Shtechnologyx\Pt3\Model;
    use PDO;
    use Shtechnologyx\Pt3\Model\Conexion;
    abstract class Db_base extends Conexion{
        // Ejemplo
        // $this->add_variables([
        //      "id" => $this->id,
        //      "nombre"=> $this->nombre,
        //      ...
        // ]);
        // $this->add_variables_like([
        //     "nombre" => $this->like
        // ]);
        // $this->add_variables_interval([
        //     "a.fecha" => $this->between_fecha
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
        public $variables_interval;
        public function __construct($id=null, $tabla=""){
            $this->id = $id;
            $this->variables = array();
            $this->tabla = $tabla;
            $this->variables_like = array();
            $this->joins = "";
            $this->select_query = " a.* ";
            $this->variables_interval = array();
            Conexion::__construct();
        }
        public function add_variables(array $variables) : void {
            $this->variables = array_filter($variables, fn($value) => !is_null($value));
        }
        public function add_variables_like(array $variables) : void {
            $this->variables_like = array_filter($variables, fn($value) => !is_null($value));
        }
        public function add_variables_interval(array $variables) : void {
            $this->variables_interval = array_filter($variables, fn($value) => !is_null($value));
        }
        private function normalizeKey($key) {
            if (str_contains($key, '.')){
                // return explode(".", $key)[1];
                return implode("",explode(".", $key));
            }
            return $key;
        }
        public function agregar() : int{
            $lista_vars = array();
            foreach ($this->variables as $key => $value){
                $lista_vars[$this->normalizeKey($key)] = $value;
            }
            $sql = "INSERT INTO ".$this->tabla."(";
            $sql .= implode(",", array_keys($lista_vars));
            $sql .= ") VALUES(:";
            $sql .= implode(",:", array_keys($lista_vars));
            $sql .= ") ";

            echo "\n";
            echo "Consulta SQL: " . $sql . "\n";
            print_r($lista_vars);
            // $sql = str_replace("a.", "", $sql);
            // print_r($sql);
            $query = $this->conn->prepare($sql);
            $query->execute($lista_vars);
            return $this->conn->lastInsertId();
        }
        public function actualizar() : void {
            if (!isset($this->variables['a.id']) or $this->variables['a.id'] == null){
                return;
            }
            $lista_vars = array();
            foreach ($this->variables as $key => $value){
                $lista_vars[$this->normalizeKey($key)] = $value;
            }
            $sql = "UPDATE $this->tabla SET ";
            foreach ($lista_vars as $key => $value){
                if ($key == 'id'){
                    continue;
                }
                $sql .= "$key=:$key, ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id=:id";
            $query = $this->conn->prepare($sql);
            $query->execute($lista_vars);
        }
        public function borrar() : void {
            $query = $this->conn->prepare("DELETE FROM $this->tabla WHERE id=:id");
            $query->bindValue(':id',$this->variables['a.id'], PDO::PARAM_INT);
            $query->execute();
        }
        public function search($n=0,$limite=9, $order=' id ASC ') : Array{
            $query = "SELECT $this->select_query FROM $this->tabla AS a $this->joins WHERE 1";
            foreach ($this->variables_like as $key => $value){
                $query .= ' AND '.$key.' LIKE :like'.$this->normalizeKey($key);
            }
            foreach ($this->variables as $key => $value){
                $query .= ' AND '.$key.' = :'.$this->normalizeKey($key);
            }
            foreach ($this->variables_interval as $key => $value){
                $query .= ' AND '.$key.' BETWEEN :'.$this->normalizeKey($key).' AND :'.$this->normalizeKey($key).'2';
            }
            $query .= " ORDER BY $order ";
            $query .= " LIMIT :l OFFSET :n ";
            
            // print_r("\n");
            // print_r($query);
            // Creamos la consulta
            $consulta = $this->conn->prepare($query);
            
            // Asignamos los parametros   
            foreach ($this->variables as $key => $value){
                $consulta->bindValue(':'.$this->normalizeKey($key),$value);
            }
            foreach ($this->variables_like as $key => $value){
                $value2 = $value.'%';
                $consulta->bindValue(':like'.$this->normalizeKey($key),$value2, PDO::PARAM_STR);
            }
            foreach ($this->variables_interval as $key => $value){
                $consulta->bindValue(':'.$this->normalizeKey($key),$value["inicio"]);
                $consulta->bindValue(':'.$this->normalizeKey($key).'2',$value["fin"]);
            }
            $n = $n*$limite;
            $consulta->bindValue(':l',$limite, PDO::PARAM_INT);
            $consulta->bindValue(':n',$n, PDO::PARAM_INT);

            $consulta->execute();
            return $consulta->fetchAll();
        }
        public function COUNT() : int{
            $query = "SELECT COUNT(*) as 'total' FROM $this->tabla AS a $this->joins WHERE 1";
            
            foreach ($this->variables as $key => $value){
                $query .= ' AND '.$key.'=:a'.$this->normalizeKey($key);
            }
            foreach ($this->variables_like as $key => $value){
                $query .= ' AND '.$key.' LIKE :alike'.$this->normalizeKey($key);
            }
            foreach ($this->variables_interval as $key => $value){
                $query .= ' AND '.$key.' BETWEEN :'.$this->normalizeKey($key).' AND :'.$this->normalizeKey($key).'2';
            }
            
            // Creamos la consulta
            $consulta = $this->conn->prepare($query);
            
            // Asignamos los parametros   
            foreach ($this->variables as $key => $value){
                $consulta->bindValue(':a'.$this->normalizeKey($key),$value);
            }
            foreach ($this->variables_like as $key => $value){
                $value2 = '%'.$value.'%';
                $consulta->bindValue(':alike'.$this->normalizeKey($key),$value2);
            }
            foreach ($this->variables_interval as $key => $value){
                $consulta->bindValue(':'.$this->normalizeKey($key),$value["inicio"]);
                $consulta->bindValue(':'.$this->normalizeKey($key).'2',$value["fin"]);
            }
            $consulta->execute();
            return $consulta->fetch()['total'];
        }
        public function get($key){
            return $this->variables[$key];
        }
        public function set($key,$value){
            return $this->variables[$key] = $value;
        }
    }