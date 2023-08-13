<?php
session_start();
require_once "./userconfig.php" ;

// Database connection
$database = new Database("localhost", "g-projects", "root", "");
$database->connect();

// Process the login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $inputUsername = $_POST["username"];
  $inputPassword = $_POST["password"];

  // Instantiate User object
  $user = new User($inputUsername, $inputPassword);

  // Verify the login credentials
  if ($user->verifyLogin($database->getConnection())) {
    // Successful login
    exit;
  } else {
    // Invalid credentials
    exit;
  }
}

?>


<!-- HTML form -->

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>G-Projects</title>
  <link rel="stylesheet" href="../styles/login.css">

</head>
<body>

<div id="bg"></div>

<form class="loginform" method="post">
  <h1 class="page-title">G-Projects</h1>

  <div class="form-field">
    <input  name="username" placeholder="Email / Username" required/>
  </div>
  
  <div class="form-field">
    <input type="password" name="password" placeholder="Password" required/> 
  </div>
  
  <div class="form-field">
    <button class="btn" type="submit">Log in</button>
  </div>
</form>
  
</body>
