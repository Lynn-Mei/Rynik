<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/index.css"/>
</head>
<body>
	<header>
		<div id="title">
			<h1>Hakumei-Hime</h1>
		</div>

	</header>
	</br></br></br></br>
	<ul id="toolbar">
		<a href='index.php'><li>Home</li></a>
		<a href='index.php'><li>Categories</li></a>
		<a href='index.php'><li>Translator</li></a>
		<a href='index.php'><li>Language</li></a>
		<a href='index.php'><li>Cuisine</li></a>
		<a href='index.php'><li>Sports</li></a>
		<?php
			if(isset($_SESSION['rank']))
			{
				if($_SESSION['rank']==2)
				{
					echo "<a href='index.php'><li>Admin board</li></a>";
				}
				echo "<a href='index.php'><li>Log Out</li></a>";

			}
			else
			{
					echo "<a href='index.php'><li>Login</li></a>";
					echo "<a href='index.php'><li>Sign In</li></a>";
			}
		?>
	</ul>
	<main>
		<?= $contenu; ?>
	</main>
	<footer>
		<a>Conditions generales d'utilisation</a>
		<a>Politique de confidentialite</a>
		<p>Adress</p>
		<p>Infos entreprise et blah blah blah</p>
	</footer>
</body>

</html>