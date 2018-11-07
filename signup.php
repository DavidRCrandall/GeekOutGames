<?php
require 'inc/loginObject.php';
require 'inc/nav.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Geek Out Games</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

    <script src="js/jquery.js"></script>

    <!-- Summernote JS -->
    <script src="js\summernote\dist\summernote.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" type="text/css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link rel="icon" href="images/GOG_Logo_FullColor.jpg">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>
	<?php DisplayNav(""); ?>

	<div class="container">

		<div class="row">
			<div class="col-md-8">
				<h3>Sign up Today to get dope stuff</h3>
			</div>

		</div>

		<div class="row">

			

			<div class="col-md-6">

			<!-- Sign Up Forms -->
				<form action="signup.php" method="POST">
					<div class="form-group">
						<label>*First Name</label>
						<input type="text" class="form-control" id="fname" name="fname" required>
						<label>*Last Name</label>
						<input type="text" class="form-control" id="lname" name="lname" required>
						<label>*Username</label>
						<input type="text" class="form-control" id="username" name="username" required>
						<label>*Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
						<label>*Confirm Passowrd</label>
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
						<label>Phone #</label>
						<input type="text" class="form-control" id="phone" name="phone">
						<label>*Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
						<label>*Security Question</label>
						<input type="text" class="form-control" id="question" name="question" required>
						<label>*Security Question Answer</label>
						<input type="text" class="form-control" id="answer" name="answer" required>
						<br/>
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
				</form>


			</div>

			<div class="col-md-4">
				<img src="images/GOG_Logo_FullColor.jpg" width="200" height="200">
			</div>

		</div>
	</div>

	<?php
		// If the passwords match, send data off to be checked and stored
		if ($_POST['password'] == $_POST['confirm_password']) {
			$user = new user();
			$result = $user->signUp($_POST['username'], $_POST['password'], $_POST['phone'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['question'], $_POST['answer'], 1);
			if ($result == "Username already taken") {
				echo $result;
				
			} else {
				echo "Your account has been successfully created!";	
			}
			
		} else {
		?>
		
		<script type="text/javascript">
			alert("Passwords do not match");
		</script>		

		<?php } ?>




</body>
</html>