<?php
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
//redirect invalid user
if (!isset($_SESSION['user_admin'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
 ?>
 <h1>Administrative Tasks</h1>
  <div class="whitelinks">
    <p><a href="add_product.php">Add a Product</a></p>
    <p><a href="edit_products.php">Edit a Product</a></p>
    <p><a href="add_user.php">Add a User</a></p>
    <p><a href="edit_users.php">Edit a User</a></p>
    <p><a href="add_page.php">Add a Blog Post</a></p>
    <p><a href="post_select.php">Edit the Blog</a></p>
  </div>

 <footer>
 <?php

 $current_file = 'admin.php';
 include('./includes/footer.php');
   ?>
 </footer>
