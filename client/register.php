<?php
include_once('../includes/connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit'])){
$email=trim($_POST['email']);
$login=trim($_POST['login']);
$haslo=md5(trim($_POST['haslo']));
$imie=trim($_POST['imie']);
$nazwisko=trim($_POST['nazwisko']);

if(empty($email) or empty($login) or empty($haslo) or empty($imie) or empty($nazwisko) ){
  $error="<small style='color:#aa0000;'>"."Wymagane są wszystkie dane</small><br>";
}else{
$query=$pdo->prepare("SELECT * FROM klienci WHERE email=?");
$query->bindValue(1,$email);
$query->execute();
$query1=$pdo->prepare("SELECT * FROM klienci WHERE login=?");
$query1->bindValue(1,$login);
$query1->execute();
if($query->rowCount()>0){
  $error="<small style='color:#aa0000;'>"."Podany email jest już zajęty</small><br>";
}else if($query1->rowCount()>0){
$error="<small style='color:#aa0000;'>"."Podany login jest już zajęty</small><br>";
}else if($_POST['haslo']!=$_POST['haslo2']){
$error="<small style='color:#aa0000;'>"."Hasła nie zgadzają się</small><br>";
} else if(strlen(trim($_POST['haslo']))<8){
  $error="<small style='color:#aa0000;'>"."Hasło musi składać się z przynajmniej 8 znaków</small><br>";
}else{
  $token = bin2hex(random_bytes(16));
  $q=$pdo->prepare("INSERT INTO klienci (imie,nazwisko,login,haslo,email,token) VALUES(?,?,?,?,?,?)");
  $q->bindValue(1,$imie); $q->bindValue(2,$nazwisko); $q->bindValue(3,$login); $q->bindValue(4,$haslo); $q->bindValue(5,$email);$q->bindValue(6,$token);
  $q->execute();
  $error="<small style='color:#00ff00;'>"."Konto zostało utworzone.\n Zostało ci tylko potwierdzić je przez widomość wysłaną na maila. </small><br>";

//skklep123 Q@wertyuiop

  $to=$email;
  $subject="Weryfikacja konta";
  $body='
    Witaj '.$login.'
    Potwierdź konto klikając w poniższy link:
    http://localhost/cms/client/verify.php?email='.$email.'&token='.$token ;
  $headers = 'From:noreply@yourwebsite.com' . "\r\n";
  mail($to, $subject, $body,$headers);
}
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
    <h1>Stwórz konto </h1><br>

    <?php if(isset($error)) {echo $error; unset($error); } ?>
    <form action="register.php" method="post">


      <div class="form-group">
    <label for="exampleInputEmail1">Email </label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
  </div>

  <div class="form-group">
<label for="exampleInputLogin1">Login </label>
<input type="text" class="form-control" name="login" id="exampleInputLogin1" aria-describedby="emailHelp" >
</div>

  <div class="form-group">
    <label for="exampleInputPassword1">Hasło</label>
    <input type="password" class="form-control" name="haslo" id="exampleInputPassword1" >
  </div>

  <div class="form-group">
    <label for="exampleInputPassword2">Powtórz hasło</label>
    <input type="password" class="form-control" name="haslo2" id="exampleInputPassword2" >
  </div>

  <div class="form-group">
<label for="exampleInputLogin2">Imię</label>
<input type="text" class="form-control" name="imie" id="exampleInputLogin2" aria-describedby="emailHelp" >
</div>

<div class="form-group">
<label for="exampleInputLogin3">Nazwisko </label>
<input type="text" class="form-control" name="nazwisko" id="exampleInputLogin3" aria-describedby="emailHelp" >
</div>



  <input type="submit" name="submit" class="btn btn-primary" value="Zarejestruj się" >

</form>


  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
