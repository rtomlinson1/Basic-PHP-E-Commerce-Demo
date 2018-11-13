<?php
include('./includes/header.php');
include('./includes/menu.php');
//this page can be modified to produce dynamic content from a database
 ?>
    <div class="flex-container">
        <div class="flex-item left-sidebar">
<!--Eventually this should all be dynamically generated, once a database is set up for CMS-->
          <h3>All Blog Posts</h3>
          <a href="welcome.php">Welcome</a>
          <a href="sale.php">Sale on Columbian Coffee</a>
          <a href="openmicnight.php">Open Mic Night</a>
        </div>
        <div class="flex-item middle-col">
          <h2></h2>
          <h4></h4>
          <p></p>
        </div>
        <div class="flex-item right-sidebar">
          <h3>Popular Coffees This Month</h3>

          <a href="products/coffees/columbian.php">
            <img src="images/coffeebags/columbian.jpg" alt="Columbian bagged coffee. 16 oz Ground">
            Columbian 16oz ground</a>

          <a href="products/coffees/kona.php">
            <img src="images/coffeebags/kona.jpg" alt="Kona Hawaiian ground coffee. 16 oz bag.">
            Kona 16oz ground</a>

          <a href="products/coffees/espresso.php">
            <img src="images/coffeebags/espresso2.jpg" alt="Espresso dark roast whole beans. 3 pounds.">
            Espresso 48oz Whole</a>
        </div>
      </div>
    </div>
    <footer>
      <?php
      $current_file = 'blog_template.php';
      include('./includes/footer.php');
       ?>

    </footer>
  </body>
</html>
