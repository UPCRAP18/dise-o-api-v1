<?php
  header("Content-Type: application/json");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

  include_once '../config/dbclass.php';

  include_once '../entidades/compras.php';

  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();

  $compra = new Compra($connection);
  $id = $_POST['id'];

  $stmt = $compra->compras_usuario($id);
  $count = $stmt->rowCount();
  if($count > 0){
    //Hay datos
    $compras = array();
    $compras["compras"] = array();
    $compras["count"] = $count;
    $compras["success"] = true;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $c  = array(
              "total_pagado" => $total_pagado,
              "cantidad_productos" => $cantidad_productos,
              "fecha_compra" => $fecha_compra
        );

        array_push($compras["compras"], $c);
    }

    echo json_encode($compras);

  }else {
    //No hay datos
    echo json_encode(array(
      "success"=>false,
      "message"=>"No se ha encontrado ningun producto"));
  }

?>
