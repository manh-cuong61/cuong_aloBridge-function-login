<?php

namespace App\Models;

use Core\DBConnection;
use PDO;



class AuthModel
{
  private $connection;

  public function __construct()
  {
    $this->connection = new DBConnection();
  }

  public function login()
  {
    if (isset($_POST['login'])) {
      $email = trim($_POST['email']);
      $password = trim($_POST['password']);
      if ($email != "" && $password != "") {
        try {

          $query = "select * from `users` where `email`=:email and `password`=:password";
          $stmt = $this->connection->pdo->prepare($query);
          $stmt->bindParam('email', $email, PDO::PARAM_STR);
          $stmt->bindValue('password', $password, PDO::PARAM_STR);
          $stmt->execute();
          $count = $stmt->rowCount();
          $row   = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($count == 1 && !empty($row)) {
            $_SESSION['loggedin'] = true;
            if (isset($_POST["remember"]) && $_POST["remember"] == 1) {
              setcookie("login", "1", time() + 60);
              return 1;
            } else {
              return 1;
            }
          }
        } catch (PDOException $e) {
          return "Error : " . $e->getMessage();
        }
      }
    }
  }
}
