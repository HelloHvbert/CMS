<?php
session_start();
include_once('../includes/connect.php');
$error;

if(!$_SESSION['zalog'])
header("Location: index.php");


if(isset($_POST['submit'])){
  $login = $_POST['login'];
  $password = $_POST['password'];
  $imie = $_POST['imie'];
  $nazwisko = $_POST['nazwisko'];

  if(empty($login) or empty($password) or empty($imie) or empty($nazwisko)){
    $error= "<small style='color:#aa0000;'>"."Pola nie mogą być puste"."</small>";
  }elseif(strlen($password)<8){
    $error= "<small style='color:#aa0000;'>"."Hasło musi składać się z conajmniej 8 znaków"."</small>";
  }else{
    $query=$pdo->prepare("SELECT * FROM pracownicy WHERE login=?");
    $query->bindValue(1,$login);
    $query->execute();
    $ile=$query->rowCount();
    if($ile!=0){
      $error= "<small style='color:#aa0000;'>"."Taki login jest zajęty"."</small>";
    }else{
      $sql=$pdo->prepare("INSERT INTO pracownicy VALUES(null,0,0,?,?,?,?)");
      $sql->bindValue(1,$imie); $sql->bindValue(2,$nazwisko); $sql->bindValue(3,$login); $sql->bindValue(4,md5($password));
      $sql->execute();
      $error= "<small style='color:#00FF00;'>"."Dodano pracownika"."</small>";
    }
  }
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Store name</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <div class="container">
<center>
    <a href="../index.php" id="logo">Store name</a><br><br>
    <h1>Dodaj pracownika</h1><br><br>
    <?php if(isset($error)) echo $error ?>
    <form action="pracownik.php" method="post">
<div class="form-group col-md-6">
<label for="exampleInputEmail1">Login</label>
<input type="login" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>
<div class="form-group col-md-6">
<label for="exampleInputPassword2">Hasło</label>
<input type="password" name="password" class="form-control" id="exampleInputPassword2">
</div>
<div class="form-group col-md-6">
<label for="exampleInputPassword3">Imię</label>
<input type="text" name="imie" class="form-control" id="exampleInputPassword3">
</div>
<div class="form-group col-md-6">
<label for="exampleInputPassword4">Nazwisko</label>
<input type="text" name="nazwisko" class="form-control" id="exampleInputPassword4">
</div>
<button type="submit" name="submit" class="btn btn-primary">Dodaj</button>
</form>
</center>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
