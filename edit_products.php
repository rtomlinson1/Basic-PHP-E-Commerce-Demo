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

?>
 <h1 class="is-size-1">Edit Products</h1><br />


<?php
//get all product information and display each one.
//include a delete button for each product

    $query = "SELECT `productid`, `name`, `price`, `qty`, `img`, `desc`, `detail` FROM `products`";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);

    while($row = mysqli_fetch_array($result) ) {

      echo '
      <div class="box mar-1">
        <article class="media">
          <div class="media-left">
            <figure class="image is-128x128 is-rounded">
              <img src="images/' . $row['img'] . '.jpg" alt="' . $row['name'] . '" alt="Image">
            </figure>
          </div>
          <div class="media-content">
            <div class="content">
              <h4 class="is-size-4 has-text-weight-bold">' . $row['name'] . '</h5>
              <p>Price: $' . $row['price'] . '</h6>
              <p>Description:' . $row['desc'] . '</p>
              <p>QOH:' . $row['qty'] . '</p>
              <p>Image Name:' . $row['img'] . '</p>
              <p>Detail Page:'. $row['detail'] .'</p>
            </div>
            <div class="content">';
        print"
              <a class=\"button is-warning\" href=\"edit_product.php?productid={$row['productid']}\">Edit</a>
              <a class=\"button is-danger\" href=\"delete_product.php?productid={$row['productid']}\">Delete</a></p></div>
            </div>
          </div>
        </article>
      </div>
     ";

  }
?>

      <div class="hero">
      <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($nope = true){
            print '<p class="is-danger">The product could not be deleted.</p>';
            $yup = false;
            } elseif ($yup = true){
            print '<h6 class="is-success">The product has been deleted.</h6>';
            $nope = false;
            }
        }
      ?>
    </div>
 <?php

 $current_file = 'edit_products.php';
 include('./includes/footer.php');
   ?>
