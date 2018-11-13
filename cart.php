<?php

include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);
if (!isset($_SESSION['user_customer']) && !isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'needlogin.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
//validate post
if($_SERVER['REQUEST_METHOD'] == 'POST'){
//see if cart exists and create if not
  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();

  }
  //add item and quantity if they are set correctly
  if (isset($_POST['item']) && isset($_POST['price']) && isset($_POST['qty'])){
    //create array for item
    //probably should have indexed them with names instead of integers for expandability
    $cart_item = array(0 => $_POST['item'], 1 => $_POST['price'], 2 => $_POST['qty']);
    //put it in the Cart

    $_SESSION['cart'][] = $cart_item;
    if (isset($_POST['update_qty'])){
      $_POST['qty'] = $_POST['update_qty'];
    }
  //deleting an item from the cart
  }elseif (isset($_POST['delete'])){
    //unset individual item from array
    if (!empty($_SESSION["cart"])) {
      $item = $_POST["delete"];
      $item_name = $_POST["item_name"];
      $item_qty = $_POST["item_qty"];

      //see whats getting posted
      //print_r($_POST);
      if ($item_qty > 1){
        $_SESSION['cart'][$item][2] = $_SESSION['cart'][$item][2] - 1;
        echo'<p class="is-size-4 is-success hero">1 Item "'.$item_name.'" Removed</p>';

      }else{
        unset($_SESSION['cart'][$item]);
        $_SESSION['cart'] = array_merge($_SESSION['cart']);
        echo'<p class="is-size-4 is-success hero">Item "'.$item_name.'" Removed</p>';
      }

    }else{
      echo'<p class="is-size-4 is-warning hero">Item Removed Failure</p>';

    }
  //delete entire cart
  }elseif(isset($_POST['empty_cart'])){
    $_SESSION['cart'] = array();
  }elseif(isset($_POST['update'])){
    if (!empty($_POST['update_qty_num'])){
      $item = $_POST["update"];
      //print_r($_POST);
      $_SESSION['cart'][$item][2] = $_POST['update_qty_num'];
      echo '<p class="is-success hero">Qty updated successfully</p>';
    }else {
      echo'<p class="is-size-4 is-warning hero">Qty Change Failure</p>';
    }

  }
}
?>
<div class="container">
<div class="has-text-centered">
  <h1 class="is-size-1">Shopping Cart</h1>
  <p>Items you have added to your cart:</p>
  <p class="has-text-weight-bold">Free shipping for orders over $50.00USD</p>
  <br>
  <br>
  <hr>
</div>



<?php
if (!empty($_SESSION['cart'])){
  //print_r($_SESSION)['cart'];
  $i = 0;
  //print_r($_SESSION['cart']);
  //$string_words = implode('<br />', $cart_item);
  foreach($_SESSION['cart'] as list($a, $b, $c)){

  echo '<table class="table">
          <tbody>
            <tr>
              <td>Item:</td><td>'.$a.'</td>
            </tr>
            <tr>
              <td>Price:</td><td>$ &nbsp;'.$b.'</td>
            </tr>
            <tr>
              <td>QTY:</td><td>'.$c.'</td>
            </tr>
            <tr>
              <td>New QTY:</td>
              <td>
                <form class="cart_actions" action="cart.php" method="POST">
                  <input class="input" type="text" name="update_qty_num" style="width:2rem;">
                  <button class="button is-primary pl-1" type="submit" name="update" value="'.$i.'">Update</button>
                </form>
              </td>
            </tr>
            <tr>
              <td>
              <form class="cart_actions" action="cart.php" method="post">
                <input type="hidden" name="item_name" value="'.$a.'">
                <input type="hidden" name="item_qty" value="'.$c.'">
                <button class="button is-danger pl-1" type="submit" name="delete" value="'.$i.'">Delete</button>
              </form>
              </td>
            </tr>
          </tbody>
        </table>
        <br />
        <br />

  ';
  $i++;
          //subtotal algorithm
          if (!isset($subtotal)){$subtotal = 0;}
          $subtotal = number_format($subtotal + ($c * $b), 2);

  }
          //subtotal + tax + shipping = total
          if ($subtotal < 50){
            $shipping = number_format(5.99, 2);
          }else{
            $shipping = number_format(0.00, 2);
          }
          $tax = number_format(($subtotal * .07), 2);
          if (!isset($total)){$total = 0;}
          $total = number_format(($subtotal + $total + $tax + $shipping), 2);

  echo "<hr>
          <table class=\"table\">
            <tbody>
              <tr>
                <td><em>Subtotal =</em> </td><td>$$subtotal</td>
              </tr>
              <tr>
                <td>Tax (7%) =</td><td>$$tax</td>
              </tr>
              <tr>
                <td>Shipping = </td><td>$$shipping</td>
              </tr>
              <tr>
                <td><strong>Total =</strong> </td><td>$$total</td>
              </tr>
            </tbody>

        </table>";

  // print "<div class=\"columns\">
  //         <div class=\"column is-centered is-half has-text-centered\">
  //         <p><em>Subtotal =</em> \$ $subtotal</p>
  //         <p><span>Tax (7%) =</span> \$ $tax</p>
  //         <p>Shipping = \$ $shipping</p>
  //         <p><strong>Total =</strong> \$ $total USD</p>
  //         </div>
  //       </div>";
  echo '<div class="columns is-multiline">
          <div class="column is-full pl-1">
            <form class="cart_actions" action="cart.php" method="post">
              <button class="button is-danger pl-1" type="submit" name="empty_cart" value="Empty Cart">Empty Cart</button>
            </form>
          </div>
          <div class="column is-full pl-1">
            <form class="cart_actions" action="checkout.php" method="post">
              <button class="button is-success pl-1" type="submit" name="checkout" value="Checkout">Checkout</button>
            </form>
          </div>';
}else{//if cart is empty
  print "<p class=\"has-text-centered has-text-weight-bold is-size-4\">Your cart is empty</p>";
}
//empty cart button
 ?>
</div>
</div>
<?php
$current_file = 'cart.php';
include('./includes/footer.php'); ?>
