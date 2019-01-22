<?php
  include('parts/head.php');
  if(!isset($_SESSION['admin']['admin_id'])) {
    header('Location: login.php');
  }
?>
<div class="container">
  <?php if(isset($_SESSION['admin']['login_message'])) { ?>
    <h4><?=$_SESSION['admin']['login_message'];?></h4>
  <?php
    unset($_SESSION['admin']['login_message']);
    }
  ?>
  <h2>Welcome, <?php echo $_SESSION['admin']['admin_name'];?></h2>
</div>
