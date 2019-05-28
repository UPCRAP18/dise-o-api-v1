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

  $id_usuario = $_POST['id_usuario'];
  $total_pagado = $_POST['total'];
  $items = $_POST['items'];
  $fecha_compra = date('Y-m-d H:i:s');

  if($compra->registrar_compra($id_usuario,$total_pagado,$items,$fecha_compra)){
    echo json_encode(array("success"=>true));
  } else{
    echo json_encode(array("success"=>false));
  }
  $this->connection.close();
?>
