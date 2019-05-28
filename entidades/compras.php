
<?php
  class Compra {
    //Instancia de conexion
    private $connection;
    //Nombre de la tabla
    private $table_name = "compras";
    //Campos en la tabla --> Igual que como fueron nombrados
    public $id;
    public $id_usuario;
    public $total_pagado;
    public $cantidad_productos;
    public $fecha_compra;

    //Constructor de la clase --> Se le tiene que pasar una instancia no nula de la conexion
    function __construct($connection) {
      $this->connection = $connection;
    }

    //Funcion para crear un nuevo usuario
    function registrar_compra($id_usuario, $monto_total, $total_productos, $fecha){
      $query =  "INSERT INTO ".$this->table_name."  VALUES (0,:id_usuario,:monto,:articulos,:fecha)";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":id_usuario",$id_usuario);
      $stmt->bindParam(":monto",$monto_total);
      $stmt->bindParam(":articulos",$total_productos);
      $stmt->bindParam(":fecha",$fecha);
      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
    }

    //Funcion para obtener un solo usuario --> Login
    function compras_usuario($id_usuario){
      $query = "SELECT * FROM ".$this->table_name." WHERE id_usuario = :id_usuario";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":id_usuario", $id_usuario);
      $stmt->execute();
      return $stmt;
    }

  }

?>
