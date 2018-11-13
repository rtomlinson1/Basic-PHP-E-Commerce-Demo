<?php
include('./includes/header.php');
include('./includes/menu.php');
include('./includes/config.inc.php');
require(MYSQL);

 ?>
    <div class="columns is-multiline">
        <div class="column is-one-quarter">

          <h3 class="has-text-centered is-size-3">All Blog Posts</h3>
          <div class="blog_list">


<?php
//create links for each blog post and reference the id of the post to link to it.
  $query = "SELECT `title` FROM `blogposts`";
  $result = mysqli_query($dbc, $query);
  $row = mysqli_fetch_array($result);
  while($row = mysqli_fetch_array($result) ) {
    echo '<a class="pl-1 has-text-black blog_links" href="#' . $row['title'] . '">' . $row['title'] . '</a><br />';

  }

?>
          </div>
        </div>
        <div class="column is-half">
<?php
//display each blog post one after another. give each an id tag based on the name.
  $query = "SELECT `title`, `date`, `content` FROM `blogposts`";
  $result = mysqli_query($dbc, $query);
  $row = mysqli_fetch_array($result);
  while($row = mysqli_fetch_array($result) ) {

      echo '
              <h2 class="has-text-centered is-size-2" id="' . $row['title'] . '">' . $row['title'] . '</h2>
              <h6 class="is-size-6 has-text-centered has-text-weight-bold">posted on : ' . $row['date'] . '</h6>
              <p class="has-text-justified">' . $row['content'] . '</p>
              <br>
          ';
  }
?>

        </div>
        <div class="feat_coffee_container column is-one-quarter">
          <h3 class="has-text-centered is-size-4">Popular Coffees This Month</h3>
          <div class="feat_coffee_box">
            <a class="feat_coffee has-text-black" href="productdetails/product.php?detail=columbian">
              <img src="./images/columbian.jpg" alt="Columbian bagged coffee. 16 oz Ground">
              <p class="feat_coffee_text">Columbian 16oz ground</p>
              </a>
          </div>

          <div class="feat_coffee_box">
            <a class="feat_coffee has-text-black" href="productdetails/product.php?detail=kona">
              <img src="./images/kona.jpg" alt="Kona Hawaiian ground coffee. 16 oz bag.">
              <p class="feat_coffee_text">Kona 16oz ground</p>
              </a>
          </div>
          <div class="feat_coffee_box">
            <a class="feat_coffee has-text-black" href="productdetails/product.php?detail=espresso">
              <img src="./images/espresso2.jpg" alt="Espresso dark roast whole beans. 3 pounds.">
              <p class="feat_coffee_text">Espresso 48oz Whole</p>
              </a>
          </div>
        </div>
      </div>
    </div>

<?php
$current_file = 'blog.php';
include('./includes/footer.php');
 ?>
