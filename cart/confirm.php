<?php
session_start();
include_once('../includes/connect.php');

if(isset($_POST['dodaj'])){
  $suma=0;
  $licz=count($_SESSION['cart']);
  for($i=0;$i<$licz;$i++){
    $cena=$_SESSION['cart'][$i]['cena'];
    $ilosc=$_SESSION['cart'][$i]['ilosc'];
    $suma+=$cena*$ilosc;
  }
  if($suma>200) $dostawa=null; else $dostawa=20;
  $q=$pdo->prepare("INSERT INTO zamowienia values(null,?,?,null,?,0)");
  $q->bindValue(1,$_SESSION['uzytkownik']); $q->bindValue(2,date('Y-m-d H:i'));  $q->bindValue(3,$dostawa);
  $q->execute();
  $q2=$pdo->prepare("SELECT max(id_zamowienie) as zam FROM zamowienia");
  $q2->execute();
  $zamowienie=$q2->fetch();

  $licz=count($_SESSION['cart']);
  for($i=0;$i<$licz;$i++){
    $id=$_SESSION['cart'][$i]['produkt_id'];
    $ilosc=$_SESSION['cart'][$i]['ilosc'];
    $q3=$pdo->prepare("INSERT INTO zamowienia_produkty values(?,?,?)");
    $q3->bindValue(1,$zamowienie['zam']); $q3->bindValue(2,$id); $q3->bindValue(3,$ilosc);
    $q3->execute();
  }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Koszyk</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styl.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

  <div class="container-fluid">
    <div id="header">

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
</nav>
</div>
<br><br><br><br>
<div class="card text-center">
  <div class="card-header">
    Dziękujemy za zakupy
  </div>
  <div class="card-body">
    <h5 class="card-title">Gdy zatwierdzimy twoje zamówienie, zostanie wysłane na maila potwierdzenie</h5>

    <a href="../index.php" class="btn btn-primary">Wróć na stronę główną</a>
  </div>

</div>
    <div class="fixed-bottom">
    <footer class="page-footer font-small blue">
      <div class="footer-copyright text-center py-3 bg-primary">© 2020 Copyright: Hubert Szarwiński 4it
      </div>
    </footer>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
?>
