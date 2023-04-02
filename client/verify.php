<?php
include_once('../includes/connect.php');
    if(!isset($_GET['email']) or !isset($_GET['token'])){
      header("Location: register.php");
      exit();
    }else{
      $email = $_GET['email'];
      $token = $_GET['token'];
      $query=$pdo->prepare("UPDATE klienci SET czyPotwierdzone=1 WHERE email=? and token=?");
      $query->bindValue(1, $email); $query->bindValue(2, $token);
      $query->execute();

    }
?>
<h1>Konto zostało zweryfikowane.</h1><br><br><br>
<a href="index.php">Przejdź do logowania </a>
