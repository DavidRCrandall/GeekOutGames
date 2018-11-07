<?php 
include 'inc/nav.php';
require_once'inc/var.php';
require_once 'inc/blogAndPicDefinitions.php';
require_once'inc/blogObjects.php';
require_once'inc/BlogUpdateTitle.php';
require_once'inc/BlogUpdateBody.php';

$login = new User();
if(isset($_SESSION['LOGIN'])){
if($login->checkTime()){
    $_SESSION['adminFull'] = false;
}
}

if(isset($_POST['username']) && isset($_POST['password'])){
    if(!empty($_POST['username']) && !empty($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $login->login($username,$password);
    }
}

if(isset($_POST['signout'])){
    $login->logout();
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

   <!-- Bootstrap Core CSS -->
     <script src="js/jquery.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script src="js/bootstrap.js" type="text/javascript"></script>

    <!-- Summernote JS -->
    <script src="js\summernote\dist\summernote.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" type="text/css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link rel="icon" href="images/GOG_Logo_BWG.jpg">

   <?php if(isset($_SESSION['adminFull'])){ if($_SESSION['adminFull']){ echo '<script src="js\geek.js"></script>';}}; ?> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php 

   DisplayNav("contact"); 

   $blogContactDetails = new blog();

   $contactArr = array();

   $contactArr = $blogContactDetails->fetchByPage(7);

   if($_SESSION['adminFull']){

    foreach($contactArr as $thing)
        { 

            echo '<!-- Page Content -->
                        <div class="container">

                            <!-- Page Heading/Breadcrumbs -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">Contact
                                        
                                    </h1>
                                    <ol class="breadcrumb">
                                        <li><a href="index.php">Home</a>
                                        </li>
                                        <li class="active">Contact</li>
                                    </ol>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- Content Row -->
                            <div class="row">
                                <!-- Map Column -->
                                <div class="col-md-8">
                                    <!-- Embedded Google Map -->
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.882986821322!2d-82.7632935849629!3d34.70813119032825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88585ce95817205f%3A0x4c2b69ab028f73e!2sGeek+Out+Gaming!5e0!3m2!1sen!2sus!4v1487644935790" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                                <!-- Contact Details Column -->
                                <div class="col-md-4">

                                   <input id="id" type="text" style="display: none;" value="'.$thing['blogID'].'" readonly>

                                    <div id="title" class="summernote">

                                        '.htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES).'

                                    </div><hr>

                                    <input id="id" type="text" style="display: none;" value="'.$thing['blogID'].'" readonly>

                                    <div id="body" class="summernote">

                                        '. htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) .'

                                    </div>

                                </div>
                            </div>
                            <!-- /.row -->';

        }


   }else{

        foreach($contactArr as $thing)
        { 

            echo '<!-- Page Content -->
                        <div class="container">

                            <!-- Page Heading/Breadcrumbs -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">Contact
                                        
                                    </h1>
                                    <ol class="breadcrumb">
                                        <li><a href="index.php">Home</a>
                                        </li>
                                        <li class="active">Contact</li>
                                    </ol>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- Content Row -->
                            <div class="row">
                                <!-- Map Column -->
                                <div class="col-md-8">
                                    <!-- Embedded Google Map -->
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3279.882986821322!2d-82.7632935849629!3d34.70813119032825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88585ce95817205f%3A0x4c2b69ab028f73e!2sGeek+Out+Gaming!5e0!3m2!1sen!2sus!4v1487644935790" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                                <!-- Contact Details Column -->
                                <div class="col-md-4">

                                    '.htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES).'<hr>

                                    '. htmlspecialchars_decode(urldecode($thing['blogBody']),ENT_QUOTES) .'

                                </div>
                            </div>
                            <!-- /.row -->';

        }

    }

    if(isset($_SESSION['errormsg'])){

    	echo'

    	<div class="row">

	    	<div class="panel panel-danger">

	    		<div class="panel-heading">There was an Error!</div>
	    		<div class="panel-body">'. $_SESSION['errormsg'] .'</div>

	    	</div>

    	</div>

    	';

    	unset($_SESSION['errormsg']);

    }

?>

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
                <h3>Send us a Message</h3>
                <form name="sentMessage" id="contactForm" action="inc/message.php" method="post">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" name="name" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="tel" class="form-control" name="phone" id="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" name="email" id="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="10" cols="100" name="message" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Geek out Games 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <?php 

        if($_SESSION['adminFull']){

            echo'

            <script>

                $(document).ready(function(){

                    SummerNote();

                });

            </script>

            ';

        }

    ?>

</body>

</html>
