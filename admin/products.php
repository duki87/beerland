<?php
  include('parts/head.php');
  include('class/db.class.php');
  include('class/get-products.class.php');
  $records_per_page = 5;
  if(isset($_GET['records_per_page'])) {
    $records_per_page = $_GET['records_per_page'];
  }
  $get_products = new GetProducts();
  $products = $get_products->get_products();
?>

<form class="" action="<?=$_SERVER["PHP_SELF"];?>" method="get">
  <input type="text" name="records_per_page" value="">
  <input type="text" name="sort" value="">
  <input type="submit" name="" value="Submit">
</form>
<?php
  foreach ($products as $product) {
    echo $product['name'];
  }
?>
