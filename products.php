<?php 
require_once 'inc/nav.php';
require_once 'inc/blogAndPicDefinitions.php';
require_once 'inc/pictureObject.php';
require_once 'inc/productObject.php';
require_once 'inc/loginObject.php';
$login = new User();
if(isset($_SESSION['LOGIN'])){
	if($login->checkTime()){
		$_SESSION['adminFull'] = false;
	}
}

if(isset($_SESSION['LOGIN'])){
	if($_SESSION['LOGIN'] == 3){
		$_SESSION['adminFull'] = true;
	}
	else{
		$_SESSION['adminFull'] = false;
	}
}
else{
	$_SESSION['adminFull'] = false;
}

$selection = false;

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	if(isset($_POST['product'])){

		$selection = true;

		$products = new product();

		$productArr = $products->fetchSingle($_POST['product']);

	}else{

		$selection = false;

	}

}

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
	<script src="js/summernote/dist/summernote.js"></script>

	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/modern-business.css" type="text/css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Favicon -->
	<link rel="icon" href="images/GOG_Logo_BWG.jpg">

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

    	<!-- Display NavBar -->
    	<?php DisplayNav("products"); ?>

    	<!-- Page Content -->
    	<div class="container-fluid">

    		<?php
    		if(!$selection){	
    			echo'
    			<div class="row">

    				<div class="col-md-4">
    					<img class="img-responsive" style="margin-top: 2em; margin-bottom: 2em;" src="images/GOG_Logo_FullColor.jpg" alt="Geek Out Games">
    				</div>
    				<div style="background: none; margin-top: 7em;" class="jumbotron col-md-8">
    					<h1 class="text-center">Products</h1>
    					<hr>
    				</div>
    			</div>
    			<!-- /.row -->';

    		}


    		if(isset($_SESSION['error'])){

    			$error = $_SESSION['error'];

    			unset($_SESSION['error']);

    			echo'

    			<div class="alert alert-danger">

    				<h2><strong>Attention!</strong> '.$error.'</h2>

    			</div>

    			';


    		}else if(isset($_SESSION['success'])){

    			$success = $_SESSION['success'];

    			unset($_SESSION['success']);

    			echo'

    			<div class="alert alert-success">

    				<h2><strong>Attention!</strong> '.$success.'</h2>

    			</div>

    			';

    		}

    		$product = new product();

    		$product->deleteProduct(3);

    		unset($product);

    		?>


    		<!-- Service Panels -->
    		<!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->

    		<?php 

    		if($selection){

    			if($_SESSION['adminFull']){

    				foreach($productArr as $thing){

    					echo'<div class="row" style="background: #aaaaaa;">



    					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3" >

    						<img class="img-responsive" src="'.$thing['productFolder'].'/'.$thing['productLogo'].'" alt="'.$thing['productLogo'].'">

    					</div>		



    				</div>

    				<div class="row">
    					<div class="container">

    						<h4>Update Logo Image</h4>

    						<div class="form-group">

    							<form action="inc/productImageUpdate.php" method="post" enctype="multipart/form-data">

    								<input type="text" name="productID" readonly style="display: none;" value="'.$thing['productID'].'">
    								<input type="file" class="form-control" name="newProductImage" class="btn-md">
    								<input type="submit" class="form-control btn-primary" value="Upload New Image" class="btn-md" name="submitNewProduct">
    							</form>

    						</div>

    					</div>

    				</div>

    				<div class="container text-left">

    					<input id="id" type="text" readonly style="display: none;" value="'.$thing['productID'].'">
    					<div id="title" class="summernote">'.htmlspecialchars_decode(urldecode($thing['productName']),ENT_QUOTES).'</div>



    				</div>




    				<div class="row">    					

    					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">

    						<div class="row">

    							<input id="id" type="text" readonly style="display: none;" value="'.$thing['productID'].'">
    							<div id="body" class="summernote">'.htmlspecialchars_decode(urldecode($thing['productDescription']), ENT_QUOTES).'</div>

    						</div>

    						<div class="row">

    							<!-- This will be images at some point in the future -->

    						</div>


    					</div>

    				</div>';

    			}


    		}else{

    			foreach($productArr as $thing){



    				echo'

    				<div class="row" style="background: #aaaaaa;">



    					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3" >

    						<img class="img-responsive center-block" src="'.$thing['productFolder'].'/'.$thing['productLogo'].'" alt="'.$thing['productLogo'].'">

    					</div>		



    				</div>

    				<div class="container text-left">'.htmlspecialchars_decode(urldecode($thing['productName']),ENT_QUOTES).'<hr></div>




    				<div class="row">

    					<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    						<!-- This will eventually be a dynamic dropdown or we can make it some sort of populated list. I have a button here for now -->
    						<button class="btn btn-block btn-primary">Events</button>

    					</div>

    					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

    						<div class="row">

    							'.htmlspecialchars_decode(urldecode($thing['productDescription']), ENT_QUOTES).'

    						</div>

    						<div class="row">

    							<!-- This will be images at some point in the future -->

    						</div>


    					</div>

    				</div>';



    			}



    		}

    	}else{

    		$products = new product();

    		$productArr = $products->fetchAll();


    		if($_SESSION['adminFull']){

    			echo'<div class="row">';

    			foreach($productArr as $thing){

    				echo'	

    				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-md-offset-1 col-lg-offset-1">

    				<input id="id" type="text" style="display: none;" value="'.$thing['productID'].'">
    				<div id="title" class="summernote">'.htmlspecialchars_decode(urldecode($thing['productName']), ENT_QUOTES).'</div>

    				<img class="center-block" height="150px" width="250px" src="'.$thing['productFolder'].'\\'.$thing['productLogo'].'">

    				<hr>

    				<form action="products.php" method="post">

    					<input type="text" readonly style="display: none;" value="'.$thing['productID'].'" name="product">

    					<button type="submit" class="btn btn-block btn-primary">Edit Body</button>

    				</form>

    				<hr>

    				<form action="inc/productDelete.php" method="post">

    					<input readonly style="display: none;" type="number" value="'.$thing['productID'].'" name="product">

    					<button type="submit" class="btn btn-danger btn-block">DELETE THIS PRODUCT</button>

    				</form>

    			</div>';

    		}   

    		echo'

    		</div>
    		<!-- current products row -->

    		<br><br>

    		<div class="container">

    		<div class="panel panel-primary">

    			<div class="panel-heading">Create a new Product</div>

    			<div class="panel-body">

	    			<div class="row form-group">

	    				<form class="center-block" action="inc/productCreate.php" method="post" enctype="multipart/form-data" style="padding: 5px;">


	    				Product Image: <input type="file" name="newProductImage" class="btn-md"><br>

	    					<input type="text" name="productName" class="form-control" placeholder="Enter your title here"><br>

	    					<input  type="textarea" name="productDescription" class="form-control" placeholder="Enter your description here"><br>

	    					<input type="submit" value="Upload New Image" class="btn-md" name="submitNewProduct">
	    				</form>

	    			</div>

	    		</div>

    		</div>

    		</div>

    		';				


    	}else{

    		foreach($productArr as $thing){

    			echo'	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-md-offset-1 col-lg-offset-1">


    			<div class="text-center">'.htmlspecialchars_decode(urldecode($thing['productName']),ENT_QUOTES).'</div>

    			<img class="center-block" height="150px" width="250px" src="'.$thing['productFolder'].'\\'.$thing['productLogo'].'">

    			<br>
    			<form action="products.php" method="post">

    				<input type="text" readonly style="display: none;" value="'.$thing['productID'].'" name="product">

    				<button type="submit" class="btn btn-block btn-primary">Learn More!</button>

    			</form>

    		</div>';





    	}



    }



}



?>


</div>
<!-- /.container -->


<?php

if($_SESSION['adminFull']){


	echo'

	<script src="js/geek.js"></script>

	<script>

		$(document).ready(function(){


			SummerNoteProduct();


		});


	</script>

	';

}

?>

<hr><br><br>

</body>

</html>
