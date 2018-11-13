<?php

include('./includes/config.inc.php');
require(MYSQL);
//redirect invalid user
if (!isset($_SESSION['user_admin']) && !isset($_SESSION['user_publisher'])){
  $destination = 'index.php';
  $protocol = 'http://';
  $url = $protocol . BASE_URL . $destination;
  echo "<meta http-equiv='refresh' content='0;url=$url'>";

  exit();

}
include('./includes/header.php');
include('./includes/menu.php');
//if its coming from the edit_products page...
//get the product info
if (isset ($_GET['blogid']) && ($_GET['blogid'] > 0)) {
    $id = $_GET['blogid'];
    $query = "SELECT `blogid`, `title`, `content` FROM `blogposts` WHERE blogid=$id";

    if($result = mysqli_query($dbc, $query)){
        $row = mysqli_fetch_array($result);
        //make form
        echo '
        <h1 class="is-size-1 pl-1">Edit Blog Post</h1>
        <form action="edit_blog.php" method="post">
        <div class="columns is-multiline pl-1">
            <div class="column is-full">
                <label for="title">Title: </label><br />
                <input class="is-size-3 has-text-weight-semibold mob-form" type="text" name="title" size="25" maxsize="80" value="'. $row['title'] .'"/>
                <br />
                <br />


            </div>
            <div class="column">
                <label for="entry">Content: </label>
                <br>
                <br>
                <textarea class="is-size-4 mob-form" name="entry" cols="35" rows="10" >'. $row['content'] .'</textarea />
            </div>
        </div>
        <br />
            <input type="hidden" name="blogid" value="'.$_GET['blogid'].'" />
            <div class="pl-1">
              <button type="submit" name="add" class="button is-success">Update</button>
            </div>
        </form>';

    } else {
        echo 'error:';

        mysqli_error($dbc);

        print "query was:  $query";}

  //if we are running this script from this page...
 } elseif (isset ($_POST['blogid']) && ($_POST['blogid'] > 0)) {
    $missing_field = false;
    $id = $_POST['blogid'];
    if(!empty($_POST['title']) && !empty($_POST['entry'])){
        $title = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['title'])));
        $content = $_POST['entry'];

    } else {
        echo '<h5 class="is-danger hero is-size-5">All forms must be filled out!</h5>';
        $missing_fields = TRUE;
    }
    if (!isset($missing_fields)) {
        $query = "UPDATE `blogposts` SET `title`='$title', `content`='$content', `date`= NOW()  WHERE blogid={$_POST['blogid']}";
        if($result = mysqli_query($dbc, $query)){
            print '<p class="hero is-success is-size-5">Post updated.</p>';
          } else {
            print '<p class="hero is-danger is-size-5">Could not edit post. Reason: <br>' . mysqli_error($dbc) . '.</p><p>Query: ' . $query . '</p>';
          }
    }


} else {
    echo '<h2 class="is-size-2 is-danger hero">Error. No post selected.</h2>';
}
    mysqli_close($dbc);


 ?>



 <?php

 $current_file = 'edit_blog.php';
 include('./includes/footer.php');
   ?>
