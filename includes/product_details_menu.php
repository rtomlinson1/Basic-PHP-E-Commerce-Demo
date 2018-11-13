<nav class="navbar is-light" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="">
      <img src="./images/coffeelogo.png" width="30" height="30">
    </a>
    <a role="button" class="navbar-burger" data-target="navbar-menu" aria-label="menu" aria-expanded="false">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>

  </div>

  <div id="navbar-menu"class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="../index.php">
        Home
      </a>

      <a class="navbar-item" href="../products.php">
        Products
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="../about.php">
          About
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="../about.php">
            Our Story
          </a>
          <a class="navbar-item" href="../location.php">
            Locations
          </a>
          <a class="navbar-item" href="../blog.php">
            Blog
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="mailto:rltomlinson@outlook.com?Subject=Issue%20Report">
            Report an issue
          </a>
        </div>

      </div>
			<?php
			if (isset($_SESSION['user_customer'])) {
				echo '<a class="navbar-item" href="../cart.php">Cart</a>';
			}
			if (isset($_SESSION['user_publisher'])) {
				echo '<a class="navbar-item" href="../cart.php">Cart</a>';

				echo '<div class="navbar-item has-dropdown is-hoverable">
								<a class="navbar-link" href="../about.php">
									Publisher Tasks
								</a>
								<div class="navbar-dropdown">
									<a class="navbar-item" href="../add_product.php">Add a Product</a>
									<a class="navbar-item" href="../edit_products.php">Edit a Product</a>
									<a class="navbar-item" href="../add_page.php">Add a Blog Post</a><
									<a class="navbar-item" href="../post_select.php">Edit the Blog</a>
								</div>
							</div>';
			}
			if (isset($_SESSION['user_admin'])) {
				echo '<a class="navbar-item" href="../cart.php">Cart</a>';
				echo '<div class="navbar-item has-dropdown is-hoverable">
								<a class="navbar-link" href="../about.php">
									Admin Tasks
								</a>
								<div class="navbar-dropdown">
									<a class="navbar-item" href="../add_product.php">Add a Product</a>
									<a class="navbar-item" href="../edit_products.php">Edit a Product</a>
									<a class="navbar-item" href="../add_user.php">Add a User</a>
									<a class="navbar-item" href="../edit_users.php">Edit a User</a>
									<a class="navbar-item" href="../add_page.php">Add a Blog Post</a>
									<a class="navbar-item" href="../post_select.php">Edit the Blog</a>
								</div>
							</div>';




			}
			?>
    </div>
		<div class="navbar-end">
			<?php
			if ((!isset($_SESSION['user_customer']))&&(!isset($_SESSION['user_publisher']))&&(!isset($_SESSION['user_admin']))){
				echo '
				<form class="" action="../login.php" method="POST">
					<div class="field navbar-item">
						<p class="mar-1 control has-icons-left has-icons-right">
							<input class="input" type="username" name="username" placeholder="Username">
							<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
							</span>
						</p>
						<p class="mar-1 control has-icons-left">
							<input class="input" type="password" name ="password" placeholder="Password">
							<span class="icon is-small is-left">
								<i class="fas fa-lock"></i>
							</span>
						</p>
						<p class="mar-1 control">
							<button type="submit" name="submit" class="button is-primary">
								Submit
							</button>
						</p>
					</div>

				</form>';
	}else {
				echo '<a class="navbar-item" href="../logout.php">Logout</a>';
			}

			?>
		</div>
  </div>
</nav>
<div class="hero is-dark has-text-centered">
	<h1 class="title is-size-1 hero-body">Monday's Coffee - the perfect way to start your day!</h1>
</div>
<script type="text/javascript" src="../js/main.js">

</script>
