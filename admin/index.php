<?php
session_start();
include_once('../includes/connect.php');
if(isset($_SESSION['zalogowany'])) header('Location: ../index.php');

 if(isset($_SESSION['zalog'])){ ?>
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
       <a href="../index.php" id="logo">Store name</a><br>
       <font size="50px"><b>Zarządzaj<//b></font><br><br>
         <h2> <a href="pracownik.php">Dodaj pracownika</a></h2><br>
        <h2><a href="dodaj.php">Dodaj produkt</a></h2><br>
        <h2> <a href="usun.php">Usuń produkt</a></h2><br>
        <h2><a href="edycja.php">Edytuj produkt</a></h2><br>
        <h2><a href="potwierdz.php">Zatwierdź zamówienia</a></h2><br>
        <h2><a href="logout.php">Wyloguj się</a></h2>

     </center>
     </div>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

   </body>
   </html>

 <?php }else{
   if(isset($_POST['login'],$_POST['password'])){

     $login = $_POST['login'];
     $password=md5($_POST['password']);

     if(empty($login) || empty($password)){
       $error= "<small style='color:#aa0000;'>"."Pola nie mogą być puste"."</small>";
     }else{
       $query=$pdo->prepare("SELECT * FROM pracownicy WHERE login= ? and haslo= ?");
       $query->bindValue(1,$login); $query->bindValue(2,$password);
       $query->execute();

       $rows = $query->rowCount();

       if($rows==1){
         $_SESSION['zalog']=true;
         header("Location: index.php"); exit();
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
     <link rel="stylesheet" href="../css/style.css" type="text/css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   </head>
   <body>
     <div class="container">

       <a href="../index.php" id="logo">MASNO</a><br><br>
       <p><h1>Zarządzaj</h1></p><br><br>
       <?php if(isset($error)) echo $error ?>
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
</form>
     </div>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

   </body>
   </html>
   <?php
 }


?>
