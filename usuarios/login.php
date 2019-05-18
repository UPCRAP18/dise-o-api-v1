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

  $stmt = $user->login_user($data->email, $data->password);
  $count = $stmt->rowCount();
  if($count > 0){
    //Hay datos
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    extract($row);

    echo json_encode(array(
      "id"=>$id,
      "nombre"=>$nombre,
      "email"=>$email,
      "apellido_paterno"=>$apellido_paterno,
      "apellido_materno"=>$apellido_materno,
      "nickname"=>$nickname
    ));

  }else {
    //No hay datos
    echo json_encode(array("message"=>"No se ha encontrado ningun usuario"));
  }

?>
