<?php
  class Product {
    //Instancia de conexion
    private $connection;
    //Nombre de la tabla
    private $table_name = "productos";
    //Campos en la tabla --> Igual que como fueron nombrados
    public $id;
    public $nombre;
    public $imagen;
    public $precio;
    public $stock;
    public $fecha_creado;
    public $fecha_actualizado;

    //Constructor de la clase --> Se le tiene que pasar una instancia no nulla de la conexion
    function __construct($connection) {
      $this->connection = $connection;
    }

    //Funcion para crear un producto
    public function crear_producto($nombre, $imagen, $precio, $stock, $fecha_creado, $fecha_actualizado){
      $query =  "INSERT INTO ".$this->table_name."  VALUES (0,:imagen,:nombre,:precio,:stock,:fecha_creado,:fecha_act)";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":imagen",$imagen);
      $stmt->bindParam(":nombre",$nombre);
      $stmt->bindParam(":precio",$precio);
      $stmt->bindParam(":stock",$stock);
      $stmt->bindParam(":fecha_creado",$fecha_creado);
      $stmt->bindParam(":fecha_act",$fecha_actualizado);
      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
      return $stm;
    }

    //Funcion para obtener todos los productos
    public function get_productos(){
      $query = "SELECT * FROM ".$this->table_name." ORDER BY nombre DESC";
      $stmt = $this->connection->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    //Funcion para obtener un solo producto
    public function get_producto($nombre_producto){
      $query = "SELECT * FROM ".$this->table_name." WHERE nombre = :nombre_producto ";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":nombre_producto", $nombre_producto);
      $stmt->execute();
      return $stmt;
    }

    //Funcion para actualizar un producto
    public function update_producto($id, $nombre, $imagen, $precio, $stock, $fecha_creado, $fecha_actualizado){
      $query = "UPDATE ".$this->table_name." SET imagen = :imagen, nombre = :nombre, precio = :precio, stock = :stock, fecha_creado = :fecha_c, fecha_actualizado = :fecha_act WHERE id = :id ";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":imagen",$imagen);
      $stmt->bindParam(":nombre",$nombre);
      $stmt->bindParam(":precio",$precio);
      $stmt->bindParam(":stock",$stock);
      $stmt->bindParam(":fecha_c",$fecha_creado);
      $stmt->bindParam(":fecha_act",$fecha_actualizado);
      $stmt->bindParam(":id",$id);


    }

    //Funcion para eliminar un producto
    public function delete_producto($id_producto){

    }

  }
?>
