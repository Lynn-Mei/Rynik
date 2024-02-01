<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	foreach($stylesheets as $name){
		echo "<link rel='stylesheet' href='css/".$name.".css'/>";
	}
	?>
</head>
<body>
	<header>
		<div id="title">
			<h1>Sezalang</h1>
		</div>

	</header>
	</br></br></br></br>
	<ul id="toolbar">
		<a href='index.php'><li>Home</li></a>
		<a href='index.php'><li>Lessons</li></a>
		<a href='index.php'><li>Dictionary</li></a>
		<a href='index.php'><li>Practice</li></a>
		<a href='index.php'><li>Hey</li></a>
		<?php
			if(isset($_SESSION['token']))
			{
				echo "<a href='index.php?action=log-out'><li>Log Out</li></a>";

			}
			else
			{
					echo "<a href='index.php?action=log-in'><li>Login</li></a>";
					echo "<a href='index.php?action=sign-in'><li>Sign In</li></a>";
			}
		?>
		<div>
			<?php
				if(isset($_SESSION['account']))
				{
					$hey = ["path"=>$_SESSION['account']->getProfilPicLink()];
					$this->addReusable("reusable/profilePicture", $hey);
				}
			?>
		</div>
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