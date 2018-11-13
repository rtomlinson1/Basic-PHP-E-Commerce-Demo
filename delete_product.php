<?php
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);

if (!isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
//delete from products

$id = $_GET['productid'];
$query = "DELETE FROM `products` WHERE `productid`=$id";
$result = mysqli_query($dbc, $query); // Execute the query.
//if successful redirect and pass yup
if (mysqli_affected_rows($dbc) == 1) {
    $destination = 'edit_products.php?$yup=true';
    $protocol = 'http://';
    $url = $protocol . BASE_URL . $destination;
    header("Location: $url");
    $yup = true;
} else {
    //redirect to edit products pass nope
    $destination = 'edit_products.php?$nope=true';
    $protocol = 'http://';
    $url = $protocol . BASE_URL . $destination;
    header("Location: $url");
    $nope = TRUE;
    exit();
}
?>
 <footer>
 <?php

 $current_file = 'delete_product.php';
 include('./includes/footer.php');
   ?>
 </footer>
