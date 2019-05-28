
<?php
  class User {
    //Instancia de conexion
    private $connection;
    //Nombre de la tabla
    private $table_name = "usuarios";
    //Campos en la tabla --> Igual que como fueron nombrados
    public $id;
    public $nombre;
    public $email;
    public $apellido_paterno;
    public $apellido_materno;
    public $nickname;
    public $password;

    //Constructor de la clase --> Se le tiene que pasar una instancia no nula de la conexion
    function __construct($connection) {
      $this->connection = $connection;
    }

    //Funcion para crear un nuevo usuario
    function crear_usuario($nombre, $email, $apellido_pat, $apellido_mat, $nick, $pwd){
      $query =  "INSERT INTO ".$this->table_name."  VALUES (0,:nombre,:email,:apellido_pat,:apellido_mat,:nick,:pwd)";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":nombre",$nombre);
      $stmt->bindParam(":email",$email);
      $stmt->bindParam(":apellido_pat",$apellido_pat);
      $stmt->bindParam(":apellido_mat",$apellido_mat);
      $stmt->bindParam(":nick",$nick);
      $stmt->bindParam(":pwd",$pwd);
      if ($stmt->execute()) {
        $this->connection.close();
        return true;
      } else {
        return false;
      }
    }

    //Funcion para obtener un solo usuario --> Login
    function login_user($email, $pwd){
      $query = "SELECT * FROM ".$this->table_name." WHERE email = :email AND password = :pwd";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":email", $email);
      $stmt->bindParam(":pwd", $pwd);
      $stmt->execute();
      $this->connection.close();
      return $stmt;
    }

    //Funcion para actualizar un producto
    function update_usuario($id, $nombre, $email, $apellido_pat, $apellido_mat, $nickname){
      $query = "UPDATE ".$this->table_name." SET nombre = :nombre, email = :email, apellido_paterno = :apellido_pat, apellido_materno = :apellido_mat, nickname = :nick WHERE id = :id";
      $stmt = $this->connection->prepare($query);
      $stmt->bindParam(":nombre",$nombre);
      $stmt->bindParam(":email",$email);
      $stmt->bindParam(":apellido_pat",$apellido_pat);
      $stmt->bindParam(":apellido_mat",$apellido_mat);
      $stmt->bindParam(":nick",$nickname);
      $stmt->bindParam(":id",$id);
      if ($stmt->execute()) {
        $this->connection.close();
        return true;
      } else {
        return false;
      }

    }

  }

?>
