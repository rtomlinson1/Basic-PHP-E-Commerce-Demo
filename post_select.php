<?php

include('./includes/config.inc.php');
require(MYSQL);
include('./includes/header.php');
include('./includes/menu.php');

if (!isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
?>
 <h1 class="is-size-1 pl-1">Edit Blog Posts</h1><br />
  <div class="columns is-multiline pl-1">

<?php
//get all posts and display each one.
//include a delete button for each ppost

    $query = "SELECT `blogid`, `title`, `content`, `date` FROM `blogposts`";
    $result = mysqli_query($dbc, $query);


    while($row = mysqli_fetch_array($result) ) {

      echo '
      <div class="column is-full">

              <h4 class="is-size-4 has-text-weight-bold">' . $row['title'] . '</h4>
              <p class="is-size-5">' . $row['content'] . '</p>
     ';

     print "<p class=\"\"><a class=\"button is-warning\" href=\"edit_blog.php?blogid={$row['blogid']}\">Edit</a>

     <a class=\"button is-danger\" href=\"delete_post.php?blogid={$row['blogid']}\">Delete</a></p>
     </div>";
  }
?>

      <div class="flex-label">
      <?php
      //conditional to show if post was deleted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($nope = true){
            print '<p class="hero is-danger">The post could not be deleted.</p>';
            $yup = false;
            } elseif ($yup = true){
            print '<h6>The post has been deleted.</h6>';
            $nope = false;
            }
        }
      ?>
      </div>
  </div>

 <footer>
 <?php

 $current_file = 'post_select.php';
 include('./includes/footer.php');
   ?>
 </footer>
