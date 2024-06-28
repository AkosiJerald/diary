	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="UTF-8">
	<title>Sign up / Login Form</title>
	<link rel="stylesheet" href="style1.css">
		<script src="script1.js"></script>
	</head>

	<body>
		<div class="main">
			<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "diary";

				try {
					$pdo = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);

					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				} catch (PDOException $e) {
					echo $e;
					die();
				}

				if (!empty($_POST['user']) && !empty($_POST['pswd'])) {
					$username = $_POST['user'];
					$pass = $_POST['pswd'];

					try {
						$result = $pdo->query("SELECT * FROM users WHERE username = '$username' AND password = '$pass'");

						if (!empty($result->fetchAll())) {
							
							header("location:diary.php");
						} else {
							$errormsg = "sorry, unrecognized username or password";
						}
					} catch (PDOException $e) {
						echo $e;
					}
				}

				?>
				<form action="login.php" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="user" placeholder="User name" required="">
					<input id="mypass" type="password" name="pswd" placeholder="Password" required="">
					<div class="show">
						<input type="checkbox" onclick="togglePassword()"><p class="showP">Show password</p>
					</div>
					<button>Login</button>
				</form>
			</div>

			<div class="login">
				<?php
				$host = "localhost";
				$user = "root";
				$password = "";
				$database = "diary";

				try {
					$connect = mysqli_connect($host, $user, $password, $database);
				} catch (mysqli_sql_exception $ex) {
					echo 'error';
				}

				if (isset($_POST['user'], $_POST['email'], $_POST['pswd'])) {
					$user = $_POST['user'];
					$email = $_POST['email'];
					$pswd = $_POST['pswd'];

					$insert = "INSERT INTO users(username, email, password) 
               VALUES('$user', '$email', '$pswd')";

					try {
						$insert_result = mysqli_query($connect, $insert);

						if ($insert_result) {
							if (mysqli_affected_rows($connect) > 0) {
								header("location:login.php");
							} else {
								echo 'data not inserted';
							}
						}
					} catch (Exception $ex) {
						echo 'error update' . $ex->getMessage();
					}
				}
				?>
				<form action="login.php" method="post">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="user" placeholder="User name" required>
					<input type="email" name="email" placeholder="Email" required>
					<input id="mypass1" type="password" name="pswd" placeholder="Password" required>
					<div class="show">
						<input type="checkbox" onclick="togglePassword1()"><p class="showP" style="color:black;">Show password</p>
					</div>
					<button>Sign up</button>		
				</form>
			</div>
		</div>
		
	</body>

	</html>
	<!-- partial -->

</body>

</html>