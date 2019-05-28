<?php
  header("Content-Type: application/json");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

  include_once '../config/dbclass.php';

  include_once '../entidades/product.php';

  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();

  $producto = new Product($connection);

  $imagen = $_POST['imagen'];
  $nombre = $_POST['nombre'];
  $precio = $_POST['precio'];
  $categoria = $_POST['categoria'];
  $subcategoria = $_POST['subcategoria'];
  $stock = $_POST['stock'];


  if($producto->crear_producto($nombre, $imagen, $precio, $stock, $categoria, $subcategoria)){
    echo json_encode(array("success"=>true));
  }
  else{
    echo json_encode(array("success"=>false));
  }
  $this->connection.close();
?>
