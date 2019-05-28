<?php
  header("Content-Type: application/json");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

  include_once '../config/dbclass.php';

  include_once '../entidades/user.php';

  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();

  $user = new User($connection);

  //Si quieres ocupar de una manera profesional esta wea, descomenta aqui
  //$data = json_decode(file_get_contents("php://input")); --> Formato JSONObject

  //Formato String
  $nombre = $_POST['nombre'];
  $ap_pat = $_POST['apellido_paterno'];
  $ap_mat = $_POST['apellido_materno'];
  $email = $_POST['email'];
  $nick = $_POST['nickname'];
  $password = $_POST['password'];

  if($user->crear_usuario($nombre, $email, $ap_pat, $ap_mat, $nick, $password)){
    echo json_encode(array("success"=>true, "data" => $nombre));
  }
  else{
    echo json_encode(array("success"=>false));
  }
?>
