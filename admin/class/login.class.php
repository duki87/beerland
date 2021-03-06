<?php
  require_once('db.class.php');

  class Login extends Database {

    private $connect;

    function __construct() {
      $db = new Database();
      $this->connect = $db->connect();
    }

    public function login($email, $password) {
      $admin_array = array();
      try {
        $query = "SELECT * FROM admin WHERE email = ? LIMIT 1";
        $statement = $this->connect->prepare($query);
        $statement->execute([$email]);
        $result = $statement->rowCount();
        if($result < 1) {
          throw new Exception('NOT_REGISTERED');
        } else {
          $admin = $statement->fetch();
          if($admin['status'] == 0) {
            throw new Exception('NOT_ACTIVE');
          } else {
            if(password_verify($password, $admin['password'])) {
              $admin_array['admin_id'] = $admin['id'];
              $admin_array['admin_name'] = $admin['name'];
              $_SESSION['admin'] = $admin_array;
              //Updating user last login time
              $last_login = date("Y-m-d h:i:s");
              $query = "UPDATE admin SET last_login = '$last_login' WHERE email = '$email'";
              $statement = $this->connect->prepare($query);
              $result = $statement->execute();
              return 'LOGGED_IN';
            } else {
              throw new Exception('PASSWORD_MISMATCH');
            }
          }
        }
      }
      catch(Exception $e) {
        echo $e->getMessage();
      }
    }

    function __destruct() {
      echo 'LOGIN_FINISH';
    }
  }
?>
