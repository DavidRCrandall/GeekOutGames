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
			<div class="col-md-4 col-sm-4">
				<img style="margin-top: 2em;" class="image-responsive" src="images/GOG_Logo_FullColor.jpg" width="200" height="200">
			</div>
			
			<div class="col-md-4 col-sm-4">
				<h3>Recover Your Password</h3>
				<form action="recover.php" method="post">
					<div class="form-group">
						<label>Enter your Username</label>
						<input type="text" class="form-control" name="username" required>
						<br/>
						<input type="submit" class="btn btn-primary">
					</div>
				</form>
			</div>
				
		</div> <!-- /row -->
			<!-- Recovery Question -->

		<?php
			if (isset($_POST['username'])) {
				$user = new user();
				
				$question = $user->fetchQuestionByName($_POST['username']);
				echo $question['userQuestion'];
			}

		?>




	

	

</body>
</html>