  <?php
  include('parts/head.php');
  include('class/db.class.php');
  include('class/add-product.class.php');
  if(!isset($_SESSION['admin']['admin_id'])) {
    header('Location: login.php');
  }

  if(isset($_POST['name'])) {
    $add_product = new AddProduct($_POST['name'], $_POST['brand'], $_POST['category'], $_POST['price'], $_POST['volume'], $_POST['units'], $_POST['pack'], $_FILES['image'], $_POST['stock'], $_POST['description']);
    if($add_product->add_product()) {
      $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>INFO</strong> Product Added Successfuly!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
      $_SESSION['admin']['add_product_message'] = $message;
      header("Refresh:0");
    }
  }
?>
<div class="container">
  <div class="card text-center mt-2">
    <div class="card-header">
      <h2>Add New Product</h2>
      <?php
        if(isset($_SESSION['admin']['add_product_message'])) {
          echo $_SESSION['admin']['add_product_message'];
        }
      ?>
    </div>
    <div class="card-body">
      <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationTooltip01">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="" required>
            <div class="valid-tooltip">
              Looks good!
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationTooltip02">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand Name" required>
            <div class="valid-tooltip">
              Looks good!
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationTooltipUsername">Category</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
              </div>
              <input type="text" class="form-control" name="category" id="category" placeholder="Choose Beer Category" required>
              <div class="invalid-tooltip">
                Please choose a unique and valid username.
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-3 mb-3">
            <label for="validationTooltip03">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price For This Product" required>
            <div class="invalid-tooltip">
              Please provide a valid city.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationTooltip04">Volume</label>
            <input type="text" class="form-control" name="volume" id="volume" placeholder="Enter Product Volume" required>
            <div class="invalid-tooltip">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationTooltip04">Units</label>
            <input type="text" class="form-control" name="units" id="units" placeholder="Enter Units" required>
            <div class="invalid-tooltip">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationTooltip04">Pack</label>
            <input type="text" class="form-control" name="pack" id="pack" placeholder="Enter Product Pack" required>
            <div class="invalid-tooltip">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationTooltip04">Product Image</label>
            <input type="file" class="form-control" name="image" id="image" required>
            <div class="invalid-tooltip">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationTooltip04">Stock</label>
            <input type="text" class="form-control" name="stock" id="stock" placeholder="Enter Product Stock" required>
            <div class="invalid-tooltip">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="validationTooltip04">Description</label>
            <textarea class="form-control" name="description" id="description" required></textarea>
            <div class="invalid-tooltip">
              Please provide a valid state.
            </div>
          </div>
        </div>
        <button class="btn btn-primary" type="submit">Add Product</button>
      </form>
    </div>
    <div class="card-footer text-muted">
      See latest product additions <a href="#">here</a>.
    </div>
  </div>
</div>
