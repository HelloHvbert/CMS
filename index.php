<?php
include_once('includes/connect.php');
include_once('includes/produkt.php');
$produkt= new Produkt;
$produkty=$produkt->fetch_all();
$kategorie=$pdo->prepare("SELECT nazwa from kategorie");
$kategorie->execute();

$ilosc=$pdo->query("SELECT count(*) as i from produkty")->fetch();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Store name</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styl.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <div id="header">

      <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary" >
  <a class="navbar-brand" href="index.php" id="logo">Store name</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">


      <li class="nav-item">
        <a class="nav-link" href="client/index.php">Klient</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin/index.php">Zarządzaj</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart/cart.php">Koszyk</a>
      </li>
    </ul>
  </div>
</nav>
</div>
<br><br><br>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active text-center">
      <img class="d-block w-100 img-fluid" src="zdjecia/slajd1.jpg" alt="First slide">
    </div>
    <div class="carousel-item text-center">
      <img class="d-block w-100 img-fluid" src="zdjecia/slajd2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item text-center">
      <img class="d-block w-100 img-fluid" src="zdjecia/slajd3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


    <br><br><br><br>


    <nav class="navbar navbar-expand-lg  navbar-light bg-light ">
      <a class="navbar-brand" href="#">Liczba produktów: <?php echo $ilosc['i']; ?></a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Widok
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <form method="post" action="index.php">
            <button class="dropdown-item" name="lista">Lista</button>
            <button class="dropdown-item" name="kafelki" >Kafelki</button>
          </form>
          </div>
        </li>

      </ul>
    </div>
  </nav>
  <br><br><br>
<div class="produkty">
    <?php if(isset($_POST['kafelki'])) { $i = 0;?>
    <table class="table" >
      <tbody>
      <?php foreach ($produkty as $produkt) { if($i==0) echo "<tr>"; ?>
        <div class="col-sm-6  col-lg-4" >
          <td><h3><a href="produkt.php?id=<?php echo $produkt['id_produkt'];?>"><?php echo $produkt['nazwa']; ?></h3>
          <p><img class="img-thumbnail img-fluid photo"  style="max-width: 20vw; width:auto; height:auto;" src="<?php echo $produkt['zdjecie']; ?>"></p></a>
        <p><?php echo $produkt['cena_brutto'];?> zł</p>
          </td>
        </div>
    <?php $i++; if($i==3) {echo "</tr>"; $i=0;} }  ?>
    </tbody>
    </table>
  <?php }else {?>
    <table class="table">
      <thead>
    <tr>
      <th scope="col">Zdjęcie</th>
      <th scope="col">Nazwa</th>
      <th scope="col">Cena brutto</th>
    </tr>
  </thead><tbody>
      <?php foreach ($produkty as $produkt) { ?>
      <tr>

      <td><img class="img-thumbnail img-fluid photo" style="max-width: 20vw; width:auto; height:auto;" src="<?php echo $produkt['zdjecie']; ?>"></td>
      <td><h3><a href="produkt.php?id=<?php echo $produkt['id_produkt'];?>"><?php echo $produkt['nazwa'];?></a></h3></td>
      <td><?php echo $produkt['cena_brutto'];?> zł</td>

    </tr>
      <?php } ?>
    </tbody></table>
  <?php } ?>
  </div>
  <hr class="clearfix w-100 d-md-none pb-5">
<div class="fixed-bottom">
<footer class="page-footer font-small blue">
  <div class="footer-copyright text-center py-2 bg-primary">© 2020 Copyright: Hubert Szarwiński 4it
  </div>
</footer>
</div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
