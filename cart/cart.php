<?php
include_once('../includes/connect.php');
include_once('../includes/produkt.php');

session_start();
$produkt= new Produkt;
$produkty=$produkt->fetch_all();
if(isset($_POST['clear'])){
  unset($_SESSION['cart']);
  header("Location: cart.php");
}

if(isset($_POST['remove'])){
  if($_GET['action']=='remove'){
    foreach($_SESSION['cart'] as $item =>$value){
      if($value['produkt_id']==$_GET['id']){
      unset($_SESSION['cart'][$item]);
    }
    }
    header("Location: cart.php");
    if(count($_SESSION['cart'])==0)  unset($_SESSION['cart']);
  }
}

function wypisz($img,$name,$price,$ile,$product_id){
  $element='
  <form action="cart.php?action=remove&id='.$product_id.'" method="post">
    <div class="border rounded">
      <div class="row bg-white">
        <div class="col-md-3">
          <img src="../'.$img.'" class="img-fluid">
        </div>
        <div class="col-md-6">
          <h5 class="pt-2">'.$name.'</h5>

          <h5 class="pt-2">'.$price.' zł</h5>
          <button type="submit" class="btn btn-danger"  name="remove">Usuń z koszyka</button>
        </div>
        <div class="col-md-3 py-5">
        <small class="text-secondary">Ilość</small>
        <div >

          <button type="button" class="btn bg-light border rounded-circle">-</button>
          <input type="text" min="0" step="1" value="'.$ile.' " class="form-control w-25 d-inline">
          <button type="button" class="btn bg-light border rounded-circle">+</button>
        </div>
      </div>
      </div>
    </div>
  </form>
  ';
  echo $element;
}
$licz;
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
    <?php if (isset($_SESSION['cart']))
    echo '<h1 align="center">Koszyk</h1>'.'<center><p ><form action="cart.php" method="post">
      <button type="submit" class="btn btn-warning" name="clear">Wyczyść koszyk</button>
    </form></p></center>';
    ?>

    <div class="row px-5">
      <div class="col-md-7">
        <div class="cart" style="padding:3% 0;">
          <?php
          if(isset($_SESSION['cart']) ){
          $produkt_id=array_column($_SESSION['cart'],'product_id');
          $suma=0;
          $licz=count($_SESSION['cart']);
          $x=0;$y=0;
          $min=array_key_first($_SESSION['cart']);

          foreach($_SESSION['cart'] as $i){
            $id=$i['produkt_id'];
            $nazwa=$i['name'];
            $cena=$i['cena'];
            $ilosc=$i['ilosc'];
            $zdjecie=$i['zdjecie'];
            $y+=$ilosc;
            $suma+=$cena*$ilosc;
            wypisz($zdjecie,$nazwa,$cena,$ilosc,$id);

          }
        }else
        echo "<h1 align='center'>Koszyk jest pusty</h1>"

          ?>
          </div>
        </div>
        <?php if(isset($_SESSION['cart'])){ ?>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bh-white h-25">
          <div class="pt-4">
            <h4>Podsumowanie:</h4>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <?php
                $dostawa;
                  if(isset($_SESSION['cart'])){
                    echo "<h6>Ilość produktów: ".$y."</h6>";
                  }else{
                    echo "<h6>Brak produktów</h6>";
                  }
                  if($suma>250) $dostawa=null;
                  else $dostawa=20;
                ?>

                <h6>Dostawa:
                  <?php
                  if(empty($dostawa)) echo "darmowa";
                  else echo round($dostawa,2)." zł";
                  ?>
                </h6>
              </div>
              <div class="col-md-6">
                <h6>Cena produktów:
                <?php
                echo " ".round($suma,2)." zł";
                ?>
                </h6>

                <h6>
                <?php
                echo "Koszt całkowity: ".round(($suma+$dostawa),2)." zł";
                ?>
                </h6>

              </div>
              <div class="col-md-11">
                <br>
                <center>
              <button type="button" class="btn btn-danger"><a href="adres.php" >Zamów</a></button>
            </center>
            </div>
            <br><br><br>
            </div>
        </div>
      </div>
      <div class="h-25 d-inline-block"></div>
    <?php } ?>
    <hr class="clearfix w-100 d-md-none pb-3">
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
