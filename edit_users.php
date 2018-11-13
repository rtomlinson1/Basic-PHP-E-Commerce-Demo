<?php
include('./includes/config.inc.php');
require(MYSQL);
include('./includes/header.php');
include('./includes/menu.php');

if (!isset($_SESSION['user_admin'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}

?>
 <h1 class="is-size-1">Edit Users</h1><br />
 <div class="columns">
   <div class="column is-half-tablet pl-1">
<?php
//get all users and display each one.
//include a delete button for each user

    $query = "SELECT `id`, `username`, `password`, `type`, `email`, `firstname`, `lastname` FROM `users` LIMIT 0 , 30";
    $result = mysqli_query($dbc, $query);


    while($row = mysqli_fetch_array($result) ) {

      echo '<div class="mob-form p-0-auto">
              <h4 class="is-size-4 has-text-weight-bold">' . $row['username'] .'</h4>
              <span class="is-size-5 has-text-weight-bold">' . $row['lastname'] . ', ' . $row['firstname'] . '</span><br>
              <span class="has-text-weight-bold">User Level: </span><span>' . $row['type'] . '</span><br>
              <span class="has-text-weight-bold">Email: </span><span>' . $row['email'] . '</span><br>
              <span class="has-text-weight-bold">Password: </span><span>' . $row['password'] . '</span><br>
              <span class="has-text-weight-bold">First Name: </span><span>' . $row['firstname'] . '</span><br>
              <span class="has-text-weight-bold">Last Name: </span><span>' . $row['lastname'] . '</span><br><br>
     ';

     print "<p class=\"\"><a class=\"button is-warning\" href=\"edit_user.php?id={$row['id']}\">Edit</a>

     <a class=\"button is-danger\" href=\"delete_user.php?id={$row['id']}\">Delete</a></p></div><br>";
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($nope = true){
      print '<p class="is-danger hero">The user could not be deleted.</p>';
      $yup = false;
      } elseif ($yup = true){
      print '<h6 class="is-success hero">The user has been deleted.</h6>';
      $nope = false;
      }
  }
?>
      </div>
  </div>

<?php

 $current_file = 'edit_users.php';
 include('./includes/footer.php');
?>
