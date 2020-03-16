<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
</head>
<body>
	<div class="login-bg">
		<div class="bg-1"></div>
		<div class="bg-2"></div>
		<div class="bg-3"></div>
		<div class="bg-4"></div>
		<div class="bg-5"></div>
		<div class="card">
			<div class="content">
				<h1>Login</h1>
				<form action="login-handler.php" method="POST">
					<i class="fa fa-user icon"></i>
					<input type="text" name="username" placeholder="Username"/><br>
					<i class="fa fa-key icon"></i>
					<input type="password" name="password" placeholder="Password"/><br>
					<input type="submit" />
					<?php 
					if(isset($_SESSION["errorMessage"])) {
					?>
					<div class="error-message"><?php  echo $_SESSION["errorMessage"]; ?></div>
					<?php 
					unset($_SESSION["errorMessage"]);
					} 
					?>
				</form>
				<a href="#">Forgot Username?</a> | <a href="#">Forgot Password?</a> | <a href="#">New User?</a>
			</div>
		</div>
		<div class="footer">What are Footers used for</div>
	</div>
</body>