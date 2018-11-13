<?php
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
//redirect invalid user
if (!isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}

 ?>
<h1>Publisher Tasks</h1>
  <div class="whitelinks">
    <p><a href="add_product.php">Add a Product</a></p>
    <p><a href="edit_products.php">Edit a Product</a></p>
    <p><a href="add_page.php">Add a Blog Post</a></p>
    <p><a href="post_select.php">Edit the Blog</a></p>
  </div>

 <footer>
 <?php

 $current_file = 'publisher.php';
 include('./includes/footer.php');
   ?>
 </footer>
