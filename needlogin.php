<?php

include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);
//print_r($_SESSION);
//this page show up if the user tries to access the products page without logging in.
//it diplays the products, but does not allow them to be added to the cart.
?>
<div class="container is-fluid">
  <div class="notification is-danger">
    <h2 class="is-size-2">Please Login to Continue Shopping!</h2>
    <h3 class="is-size-3">You are not logged in, and will not be able to add items to your cart or checkout.</h3>
  </div>

    <h3 class="is-size-3 title">Products:</h3><br />
    <h4 class="is-size-4 subtitle">Free Shipping on orders over $50USD!!!</h4>
    <p class="subtitle">We ship only to the contiguous US. Please call if buying internationally or in AK/HI.</p>
    <br>
    <div class="columns is-multiline">


<?php
    $query = "SELECT `productid`, `name`, `price`, `desc`, `qty`, `img`, `detail` FROM `products`";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    while($row = mysqli_fetch_array($result)) {
        $detail = $row['detail'];
        echo '
        <div class="column is-one-quarter">
            <a href="productdetails/product.php?detail='. $detail .'">
              <img style="width:100%; height:80%;" src="images/'. $row['img'] . '.jpg" alt="' . $row['name'] . '">
              <h6 class="is-size-6 title has-text-centered">'. $row['name'] . '</h6>
              <h6 class="is-size-6 subtitle has-text-centered">$'. $row['price'] .' USD</h6>
            </a>
      </div>';
    }
    ?>
    </div>
  </div>
</div>
<?php
    $current_file = 'products.php';
    include('./includes/footer.php');
?>
