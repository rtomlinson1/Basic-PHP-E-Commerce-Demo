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
//if its coming from the edit_users page...
//get the user info
if (isset ($_GET['id']) && ($_GET['id'] > 0)) {
    $id = $_GET['id'];
    $query = "SELECT `id`, `username`, `password`, `type`, `email`, `firstname`, `lastname` FROM `users` WHERE id=$id";

    if($result = mysqli_query($dbc, $query)){
        $row = mysqli_fetch_array($result);
        //make form
        echo '
        <h1 class="is-size-1">Edit User</h1>
        <div class="columns">
          <div class="column is-half-tablet pl-1 form-fix">
            <form action="edit_user.php" method="post">
              <h6 class="is-size-3">' . $row['lastname'] . ', ' . $row['firstname'] . '</h6>
              <div class="field">
                <label class="label" for="username">Username:</label>
                <div class="control">
                  <input class="input" type="text" name="username" value="'. $row['username'] .'" />
                </div>
              </div>
              <div class="field">
                <label class="label" for="password">Password:</label>
                <div class="control">
                  <input class="input" type="password" name="password" value="'. $row['password'] .'" />
                </div>
              </div>
              <div class="field">
                <label class="label" for="type">User Level:</label>
                <div class="select">
                  <select name="type">
                      <option name="customer" value="customer" selected="selected">Customer</option>
                      <option name="publisher" value="publisher" >Publisher</option>
                      <option name="admin" value="admin" >Admin</option>
                  </select>
                </div>
              </div>
              <div class="field">
                <label class="label" for="email">Email:</label>
                <div class="control">
                  <input class="input" type="email" name="email" value="'. $row['email'] .'" />
                </div>
              </div>
              <div class="field">
                <label class="label" for="firstname">First Name:</label>
                <div class="control">
                  <input class="input" type="text" name="firstname" value="'. $row['firstname'] .'" />
                </div>
              </div>
              <div class="field">
                <label class="label" for="lastname">Last Name:</label>
                <div class="control">
                  <input class="input" type="text" name="lastname" value="'. $row['lastname'] .'" />
                </div>
              </div>
              <input type="hidden" name="id" value="'.$_GET['id'].'" />
              <input class="button is-warning" type="submit" value="Update" />
            </form>
          </div>

        </div>
        ';

    } else {
        echo 'error:';

        mysqli_error($dbc);

        print "query was:  $query";}

  //if we are running this script from this page...
 } elseif (isset ($_POST['id']) && ($_POST['id'] > 0)) {
    $missing_field = false;
    $id = $_GET['id'];
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])){
        $username = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['username'])));
        $password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password'])));
        $type = $_POST['type'];
        $email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['email'])));
        $firstname = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['firstname'])));
        $lastname = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['lastname'])));

    } else {
        echo '<h5 class="is-danger hero">All forms must be filled out!</h5>';
        $missing_fields = TRUE;
    }
    //Future error check - check that username is not any other username in the database if changing
    if (!$missing_fields) {
        $query = "UPDATE `users` SET `username`='$username', `password`='$password', `type`='$type', `email`='$email', `firstname`='$firstname', `lastname`='$lastname'  WHERE id={$_POST['id']}";
        if($result = mysqli_query($dbc, $query)){
            print '<p>User updated.</p>';
          } else {
            print '<p class="red">Could not edit user. Reason: <br>' . mysqli_error($dbc) . '.</p><p>Query: ' . $query . '</p>';
          }
    }


} else {
    echo '<h2 class="is-danger hero">Error. No User selected.</h2>';
}
    mysqli_close($dbc);


 ?>


 <footer>
 <?php

 $current_file = 'edit_user.php';
 include('./includes/footer.php');
   ?>
 </footer>
