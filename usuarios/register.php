<?php
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../config/dbclass.php';

  include_once '../entidades/user.php';

  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();

  $user = new User($connection);

  $data = json_decode(file_get_contents("php://input"));

  if($user->crear_usuario($data->nombre, $data->email, $data->apellido_paterno, $data->apellido_materno, $data->nickname, $data->password)){
    echo json_encode(array("success"=>true));
  }
  else{
    echo json_encode(array("success"=>false));
  }
?>
