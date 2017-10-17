<?php
include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
 $img = $_SESSION['captcha']['image_src'];
?>
<div id="login">
<div data-role="content" data-theme="c" >
  			<h3>Log in</h3>

			<form action="Index.php" method="POST" data-mini="true">


			<div data-role="fieldcontain">
				   			<label for="username" data-mini="true">Username:</label>
							<input type="text"  data-mini="true" class="form-control" name="username" id="username" placeholder="username">
							<br>
				   			<label for="password">Password:</label>
							<input type="password"  class="form-control" id="password" name="password" placeholder="password">

									
							<div id="captcha" >
							<img class="captcha" src="<?php echo $img; ?>"><br>
								  <label for="captcha" class="captcha" data-theme="c" >Type the text:</label><br>

										<input type="text" class="captcha" name="captcha2" placeholder="Type the text" data-theme="b">
							</div>
				</div>
				<a href="register.php" data-role="button" name="register" data-inline="true" data-transition="flow" data-ajax="false" >Register</a> or 

						
							<input type="submit" data-role="button" data-inline="true"  data-theme="b" name="submit" data-transition="flow" value="Log in">

			</form>

</div>


</div>