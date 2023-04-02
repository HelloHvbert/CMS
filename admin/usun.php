<?php
session_start();

include_once('../includes/connect.php');
include_once('../includes/produkt.php');

$produkt = new Produkt;

if(isset($_SESSION['zalog'])){
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query = $pdo->prepare("DELETE FROM produkty WHERE id_produkt=?");
    $query->bindValue(1,$id);
    $query->execute();
  }
  $produkty=$produkt->fetch_all();

  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Store name</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" type="text/css" />
  </head>
  <body>
    <div class="container">
      <a href="index.php" id="logo">Store name</a><br><br>
      <h2> Wybierz produkt do usunięcia</h2>
      <form action="usun.php" method="get">
        <select onchange="this.form.submit();" name="id">
          <?php foreach ($produkty as $produkt ) {?>
              <option value="<?php echo $produkt['id_produkt']; ?>">
                <?php echo $produkt['nazwa'];?>
              </option>
          <?php } ?>
          </select
      </form>

    </div>
  </body>
  </html>

  <?php
}else header("Location: index.php");
?>
