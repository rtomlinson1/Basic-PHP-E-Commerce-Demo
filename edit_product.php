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
//if its coming from the edit_products page...
//get the product info
if (isset ($_GET['productid']) && ($_GET['productid'] > 0)) {
    $id = $_GET['productid'];
    $query = "SELECT `name`, `price`, `desc`, `qty`, `img`,`detail` FROM `products` WHERE productid=$id";

    if($result = mysqli_query($dbc, $query)){
        $row = mysqli_fetch_array($result);
        //make form


        echo '
        <h1 class="is-size-1 pl-1">Edit Product</h1>

        <form class="form" action="edit_product.php" method="post">
        <div class="columns">
            <div class="column is-half-desktop" style="margin:0 auto;">
              <label for="name">Product Name:</label><br />
              <input class="input" type="text" name="name" value="'. $row['name'] .'" /><br /><br />

              <label for="price">Product Price:</label><br />
              <input class="input" type="text" name="price" value="'. $row['price'] .'" /><br /><br />

              <label for="desc">Product Description:</label><br />
              <textarea class="textarea" name="desc">'. $row['desc'] .'</textarea><br /><br />

              <label for="qty">Product Quantity:</label><br />
              <input class="input" type="text" name="qty" value="'. $row['qty'] .'" /><br /><br />

              <label for="img">Product Image name:</label>
              <input class="input" type="text" name="img" value="'. $row['img'] .'" /><br /><br />
              <input type="hidden" name="productid" value="'.$_GET['productid'].'" />
              <p>Image Preview:</p>
              <div class="media-left">
                <figure class="image is-128x128 is-rounded">
                  <img src="images/' . $row['img'] . '.jpg" alt="' . $row['name'] . '" alt="Image">
                </figure>
              </div>

              <div class="pl-1">
                <button type="submit" name="add" class="button is-success">Update</button>
              </div>

            </div>
        </div>
        <br />

            </form>';

    } else {
        echo 'error:';

        mysqli_error($dbc);

        print "query was:  $query";}

  //if we are running this script from this page...
 } elseif (isset ($_POST['productid']) && ($_POST['productid'] > 0)) {
    $missing_field = false;
    $id = $_GET['productid'];
    if(!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['desc']) && !empty($_POST['qty']) && !empty($_POST['img'])){
        $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
        $price = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['price'])));
        $desc = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['desc'])));
        $qty = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['qty'])));
        $imgpath = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['img'])));

    } else {
        echo '<h5 class="red">All forms must be filled out!</h5>';
        $missing_fields = TRUE;
    }
    if (!$missing_fields) {
        $query = "UPDATE `products` SET `name`='$name', `price`='$price', `desc`='$desc', `qty`='$qty', `img`='$imgpath' WHERE productid={$_POST['productid']}";
        if($result = mysqli_query($dbc, $query)){
            print '<p>Product updated.</p>';
          } else {
            print '<p class="red">Could not edit product. Reason: <br>' . mysqli_error($dbc) . '.</p><p>Query: ' . $query . '</p>';
          }
    }


} else {
    echo '<h2 class="is-danger">Error. No Product selected.</h2>';
}
    mysqli_close($dbc);

 $current_file = 'edit_product.php';
 include('./includes/footer.php');
   ?>
