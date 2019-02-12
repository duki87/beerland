<?php
  require_once('db.class.php');

  class GetProducts extends Database {

    private $connect;
    private $per_page;
    private $page;
    private $sorting;
    private $column;

    function __construct($records_per_page = 5, $page_no = 1, $sorting_order = "ASC", $sorting_column = '') {
      $db = new Database();
      $this->connect = $db->connect();
      //prepare variables
      $this->per_page = $records_per_page;
      $this->page = $page_no;
      $this->sorting = $sorting_order;
      $this->column = $sorting_column;
    }

    public function on_load() {
      $query = "SELECT * FROM products ORDER BY id ASC";
      $statement = $this->connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      $total_pages = ceil(count($result) / $this->per_page);
      $chunks = array_chunk($result, $this->per_page);
      return $chunks[$this->page-1];
    }

    public function get_products() {
      $params = array();
      $query = "SELECT * FROM products ORDER BY ";
      if(!empty($this->price)) {
        $query .= "price ?";
        $params[] = "$this->column";
      } else {
        $query .= "name ?";
        $params[] = "$this->sorting";
      }

      $statement = $this->connect->prepare($query);
      $statement->execute($params);
      $result = $statement->fetchAll();

      $total_pages = ceil(count($result) / $this->per_page);
      $chunks = array_chunk($result, $this->per_page);
      return $chunks[0];
    }

    function __destruct() {
      //echo 'products_get';
    }

  }

?>
