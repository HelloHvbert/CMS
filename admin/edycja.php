<?php
session_start();
include_once('../includes/connect.php');
include_once('../includes/produkt.php');
$produkt= new Produkt;
$produkty=$produkt->fetch_all();

?>
<!DOCTYPE html>
<html>
<head>
  <title>Store name</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body><center><br><br><br>
  <div class="container">
    <a href="index.php" id="logo">Store name</a><br>
    <h2>Wybierz produkt do edycji</h2>
    <table class="table">

  <tbody>

    <?php foreach ($produkty as $produkt ) {?>
    <tr>

      <td><a href="edit.php?id=<?php echo $produkt['id_produkt']; ?>" ><?php echo $produkt['nazwa'];  ?></td>
    </a>
    </tr>
  <?php } ?>
  </tbody>
</table>

  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</center>
</body>
</html>
