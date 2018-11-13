<?php
 session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
    <title>Monday's - a great cup of coffee to start your week right.</title>

  </head>
  <body>
    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="">
          <img src="./images/coffeelogo.png" width="30" height="30">
        </a>

        <a role="button" id="navbar-menu" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar-menu">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>

      <div class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href="index.php">
            Home
          </a>

          <a class="navbar-item" href="products.php">
            Products
          </a>

          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link" href="about.php">
              About
            </a>

            <div class="navbar-dropdown">
              <a class="navbar-item" href="about.php">
                Our Story
              </a>
              <a class="navbar-item" href="location.php">
                Locations
              </a>
              <a class="navbar-item" href="blog.php">
                Blog
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item">
                Report an issue
              </a>
            </div>

          </div>
    			<?php
    			if (isset($_SESSION['user_customer'])) {
    				echo '<a class="navbar-item" href="cart.php">Cart</a>';
    			}
    			if (isset($_SESSION['user_publisher'])) {
    				echo '<a class="navbar-item" href="cart.php">Cart</a>';

    				echo '<div class="navbar-item has-dropdown is-hoverable">
    								<a class="navbar-link" href="about.php">
    									Publisher Tasks
    								</a>
    								<div class="navbar-dropdown">
    									<a class="navbar-item" href="add_product.php">Add a Product</a>
    									<a class="navbar-item" href="edit_products.php">Edit a Product</a>
    									<a class="navbar-item" href="add_page.php">Add a Blog Post</a><
    									<a class="navbar-item" href="post_select.php">Edit the Blog</a>
    								</div>
    							</div>';
    			}
    			if (isset($_SESSION['user_admin'])) {
    				echo '<a class="navbar-item" href="cart.php">Cart</a>';
    				echo '<div class="navbar-item has-dropdown is-hoverable">
    								<a class="navbar-link" href="about.php">
    									Admin Tasks
    								</a>
    								<div class="navbar-dropdown">
    									<a class="navbar-item" href="add_product.php">Add a Product</a>
    									<a class="navbar-item" href="edit_products.php">Edit a Product</a>
    									<a class="navbar-item" href="add_user.php">Add a User</a>
    									<a class="navbar-item" href="edit_users.php">Edit a User</a>
    									<a class="navbar-item" href="add_page.php">Add a Blog Post</a>
    									<a class="navbar-item" href="post_select.php">Edit the Blog</a>
    								</div>
    							</div>';




    			}
    			?>
        </div>
    		<div class="navbar-end">
    			<?php
    			if ((!isset($_SESSION['user_customer']))&&(!isset($_SESSION['user_publisher']))&&(!isset($_SESSION['user_admin']))){
    				echo '
    				<form class="" action="login.php" method="POST">
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

    				</form>';
    	}else {
    				echo '<a class="navbar-item" href="logout.php">Logout</a>';
    			}

    			?>
    		</div>
      </div>
    </nav>
    <div class="hero is-dark has-text-centered">
    	<h1 class="title is-size-1 hero-body">Monday's Coffee - the perfect way to start your day!</h1>
    </div>
