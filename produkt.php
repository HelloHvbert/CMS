<?php
include_once('includes/connect.php');
include_once('includes/produkt.php');
session_start();
$id;
$produkt = new Produkt;
if(isset($_GET['dodaj'])){
echo $_SESSION['uzytkownik'];
}

if(isset($_GET['id'])){
$id=$_GET['id'];
$dane= $produkt->fetch_data($id);


?>
<br>
<?php
}else{
  header('Location: index.php');
  exit();
}



?>

<?php if(isset($_POST['dodaj'])){
  $ilosc=$_POST['ilosc'];
  if(@$_SESSION['zalogowany']){

              if(isset($_SESSION['cart'])){

                $item_array_id= array_column($_SESSION['cart'],'produkt_id');
                print_r($item_array_id);
                if(in_array($id,$item_array_id)){
                  echo "<script>alert('Produkt znajduje się już w koszyku')</script>";
                }else{
                  $count=count($_SESSION['cart']);
                  $item_array=array(
                    'produkt_id'=>$id,
                    'name'=> $dane['nazwa'],
                    'cena'=>$dane['cena_brutto'],
                    'ilosc'=>$_POST['ilosc'],
                    'zdjecie'=>$dane['zdjecie']
                  );
                  echo "<script>alert('Produkt został dodany do koszyka')</script>";
                  $_SESSION['cart'][$count]=$item_array;
                }

              }else{
                $item_array=array(
                  'produkt_id'=>$id,
                  'name'=> $dane['nazwa'],
                  'cena'=>$dane['cena_brutto'],
                  'ilosc'=>$_POST['ilosc'],
                  'zdjecie'=>$dane['zdjecie']
                );

                $_SESSION['cart'][0]=$item_array;
                echo "<script>alert('Produkt został dodany do koszyka')</script>";
              }

  }else{
    echo "<script>alert('Zaloguj sie aby dodać produkt do koszyka')</script>";
  }

}
@$c=count($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Store name</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styl.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <a class="nav-link" href="cart/cart.php">Koszyk <?php echo $c; ?></a>
      </li>
    </ul>
  </div>
</nav>
</div>

<br>
<div>
  <div class="produkt">
    <p><h1 align="center" ><?php echo $dane['nazwa']; ?></h1></p>
<center><table><tr><td>
    <div class="">
  <img src="<?php echo $dane['zdjecie']; ?>" class="img-thumbnail img-fluid " width="50%" height="50%" alt="...">
</div>
</td>
<div class="">
  <?php if($dane['ilosc']>=1) {?>
<td>
  <center>
    <form method="post" action="produkt.php?id=<?php echo $id; ?>">
  <h3 ><?php echo $dane['cena_brutto']." zł"; ?></h3><br>
    <h3>Zostało: <?php echo $dane['ilosc']; ?></h3><br>
  <p><input type="number" name="ilosc" min="1" max="<?php echo $dane['ilosc']?>" step="1" value="1"></p>
    <button type="submit" name="dodaj" class="btn btn-primary btn-lg">Dodaj do koszyka</button>
</form>

</center></td>
<?php }else{?>
  <td>
    <center>
      <h3 ><?php echo $dane['cena_brutto']." zł"; ?></h3><br>
    <h3>Niedostępny</h3><br>
  </center></td>
<?php }?>
</div>
</tr>
</table><br><br>
<label for="opis"><h3>Opis:</h3></label>
<div id="opis">

  <?php echo $dane['opis']; ?>
  </div>

</center>


  </div>
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
