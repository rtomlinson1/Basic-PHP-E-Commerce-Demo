<?php

include('./includes/config.inc.php');
require(MYSQL);
include('./includes/header.php');
include('./includes/menu.php');
//each product is given a name, price and quantity selector, and is passed
//through to the cart via the add to cart button using post.

//if the user clicks on the image or title, they are taken to a page that
//shows the item in greater detail and adds a description.

//redirect if not valid user


if (!isset($_SESSION['user_customer']) && !isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'needlogin.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}

 ?>
 <div class="container is-fluid">
   <h3 class="is-size-3 title">Products:</h3><br />
   <h4 class="is-size-4 subtitle">Free Shipping on orders over $50USD!!!</h4>
   <p class="subtitle">We ship only to the contiguous US. Please call if buying internationally or in AK/HI.</p>
   <br>
   <div class="columns is-multiline">
    <?php
    $query = "SELECT `productid`, `name`, `price`, `desc`, `qty`, `img`, `detail` FROM `products`";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    while($row = mysqli_fetch_array($result) ) {
      $detail = $row['detail'];
      echo '
      <div class="column is-one-quarter">
          <a href="productdetails/product.php?detail='. $detail .'">
            <img style="width:100%; height:70%;" src="images/'. $row['img'] . '.jpg" alt="' . $row['name'] . '">
            <h6 class="is-size-6 title has-text-centered">'. $row['name'] . '</h6>
            <h6 class="is-size-6 subtitle has-text-centered">$'. $row['price'] .' USD</h6>
          </a>
          <br>
          <form class="add2cart" action="cart.php" method="post">
            <input type="hidden" name="item" value="' . $row['name'] . '">
            <input type="hidden" name="price" value="' . $row['price'] . '">
            <input class="input" type="text" name="qty" value="1" style="width:50px;">
            <button type="submit" name="add" class="button is-success">Add to Cart</button>
          </form>
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
