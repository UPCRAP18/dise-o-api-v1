<?php
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: PATCH");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../config/dbclass.php';

  include_once '../entidades/user.php';

  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();

  $user = new User($connection);

  $data = json_decode(file_get_contents("php://input"));

  if($user->update_usuario($data->id,$data->nombre, $data->email, $data->apellido_paterno, $data->apellido_materno, $data->nickname)){
    echo json_encode(array("success"=>"true"));
  }
  else{
    echo json_encode(array("success"=>"false"));
  }
?>
