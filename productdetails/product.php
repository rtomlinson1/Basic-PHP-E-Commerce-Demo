<?php
include('../includes/config.inc.php');
require(MYSQL);
include('../includes/header.php');
include('../includes/product_details_menu.php');

//Display individual product detail page using the `detail` from the products table as an identifier

$details = $_GET['detail'];
$query = "SELECT `name`, `price`, `desc`, `qty`, `img`, `detail` FROM `products` WHERE `detail` = '".$details."'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
?>

<div class="columns">
  <div class="column is-half has-text-centered">
    <div>
      <?php

      // print " $details";
      // print_r($row);
      echo'
        <div class="">
          <img style="width:75%; height:75%; margin-top:3em;" src="../images/'. $row['img'] . '.jpg" alt="' . $row['name'] . '">
          <h6 class="is-size-6 title has-text-centered">'. $row['name'] . '</h6>
          <h6 class="is-size-6 subtitle has-text-centered">$'. $row['price'] .' USD</h6>
          <p class="">'.$row['desc'].'</p>
          ';
      if (isset($_SESSION['user_customer']) || isset($_SESSION['user_admin']) || isset($_SESSION['user_publisher'])){
        echo '
        <form class="add2cart" action="../cart.php" method="post">
          <input type="hidden" name="item" value="' . $row['name'] . '">
          <input type="hidden" name="price" value="' . $row['price'] . '">
          <input class="input" type="text" name="qty" value="1" style="width:50px;">
          <button type="submit" name="add" class="button is-success">Add to Cart</button>
        </form>
        <br />
        <br />
        ';
      }
      echo '<a href="../products.php"><button class="button is-primary">Go Back</button></a>';
       ?>
     </div>
    </div>
  </div>
</div>

<?php
include('../includes/footer.php') ?>
