<nav>
	<ul>
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
				echo "<li><a href='disconnect.php'>Your Account</a></li>";
			}
			else
			{
				echo "<li><a href='login-page.php'>Login</a></li>";
				echo "<li><a href='register-page.php'>Sign In</a></li>";
			}
		
		
		
		?>
		
	</ul>
</nav>