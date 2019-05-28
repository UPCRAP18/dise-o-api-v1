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
  $categoria = $_POST['categoria'];

  $stmt = $producto->get_productos_categoria($categoria);
  $count = $stmt->rowCount();
  if($count > 0){
    //Hay datos
    $products = array();
    $products["productos"] = array();
    $products["count"] = $count;
    $products["success"] = true;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $p  = array(
              "id" => $id,
              "imagen" => $imagen,
              "nombre" => $nombre,
              "precio" => $precio,
              "categoria" => $categoria,
              "subcategoria" => $subcategoria,
              "stock" => $stock
        );

        array_push($products["productos"], $p);
    }

    echo json_encode($products);

  }else {
    //No hay datos
    echo json_encode(array(
      "success"=>false,
      "message"=>"No se ha encontrado ningun producto"));
  }
  $this->connection.close();

?>
