<?php
session_start();

$_SESSION = array();

session_destroy();

include('./includes/header.php');
include('./includes/menu.php');

 ?>
<h3 class="is-size-3 hero is-secondary">Logged Out</h3>
<p class="hero is-size-5 is-success">You have successfully logged out. Please come back again soon.</p>


<?php
  $current_file = 'logout.php';
  include('./includes/footer.php');
?>
