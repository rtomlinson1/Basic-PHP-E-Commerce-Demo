<?php
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);

if (!isset($_SESSION['user_admin'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
//delete from users
$id = $_GET['id'];
$query = "DELETE FROM `users` WHERE `id`=$id";
$result = mysqli_query($dbc, $query); // Execute the query.
//if successful redirect and pass yup
if (mysqli_affected_rows($dbc) == 1) {
    $destination = 'edit_users.php?$yup=true';
    $protocol = 'http://';
    $url = $protocol . BASE_URL . $destination;
    header("Location: $url");
    $yup = TRUE;
} else {
    //redirect to edit products pass nope
    $destination = 'edit_users.php?$nope=true';
    $protocol = 'http://';
    $url = $protocol . BASE_URL . $destination;
    header("Location: $url");
    $nope = TRUE;
    exit();
}
?>
 <footer>
 <?php

 $current_file = 'delete_user.php';
 include('./includes/footer.php');
   ?>
 </footer>
