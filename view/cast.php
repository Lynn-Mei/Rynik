<html>
<head>
	<link rel="stylesheet" href="index.css" />
</head>
<body>
	<header>
		<nav>
			<h1>Rynik</h1>
			<ul id="nav-pages">
				<li><a href="index.php">Home</a></li>
				<li><a href="silverfox.php">Silverfox</a></li>
				<?php
					if(isset($_SESSION['rank']))
					{
						if($_SESSION['rank']==2)
						{
							echo "<li><a href='disconnect.php'>Admin board</a></li>";
						}
						echo "<li><a href='disconnect.php'>Log Out</a></li>";

					}
					else
					{
						echo "<li><a href='login-page.php'>Login</a></li>";
						echo "<li><a href='register-page.php'>Sign In</a></li>";
					}
				?>
				
			</ul>

			<ul id="nav-account-details">
				<li id="param-box">
					<img id="cog" src="images/cog.png">
				</li>
				<li id="profile-box">
					<?php 
						if(isset($_SESSION['pplink']))
						{
							if($_SESSION['pplink'] != ''){
								echo "<img id='profile-img' src='". $_SESSION['pplink'] ."'>";
							}
							else{
								echo "<img id='profile-img' src='images/chicken.png'>";
							}
						}else{
							echo "<img id='profile-img' src='images/chicken.png'>";
						}
					
					?>
					
				</li>
			</ul>
			<div id="nav-profile-box-div">
				<?php
					if(isset($_SESSION['name'])){
						echo "<p>".$_SESSION['name']."</p>";
						echo "<a href='account-page.php'> Your Profile </a>";

					}else{
						echo "<p>You are not connected</p>";
					}
				?>
			</div>
			<script src="js/profile.js"></script>
		</nav>
	</header>
	<main>

	</main>
</body>
</html>