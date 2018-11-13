<?php
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);

if (!isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// form validation
	$missing_fields = FALSE;
	if (!empty($_POST['title']) && !empty($_POST['entry'])) {
		$title = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['title'])));
		$entry = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['entry'])));
	} else {
		print '<p class="is-danger hero">Please submit both a title and an entry.</p>';
		$missing_fields = TRUE;
	}
	if (!$missing_fields) {
		// Define the query:
		$query = "INSERT INTO blogposts (blogid, title, content, date) VALUES (0, '$title', '$entry', NOW())";
		// Execute the query:
		if (@mysqli_query($dbc, $query)) {
			print '<p class="is-success hero">Blog post added successfully!</p>';
		} else {
			print '<p class="is-danger hero">Post unsuccessful: <br>' . mysqli_error($dbc) . '.</p><p>Query: ' . $query . '</p>';
		}
	}
	mysqli_close($dbc);
}
?>
<body>
		<h1 class="is-size-1 pl-1">Add A Blog Post</h1><br><br>
		<div class="columns">
			<div class="column pl-1">
				<form action="add_page.php" method="post">
					<div class="field">
						<label class="label" for="title">Title: </label>
						<div class="control">
							<input class="input" type="text" name="title">
						</div>
					</div>
					<div class="field">
						<label class="label" for="entry">Content: </label>
						<textarea class="textarea" name="entry" cols="50" rows="10"></textarea />
					</div>
					<input class="button is-success pl-1" type="submit" name="submit" value="Submit"/><br><br>
				</form>
			</div>
		</div>


    </body>

<?php
$current_file = 'add_page.php';
include('./includes/footer.php');
?>
