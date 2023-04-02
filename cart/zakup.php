<?php
session_start();
include_once('../includes/connect.php');

$query =$pdo->prepare("SELECT * FROM klienci WHERE id_klient=?");
$query->bindValue(1,$_SESSION['uzytkownik']);
$query->execute();
$user=$query->fetch();
$query2 =$pdo->prepare("SELECT * FROM adres WHERE id_adres=?");
$query2->bindValue(1,$user['id_adres']);
$query2->execute();
$adres=$query2->fetch();

if(!$_SESSION['zalogowany']) header("Location: ../index.php");


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
  <center>
  <div class="container">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary" >
<a class="navbar-brand" href="../index.php" id="logo">Store name</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav">


    <li class="nav-item">
      <a class="nav-link" href="../client/index.php">Klient</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../admin/index.php">Zarządzaj</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="cart.php">Koszyk</a>
    </li>
  </ul>
</div>
</nav><br><br><br>
    <h1>Potwierdź zamówienie</h1><br>

    <div class="card ">
  <div class="card-header">
    Podsumowanie
  </div>
  <div class="card-body">
    <h5 class="card-title">Dane</h5>
    <p class="card-text">Miasto: <?php echo $adres['miasto']; ?></p>
    <p class="card-text">Ulica: <?php echo $adres['ulica'].' '.$adres['numer']; ?></p>
    <p class="card-text">Kod pocztowy: <?php echo $adres['kod']; ?></p>
    <p class="card-text">Nr telefonu: <?php echo $adres['tel']; ?></p>
    <h5 class="card-title">Produkty</h5>
    <p class="card-text">Nazwa       Ilość</p>
    <?php
    $suma=0;
    $licz=count($_SESSION['cart']);
    $x=0;$y=0;
    for($i=0;$i<$licz;$i++){
      $nazwa=$_SESSION['cart'][$i]['name'];
      $cena=$_SESSION['cart'][$i]['cena'];
      $ilosc=$_SESSION['cart'][$i]['ilosc'];
      $suma+=$cena*$ilosc;
      echo '<p class="card-text">'.$nazwa.'     x'.$ilosc.'</p>';
    }
    ?>
    <h5 class="card-title">Do zapłaty</h5>
    <p class="card-text"><?php echo $suma.' zł' ?></p>
    <form method="post" action="confirm.php">
    <button  class="btn btn-primary bg-success" name="dodaj">POTWIERDŹ</button>
  </form>
  <br><br><br><br><br>
  </div>
</div>



    <div class="fixed-bottom">
    <footer class="page-footer font-small blue">
      <div class="footer-copyright text-center py-3 bg-primary">© 2020 Copyright: Hubert Szarwiński 4it
      </div>
    </footer>
    </div>
  </div>
  <center>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
