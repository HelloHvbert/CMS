<?php
session_start();
include_once('../includes/connect.php');

if(!$_SESSION['zalogowany']) header("Location: ../index.php");

if(isset($_POST['submit'])){

    $aktualne=$_POST['aktualne'];
    $nowe1=$_POST['password1'];
    $nowe2=$_POST['password2'];

    $query=$pdo->prepare("SELECT haslo from klienci WHERE id_klient=?");
    $query->bindValue(1,$_SESSION['uzytkownik']);
    $query->execute();
    $password=$query->fetch();

    if(empty($aktualne) or empty($nowe1) or empty($nowe2)){
      $error="<small style='color:#aa0000;'>"."Wymagane są wszystkie pola"."</small>";
    }elseif(md5($aktualne)!=$password['haslo']){
      $error="<small style='color:#aa0000;'>"."Niepoprawne aktualne hasło"."</small>";
    }elseif($nowe1!=$nowe2){
      $error="<small style='color:#aa0000;'>"."Podane nowe hasła nie są identyczne"."</small>";
    }elseif(strlen($nowe1)<8){
      $error="<small style='color:#aa0000;'>"."Nowe hasło musi się składać z najmniej 8 znaków"."</small>";
    }else{
      $q=$pdo->prepare("UPDATE klienci SET haslo=? WHERE id_klient=?");
      $q->bindValue(1,md5($nowe1)); $q->bindValue(2,$_SESSION['uzytkownik']);
      $q->execute();
      $error="<small style='color:#00FF00;'>"."Hasło zostało zmienione"."</small>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Store name</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css" type="text/css" />
</head>
<body>
  <div class="container">
    <a href="index.php" id="logo">Store name</a><br><br>
    <p><h1>Zmień hasło</h1></p><br>
    <?php if(isset($error)) echo $error ?>
     <br>
     <form action="changepass.php" method="post">
<div class="form-group">
 <label for="exampleInputEmail1">Aktualne hasło</label>
 <input type="password" name="aktualne" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>
<div class="form-group">
 <label for="exampleInputPassword1">Nowe hasło</label>
 <input type="password" name="password1" class="form-control" id="exampleInputPassword1">
</div>
<div class="form-group">
 <label for="exampleInputPassword1">Powtórz nowe hasło</label>
 <input type="password" name="password2" class="form-control" id="exampleInputPassword2">
</div>
<button type="submit" name="submit" class="btn btn-primary">Zaloguj</button>
</form><br>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
