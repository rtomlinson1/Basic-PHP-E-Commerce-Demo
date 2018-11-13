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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $missing_fields = FALSE;
    if(!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['desc']) && !empty($_POST['qty']) && !empty($_POST['img']) && !empty($_POST['detail'])){
        $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
        $price = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['price'])));
        $desc = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['desc'])));
        $qty = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['qty'])));
        $imgpath = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['img'])));
        $detail = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['detail'])));

    } else {
        echo '<h5 class="is-size-5 is-danger hero">All forms must be filled out!</h5>';
        $missing_fields = TRUE;
    }
    if (!$missing_fields) {
      // Define the query:
      $query = "INSERT INTO `products`(`productid`, `name`, `price`, `desc`, `qty`, `img`, `detail`) VALUES (0, '$name', '$price', '$desc', '$qty', '$imgpath', '$detail')";
      // Execute the query:
      if (@mysqli_query($dbc, $query)) {
        print '<p class="hero is-success">Product Added.</p>';
      } else {
        print '<p class="hero is-danger">Could not add product. Reason: <br>' . mysqli_error($dbc) . '.</p><p>Query: ' . $query . '</p>';
      }
    }
    mysqli_close($dbc);
  }

 ?>
<h1 class="is-size-1 pl-1">Add-a-Product Form</h1>
<div class="columns is-centered">
  <form class="" action="add_product.php" method="post">
  <div class="column">

    <div class="field">
      <label for="name" class="label">Product Name:</label>
      <div class="control has-icons-left">
        <input class="input" type="text" name="name" placeholder="Product Name">
        <span class="icon is-small is-left">
          <i class="faf fa-file"></i>
        </span>
      </div>

    </div>

    <div class="field">
      <label for="price" class="label">Product Price:</label>
      <div class="control has-icons-left">
        <input class="input" type="text" name="price" placeholder="Price USD" value="">
        <span class="icon is-small is-left">
          <i class="fas fa-dollar-sign"></i>
        </span>
      </div>
    </div>

    <div class="field">
      <label for="desc" class="label">Product Description:</label>
      <div class="control">
        <textarea class="textarea" name="desc" placeholder="Description"></textarea>
      </div>
    </div>

    <div class="field">
      <label for="qty" class="label">Product Quantity:</label>
      <div class="control has-icons-left">
        <input class="input" type="text" name="qty" placeholder="Whole Number only" value="">
        <span class="icon is-small is-left">
          <i class="fas fa-sort-numeric-up"></i>
        </span>
      </div>
    </div>

    <div class="field">
      <label for="img" class="label">Product Image name:</label>
      <div class="control has-icons-left">
        <input class="input" type="text" name="img" placeholder="Without .JPG, etc">
        <span class="icon is-small is-left">
          <i class="faf fa-file"></i>
        </span>
      </div>
    </div>

    <div class="field">
      <label for="detail" class="label">Product Detail Pagename:</label>
      <div class="control has-icons-left">
        <input class="input" type="text" name="detail" placeholder="Without .html, etc">
        <span class="icon is-small is-left">
          <i class="faf fa-file"></i>
        </span>
      </div>
    </div>

    <div class="field is-grouped">
      <div class="control">
        <button class="button is-link">Submit</button>
      </div>
    </div>

  </div>
 </form>
</div>

 <?php

 $current_file = 'add_product.php';
 include('./includes/footer.php');
   ?>
