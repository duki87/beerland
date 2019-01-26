<?php
  require_once('db.class.php');

  class GetProducts extends Database {

    private $connect;
    private $per_page;
    private $page;
    private $sorting;
    private $price;

    function __construct($records_per_page = 5, $page_no = 1, $sorting_order = 'ASC', $price_sorting = '') {
      $db = new Database();
      $this->connect = $db->connect();
      //prepare variables
      $this->per_page = $records_per_page;
      $this->page = $page_no;
      $this->sorting = $sorting_order;
      $this->price = $price_sorting;
    }

    public function get_products() {
      $params = array();
      $query = "SELECT * FROM products ORDER BY ";
      if($this->price != '') {
        $query .= "price ?";
        $params[] = "$this->price";
      } else {
        $query .= "id ?";
        $params[] = "$this->sorting";
      }
      $statement = $this->connect->prepare($query);
      $statement->execute($params);
      $result = $statement->fetchAll();

      $total_pages = ceil(count($result) / $this->per_page);
      $chunks = array_chunk($result, $this->per_page);
      return $chunks;
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
      echo 'products_get';
    }

  }

?>
