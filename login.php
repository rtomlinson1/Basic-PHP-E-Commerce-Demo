<?php
//have to buffer output to allow the session to regerate and still include the header and menus.
ob_start();
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);
$login_errors = array();

// Validate username
if (!empty($_POST['username'])) {
  $unsafe_u = $_POST['username'];
  $u = mysqli_real_escape_string($dbc, $unsafe_u);


} else {
	$login_errors['username'] = 'Please enter a valid username!';
  echo "<div class='container'><div class='notification is-danger'>
    <p>Please enter a valid username!</p>
  </div></div>";

}

// make sure password is not empty before sending
if (!empty($_POST['password'])) {
	$unsafe_p = $_POST['password'];
  $p = mysqli_real_escape_string($dbc, $unsafe_p);

} else {
	$login_errors['password'] = 'Please enter your password!';
  echo "<div class='container'><div class='notification is-danger'>
    <p>Please enter a password!</p>
  </div></div>";

}

if (empty($login_errors)) { // no errors? submit query

	//SQL query to database
	$q = "SELECT id, username, type, password FROM users WHERE username='$u'";
	$r = mysqli_query($dbc, $q);
//check database for entry
	if (mysqli_num_rows($r) === 1) { // A match was made.
		// fetch data
		$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
//check for password match
		if ($p === $row['password']) {   // Correct!
			//check for administrator
			if ($row['type'] === 'admin') {
				session_regenerate_id(true);
        $_SESSION['user_admin'] = true;
        echo '<div class="container">
                <h3 class="is-success hero is-size-5 pl-1">Login Success</h3>
                <p class="is-success hero is-size-5 pl-1"> You are logged in with admin permissons.
                </p>
                ';
			} elseif ($row['type'] === 'publisher'){
        session_regenerate_id(true);
        $_SESSION['user_publisher'] = true;
        echo '<div class="container">
                <h3 class="is-success hero is-size-5 pl-1">Login Success</h3>
                <p class="is-success hero is-size-5 pl-1">You are logged in with publisher permissons.
                </p>
                ';
      } elseif ($row['type'] === 'customer'){
        session_regenerate_id(true);
        $_SESSION['user_customer'] = true;
        echo '<div class="container">
              <h3 class="is-success hero is-size-5 pl-1">Login Success</h3>
              <p class="is-success hero is-size-5 pl-1">You are logged in as a customer.
              </p>'
              ;
      }
      echo '<p class="is-success hero is-size-5 pl-1">You are being redirected to the Products page.</p></div>';
      $destination = 'products.php';
      $protocol = 'http://';
      $url = $protocol . BASE_URL . $destination;
      echo "<meta http-equiv='refresh' content='3;url=$url'>";

      //had to add buffer function to solve this error as noted earlier
      //Warning: session_regenerate_id(): Cannot regenerate session id
      //- headers already sent in /hsphere/local/home/ryantomlinson/trywebdev.com/phpproject/login.php on line 53

      exit();
    }elseif (isset($_SESSION['user_customer']) || isset($_SESSION['user_publisher']) || isset($_SESSION['user_admin'])) {
      echo "<div class='container'><div class='notification is-warning'><h1>You are already logged in.<br /> Please logout first to switch users.</h1></div></div>";
    }
        // store temp data
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];



		} else { //wrong username
      $login_errors['login'] = 'Incorrect username.';
      echo "<div class='container'><div class=\"notification is-danger\">
        <p>Incorrect Username.</p>
      </div></div>";
		}

	} else { 	//wrong username and password
		$login_errors['login'] = 'The username password do not match those on file.';
    echo "<div class='container'><div class='notification is-danger'>
      <p>Username and password do not match our records.</p>
    </div></div>";
	}


?>

<form class="container" action="login.php" method="POST">
  <h3 class="is-size-3">Login</h3>
  <div class="field is-grouped navbar-item">
    <p class="control has-icons-left has-icons-right">
      <input class="input" type="username" name="username" placeholder="Username">
      <span class="icon is-small is-left">
        <i class="fas fa-user"></i>
      </span>
    </p>
    <p class="control has-icons-left">
      <input class="input" type="password" name ="password" placeholder="Password">
      <span class="icon is-small is-left">
        <i class="fas fa-lock"></i>
      </span>
    </p>
    <p class="control">
      <button type="submit" name="submit" class="button is-primary">
        Submit
      </button>
    </p>
  </div>

</form>


<?php $current_file = 'login.php';
 include('./includes/footer.php'); ?>
