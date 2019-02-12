<?php
  include('parts/head.php');
  include('class/db.class.php');
  include('class/get-products.class.php');

  $products = array();
  $get_products = new GetProducts();
  $products = $get_products->on_load();
  //print_r($products);
  if(isset($_GET['records_per_page'])) {
    $records_per_page = $_GET['records_per_page'];
    $page_no = 1;
    $get_products = new GetProducts($records_per_page, 1, "ASC", "");
    $products = $get_products->get_products();
    print_r($products);
  }
?>

<link rel="stylesheet" href="assets/css/table.css">
<div class="container">
  <div class="card text-center mt-2">
    <div class="card-header">
      <h2>List All Products</h2>
      <?php
        if(isset($_SESSION['admin']['get_products_message'])) {
          echo $_SESSION['admin']['get_products_message'];
        }
      ?>
    </div>
    <div class="card-body">
      <form class="" action="<?=$_SERVER["PHP_SELF"];?>" method="get">
        <input type="text" id="myInput" class="d-inline" onkeyup="myFunction()" placeholder="Search for names..">
        <select id="mySelect" name="records_per_page" class="d-inline mySelect">
          <option value="5">5</option>
          <option value="10">10</option>
        </select>

        <select id="mySelect" name="sort" class="d-inline mySelect">
          <option value="ASC">Ascending</option>
          <option value="DESC">Descending</option>
        </select>
        <button type="submit" class="d-inline btn btn-primary">Apply</button>
      </form>
      <table id="myTable">
       <tr class="header">
         <th style="width:20%;">Name</th>
         <th style="width:10%;">Brand</th>
         <th style="width:10%;">Category</th>
         <th style="width:10%;">Price</th>
         <th style="width:10%;">Volume</th>
         <th style="width:10%;">Units</th>
         <th style="width:10%;">Pack</th>
         <th style="width:10%;">Stock</th>
       </tr>
       <?php foreach($products as $product) { ?>
       <tr>
         <td><?php echo $product['name'];?></td>
         <td><?php echo $product['brand'];?></td>
         <td><?php echo $product['category'];?></td>
         <td><?php echo $product['price'];?></td>
         <td><?php echo $product['volume'];?></td>
         <td><?php echo $product['units'];?></td>
         <td><?php echo $product['pack'];?></td>
         <td><?php echo $product['stock'];?></td>
       </tr>
      <?php } ?>
      </table>
    </div>
    <div class="card-footer text-muted">
      See latest product additions <a href="#">here</a>.
    </div>
  </div>
</div>
