<head>
	<link rel="stylesheet" href="styles/style.css">
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
				<h1>Sign Up</h1>
				<form action="signup-handler.php" method="POST">
                    <div class="name">
                        <i class="fa fa-user icon"></i>
                        <input type="text" name="first_name" placeholder="First Name"/><br>
                        <input type="text" name="last_name" placeholder="Last Name"/><br>
                        <input type="text" name="user" placeholder="Username"/><br>
                    </div>
					<i class="fa fa-key icon"></i>
					<input type="password" name="pass" placeholder="Password"/><br>
                    <input type="password" name="confirm_pass" placeholder="Confirm Password"/><br>
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
			</div>
		</div>
		<div class="footer">What are Footers used for</div>
	</div>
</body>