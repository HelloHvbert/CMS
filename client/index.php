<?php
session_start();
include_once('../includes/connect.php');
if(isset($_SESSION['zalog'])) header('Location: ../index.php');

 if(isset($_SESSION['zalogowany'])){ ?>
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
       <br><br><br>
       <center>
       <a href="../index.php" id="logo">Store name</a><br><br>
         <h2><a href="changemail.php">Zmień emaila</a></h2>
         <h2><a href="changepass.php">Zmień hasło</a></h2>
         <h2><a href="logout.php">Wyloguj się</a></h2>

     </center>
     </div>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   </body>
   </html>

 <?php }else{
   if(isset($_POST['login'],$_POST['password'])){
     $nr;
     $login = trim($_POST['login']);
     $password=md5($_POST['password']);

     if(empty($login) || empty($password)){
       $error= "<small style='color:#aa0000;'>"."Pola nie mogą być puste"."</small>";
     }else{
       $query=$pdo->prepare("SELECT * FROM klienci WHERE login= ? and haslo= ?");
       $query->bindValue(1,$login); $query->bindValue(2,$password);
       $query->execute();
       $nr=$query->fetch();
       $rows = $query->rowCount();
       if($nr['czyPotwierdzone']!="1" and $rows==1){
         $error ="<small style='color:#aa0000;'>"."Potwierdź konto"."</small>";
       }else if($rows==1){
         $_SESSION['zalogowany']=true;
         $_SESSION['uzytkownik']=$nr['id_klient'];
         header("Location: index.php");
       }else{
         $error ="<small style='color:#aa0000;'>"."Niepoprawny login lub hasło"."</small>";
       }
     }
   }

   ?>
   <!DOCTYPE html>
   <html>
   <head>
     <title>Masny sklep</title>
     <meta charset="utf-8">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     <link rel="stylesheet" href="../css/style.css" type="text/css" />
   </head>
   <body>
     <div class="container">
       <a href="../index.php" id="logo">MASNO</a><br><br>
       <p><h1>Zaloguj się</h1></p><br><br>
       <?php if(isset($error)) echo $error ?>
        <br>
        <form action="index.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Login</label>
    <input type="login" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Hasło</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Zaloguj</button>
</form><br>
        <a href="register.php">Nie masz konta? Zarejetruj się</a>
     </div>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

   </body>
   </html>
   <?php
 }


?>
