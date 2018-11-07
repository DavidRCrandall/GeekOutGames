
<?php require 'inc/nav.php'; 
require_once 'inc/nav.php'; 
require_once 'inc/blogAndPicDefinitions.php';
require_once 'inc/blogObjects.php';
require_once 'inc/pictureObject.php';


// session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST' ){

    if(isset($_POST['id'])){

        if($_POST['id']){

            $pageID = $_POST['id'];

        }else{

            header('Location:blog-home-1.php');

        }

    }else{

            header('Location:blog-home-1.php');
            
        }

}else{

    header('Location:blog-home-1.php');

}

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

    <?php DisplayNav("blog"); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            
                <div class="page-header">
                <?php 

                if(isset($_SESSION['adminFull'])){

                    if($_SESSION['adminFull'] === true){

                        $blog = new blog();

                        $blogArr = $blog->fetchSingle($pageID);

                        foreach($blogArr as $thing){

                            echo'<input id="id" type="text" readonly style="display: none;" value="'. $thing['blogID'] .'">

                                <div id="title" class="summernote">'. htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) .'</div>';

                        }

                    }else{

                        $blog = new blog();

                        $blogArr = $blog->fetchSingle($pageID);

                        foreach($blogArr as $thing){

                            echo'

                            <div>'. htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) .'</div>

                            ';

                        }


                    }

                }


                ?>
                    <small>by <a href="#">Chief Geek</a>
                    </small>
                </div>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Blog Post</li>
                </ol>
            
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">

                <!-- Blog Post -->

                <hr>

                <!-- Date/Time -->
                <p><i class="fa fa-clock-o"></i> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <?php 

                     if(isset($_SESSION['adminFull'])){

                        if($_SESSION['adminFull'] === true){

                            foreach($blogArr as $thing){

                                echo'
                                

                                    <input id="id" type="text" readonly style="display: none;" value="'. $thing['blogID'] .'">

                                    <div id="body" class="summernote">'. htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) .'</div>

                                ';

                            }


                        }else{

                             echo'
                                

                                   

                                        <div class="well well-md">

                                            '. htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) .'

                                        </div>

                                   

                                ';


                        }

                    }

                ?>

                

                <hr>

                </div>

                </div>
        <!-- /.row -->

      

        <!-- Footer -->
        <footer>
            <div class="row">
                <div>
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    

    <?php

    if(isset($_SESSION['adminFull'])){

        if($_SESSION['adminFull']){

            echo'    <script>

                $(document).ready(function(){

                    
                    SummerNote(); 

                    


                    

                    $("#deleteBlog").click(function(){

                        var id = $(this).prevAll("input#id").val();

                        deleteBlog(id);

                        location.reload();

                    });

                });


                </script>';

            }

        }

?>

</body>

</html>


