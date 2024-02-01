<p>HEy Hey</p>
<form>
	<input type="text" name="username" id="username" value="<?php echo $_SESSION["account"]->getUsername(); ?>" placeholder="username" required=""/>
	<input type="email" name="email" id="email" value="<?php echo $_SESSION["account"]->getEmail();?>" placeholder="email" required=""/>
</form>