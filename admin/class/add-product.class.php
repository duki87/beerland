<?php
  require_once('db.class.php');

  class AddProduct extends Database {

    private $connect;
    private $name;
    private $brand;
    private $category;
    private $price;
    private $volume;
    private $units;
    private $pack;
    private $image;
    private $date_added;
    private $stock;
    private $description;

    function __construct($product_name, $product_brand, $product_category, $product_price, $product_volume, $product_units, $product_pack, $product_image, $product_stock, $product_description) {
      $db = new Database();
      $this->connect = $db->connect();
      //prepare variables
      $this->name = $product_name;
      $this->brand = $product_brand;
      $this->category = $product_category;
      $this->price = $product_price;
      $this->volume = $product_volume;
      $this->units = $product_units;
      $this->pack = $product_pack;
      $this->image = $product_image;
      $this->stock = $product_stock;
      $this->description = $product_description;
    }

    public function add_product() {
      $query = "INSERT INTO products
      (name, brand, category, price, volume, units, pack, image, stock, description, date_added)
      VALUES (:name, :brand, :category, :price, :volume, :units, :pack, :image, :stock, :description, :date_added)";
      $statement = $this->connect->prepare($query);
      $statement->execute([
        ':name'             => $this->name,
        ':brand'            => $this->brand,
        ':category'         => $this->category,
        ':price'            => $this->price,
        ':volume'           => $this->volume,
        ':units'            => $this->units,
        ':pack'             => $this->pack,
        ':image'            => $this->insert_image($this->image),
        ':stock'            => $this->stock,
        ':description'      => $this->description,
        ':date_added'       => date("Y-m-d h:i:s")
      ]);
      $result = $statement->fetchAll();
    }

    private function insert_image($image) {
      $file_name = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      $file_array = explode('.', $file_name);
      $file_extension = end($file_array);
      $file_name = 'img' . '-' . rand() . '.' . $file_extension;
      $location = 'img/products/' . $file_name;
      if(move_uploaded_file($tmp_name, $location)) {
        return $file_name;
      }
    }

    function __destruct() {
      echo 'product_add';
    }

  }

?>
