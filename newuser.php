<?php
include "base.php";
include "./layout/header.php"
?>

	<div id="main">
		<?php
		if (!empty($_POST['username']) && !empty($_POST['password'])) {

			$username =  $conn->real_escape_string($_POST['username']);
			$password = md5($conn->real_escape_string($_POST['password']));
			$email = $conn->real_escape_string($_POST['email']);
			
			$query = "SELECT * FROM users2 WHERE Username = '" . $username . "'";
			$result =  $conn->query($query);
			if (!$result) {
				echo "<p>Error in database query</p>";
			}
			if ($result->num_rows == 1) {
				echo "<h1>Error</h1>";
				echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
			} else {
				$query = "INSERT INTO users2 (UserID, Username, Password, Email) VALUES(NULL,'" . $username . "', '" . $password . "', '" . $email . "')";
				$result =  $conn->query($query);
				if ($result) {
					echo "<h1>Success</h1>";
					echo "<p>Your account was successfully created. Please <a href=\"index.php\">click here to login</a>.</p>";
				} else {
					$error = $conn->error;
					echo "<h1>Error</h1>";
					echo "<p>Sorry, your registration failed. Please go back and try again.".$error."</p>";
				}
			}
		} else {
		?>
			<h1>Register</h1>
			<p>Please enter your details below to register.</p>
			<form method="post" action="newuser.php" name="registerform" id="registerform">
				<fieldset>
					<label for="username">Username:</label><br><input type="text" name="username" id="username" />
					<br>
					<label for="password">Password:</label><br><input type="password" name="password" id="password" />
					<br>
					<label for="email">Email Address:</label><br>
					<input type="text" name="email" id="email" />
					<br>
					
					<input type="submit" name="register" id="register" value="Register" />
				</fieldset>
			</form>
		<?php
		}
		?>
	</div>
	<?php
include "./layout/footer.php"
?>