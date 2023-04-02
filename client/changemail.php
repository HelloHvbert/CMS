<?php
session_start();
include_once('../includes/connect.php');

if(!$_SESSION['zalogowany']) header("Location: ../index.php");

if(isset($_POST['submit'])){

    $nowy=$_POST['nowy'];

    if(empty($nowy)){
      $error="<small style='color:#aa0000;'>"."Pole nie może być puste"."</small>";
    }else{
    $query=$pdo->prepare("UPDATE klienci SET email=? WHERE id_klient=?");
    $query->bindValue(1,$nowy);$query->bindValue(2,$_SESSION['uzytkownik']);
    $query->execute();
    $error="<small style='color:#00FF00;'>"."Adres emial został zaktualizowany"."</small>";
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
    <p><h1>Zmień adres email</h1></p><br>
    <?php if(isset($error)) echo $error ?>
     <br>
     <form action="changemail.php" method="post">
<div class="form-group">
 <label for="exampleInputEmail1">Podaj nowy adres email</label>
 <input type="email" name="nowy" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>
<button type="submit" name="submit" class="btn btn-primary">Zmień</button>
</form><br>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
