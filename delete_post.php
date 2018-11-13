<?php
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);
//delete from blog
//redirect if not valid user


if (!isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
$id = $_GET['blogid'];
$query = "DELETE FROM `blogposts` WHERE `blogid`=$id";
$result = mysqli_query($dbc, $query); // Execute the query.
//if successful redirect and pass yup
if (mysqli_affected_rows($dbc) == 1) {
    $destination = 'post_select.php?$yup=true';
    $protocol = 'http://';
    $url = $protocol . BASE_URL . $destination;
    header("Location: $url");
    $yup = TRUE;
} else {
    //redirect to edit blog pass nope
    $destination = 'post_select.php?$nope=true';
    $protocol = 'http://';
    $url = $protocol . BASE_URL . $destination;
    header("Location: $url");
    $nope = TRUE;
    exit();
}
?>
 <footer>
 <?php

 $current_file = 'delete_post.php';
 include('./includes/footer.php');
   ?>
 </footer>
