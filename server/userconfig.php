<?php

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $mysqli;
  
    public function __construct($host, $dbname, $username, $password) {
      $this->host = $host;
      $this->dbname = $dbname;
      $this->username = $username;
      $this->password = $password;
    }
  
    public function connect() {
      $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbname);
  
      if ($this->mysqli->connect_errno) {
        die("Connection error: " . $this->mysqli->connect_error);
      }
    }
  
    public function getConnection() {
      return $this->mysqli;
    }
  }
  
  class User {
    private $username;
    private $password;
  
    public function __construct($username, $password) {
      $this->username = $username;
      $this->password = $password;
    }
  
    public function verifyLogin($mysqli) {
      $sql = sprintf("SELECT * FROM g_user WHERE username = '%s'",
        $mysqli->real_escape_string($this->username));
  
      $result = $mysqli->query($sql);
      $user = $result->fetch_assoc();
  
      if ($user) {
        $password_hash = password_hash($user["password"], PASSWORD_DEFAULT);
  
        if (password_verify($this->password, $password_hash)) {
          $_SESSION['username'] = $user["username"];
          header("Location: homepage.php");
          exit;
        }else{
          header("Location: login.php");
        }
      }
      header("Location: login.php");
  
      return false;
    }
  }

?>