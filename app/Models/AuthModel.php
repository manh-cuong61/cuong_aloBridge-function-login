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

    public function login(){
        if(isset($_POST['login'])) {
          $email = trim($_POST['email']);
          $password = trim($_POST['password']);
          if($email != "" && $password != "") {
            try {

              $query = "select * from `users` where `email`=:email and `password`=:password";
              $stmt = $this->connection->pdo->prepare($query);
              $stmt->bindParam('email', $email, PDO::PARAM_STR);
              $stmt->bindValue('password', $password, PDO::PARAM_STR);
              $stmt->execute();
              $count = $stmt->rowCount();
              $row   = $stmt->fetch(PDO::FETCH_ASSOC);
              if($count == 1 && !empty($row)) {
                $_SESSION['loggedin'] = true;
                if(isset($_POST["remember"]) && $_POST["remember"]==1){
                    setcookie("login","1",time()+60); 
                    return 1;             
                }else{
                    return 1;
                }        
              }
            } catch (PDOException $e) {
              return "Error : ".$e->getMessage();
            }
          }
        }
    }



    public function register(){
      if(isset($_POST['signupSubmit'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $name = trim($_POST['name']);
        if($username != "" && $email != "" && $password != "" && $name != "") {
          try {
            $query = "select * from `User_Details` where `username`=:username and `email`=:email";
            $stmt = $this->connection->pdo->prepare($query);
            $stmt->bindParam('username', $username, PDO::PARAM_STR);
            $stmt->bindValue('email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
          }catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
          }
          if($count == 1 && !empty($row)){
            echo 'User đã tồn tại';
          }else{
            try {
              $sql = "INSERT INTO User_Details (username, email, password, name) VALUES (:username, :email, :password, :name)";
              $stmt = $this->connection->pdo->prepare($sql);
              $stmt->execute($data= [
                  'username' => $username,
                  'email' => $email,
                  'password' => $password,
                  'name' => $name
              ]);
              return true;
            } catch(PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
            }
          }
        }else{
          echo 'nhap thong tin';
        }
      }
    }
  
      public function getData($sql){
        try {
            $stmt = $this->connection->pdo
            ->prepare($sql);
            $stmt->execute();
            // $count = $stmt->rowCount();
            // print_r($count);
            // die();
            // set the resulting array to associative
             $result = $stmt->setFetchMode(\PDO::FETCH_ASSOC);
             
             return $stmt->fetchAll();


        } catch(\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAllUser(){
      return  $this->getData("SELECT * FROM user_details");
    }

    public function deleteById($table, $id){
      return  $this->getData("DELETE FROM $table WHERE id = $id");
    }

    public function getUser($id){
      return  $this->getData("SELECT * FROM user_details where id = $id");
    }
        
    public function update($id){
      if(isset($_POST['updataSubmit'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $name = trim($_POST['name']);
        if($username != "" && $email != "" && $password != "" && $name != ""){
          try {
            $sql = "UPDATE User_Details SET username = :username, email = :email, password = :password, name = :name WHERE id = $id";
            $stmt = $this->connection->pdo->prepare($sql);
            $stmt->execute($data= [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'name' => $name
            ]);
            return true;
          } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
          }
        }else{
          return;
        }
      }
    }

       
}