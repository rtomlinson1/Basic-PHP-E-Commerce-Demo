<?php
include('./includes/config.inc.php');
include('./includes/header.php');
include('./includes/menu.php');
require(MYSQL);

if (!isset($_SESSION['user_admin'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = '';
	// form validation
	$missing_fields = FALSE;
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		$username = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['username'])));
		$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password'])));
        if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
            $first =  mysqli_real_escape_string($dbc, trim(strip_tags($_POST['firstname'])));
            $last = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['lastname'])));
            $type = $_POST['type'];
            if (!empty($_POST['email'])) {
                $email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['email'])));
            }
        } else {
            print '<p class="is-danger hero">Please enter a first and last name.</p>';
		    $missing_fields = TRUE;
        }
    } else {
		print '<p class="is-danger hero">Please enter a username and a password.</p>';
		$missing_fields = TRUE;
	}

	$username_taken = FALSE;
	$query = "SELECT `username` FROM `users`";
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result);
//check for duplicate user
	while($row = mysqli_fetch_array($result) ) {
		if($username == $row['username']){
			$username_taken = TRUE;
		}
	}


	if (($missing_fields == FALSE) && ($username_taken == FALSE)) {
		// Define the query:
		$query = "INSERT INTO users (id, username, password, type, email, firstname, lastname ) VALUES (0, '$username', '$password', '$type', '$email', '$first', '$last')";
		// Execute the query:
		if (@mysqli_query($dbc, $query)) {
			print '<p>User added successfully!</p>';
		}
	}elseif ($username_taken == TRUE) {
		echo '<p class="is-danger hero is-size-4">Username already taken. Please select another.</p>';
	}elseif ($missing_fields == TRUE) {
		echo '<p class="is-warning hero is-size-4">Please fill out all fields.</p>';
	} else {
		print '<p class="is-danger hero is-size-4">User not added: <br>' . mysqli_error($dbc) . '.</p><p>Query: ' . $query . '</p>';
	}
	mysqli_close($dbc);
}
?>
<body>
		<h1 class="is-size-1 pl-1">Add User</h1>
		<div class="columns">
			<div class="column pl-1 is-half-tablet form-fix">
				<form action="add_user.php" method="post">
					<div class="field">
						<label class="label" for="username">Username:</label>
						<div class="control has-icons-left">
							<input class="input" type="text" name="username" placeholder="Username" value="">
							<span class="icon is-small is-left">
			          <i class="fas fa-user"></i>
			        </span>
						</div>
					</div>
					<div class="field">
						<label class="label" for="password">Password:</label>
						<div class="control has-icons-left">
							<input class="input" type="password" name="password" placeholder="Password" value="">
							<span class="icon is-small is-left">
			          <i class="fas fa-key"></i>
			        </span>
						</div>
					</div>
					<div class="field">
						<label class="label" for="email">Email:</label>
						<div class="control has-icons-left">
							<input class="input" type="email" name="email" placeholder="jim@example.com" value="">
							<span class="icon is-small is-left">
			          <i class="fas fa-envelope"></i>
			        </span>
						</div>
					</div>
					<div class="field">
						<label class="label" for="firstname">First Name:</label>
						<div class="control has-icons-left">
							<input class="input" type="text" name="firstname" placeholder="John" value="">
							<span class="icon is-small is-left">
			          <i class="fas fa-file-signature"></i>
			        </span>
						</div>
					</div>
					<div class="field">
						<label class="label" for="lastname">Last Name:</label>
						<div class="control has-icons-left">
							<input class="input" type="text" name="lastname" placeholder="Doe" value="">
							<span class="icon is-small is-left">
								<i class="fas fa-file-signature"></i>
							</span>
						</div>
					</div>
					<div class="field">
						<label class="label" for="type">User Type:</label>
						<div class="select">
							<select name="type">
		              <option selected="selected" value="customer">Customer</option>
		              <option value="publisher">Publisher</option>
		              <option value="admin">Administrator</option>
		          </select>
						</div>
					</div>

		    	<input class="button is-success" type="submit" name="submit" value="Submit">
		    </form>
			</div>
		</div>

  </body>

<?php
    $current_file = 'add_user.php';
    include('./includes/footer.php');
?>
