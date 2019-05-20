<?php
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");

  include_once '../config/dbclass.php';

  include_once '../entidades/user.php';

  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();

  $user = new User($connection);

  //$data = json_decode(file_get_contents("php://input"));
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $ap_pat = $_POST['apellido_paterno'];
  $ap_mat = $_POST['apellido_materno'];
  $email = $_POST['email'];
  $nick = $_POST['nickname'];


  if($user->update_usuario($id,$nombre, $email, $ap_pat, $ap_mat, $nick)){
    echo json_encode(array("success"=>true));
  }
  else{
    echo json_encode(array("success"=>false));
  }
?>
