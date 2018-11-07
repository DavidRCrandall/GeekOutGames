<?php 

require 'inc/nav.php';
require'inc/blogObjects.php';
require 'inc/pictureObject.php';
require 'inc/blogAndPicDefinitions.php';

$login = new User();

if(isset($_SESSION['LOGIN'])){

    if(isset($_SESSION['USER'])){

        $user = array();

        array_push($user, $login->fetchSingle($_SESSION['USER']));

    }else{

        header('Location: index.php');

    }

}else{

    header('Location: index.php');

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
    <script src="js\summernote\dist\summernote.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" type="text/css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="js/bootstrap.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="images/GOG_Logo_BWG.jpg">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    

    <div class="container-fluid">
    <!-- Navbar -->
    <?php DisplayNav("userManagement");

        $userName = '';
        $userPhone = '';
        $userQuestion = '';
        $userFirst ='';
        $userLast ='';

        foreach($user as $thing){

            $userName = $thing[0]['userName'];
            $userPhone = $thing[0]['userPhone'];
            $userQuestion = $thing[0]['userQuestion'];
            $userFirst = $thing[0]['userFirst'];
            $userLast = $thing[0]['userLast'];

        }



        echo'
        <div class="row">

            <div class ="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            
                <img src="images\\GOG_Logo_FullColor.jpg" class="img-responsive"/>

            </div>

            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                
                <div class="jumbotron text-left" style="background: #FFFFFF;">
                    
                <h1>Welcome: '.$userFirst.'</h1>

                </div>

            </div>

        </div>';

        if(isset($_SESSION['error'])){

            echo'<div class="alert alert-danger"><h2>Attention!</h2><h4>'.$_SESSION['error'].'</h4></div>';

            unset($_SESSION['error']);

        }

        echo'<div class="container">

        <button class="btn-primary form-control" data-toggle="modal" data-target="#events">Your Events!</button>

        <hr>

        <button class="btn-primary form-control" data-toggle="modal" data-target="#changePass">Change your Password</button>

        <hr>

        <button class="btn-primary form-control" data-toggle="modal" data-target="#accountDetails">Update account details</button>

        </div>

        <!-- Events -->
        <div id="events" class="modal fade" role="dialog" data-backdrop="false">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Your Events</h4>
              </div>
              <div class="modal-body">

                    
              <h1>Events will go here</h1>
                    
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>


        <!-- Change Pword -->
        <div id="changePass" class="modal fade" role="dialog" data-backdrop="false">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change your Password</h4>
              </div>
              <div class="modal-body">

                   <form action="changePass.php" method="post">

                    <div class="form-group">

                        <input type="password" class="form-control" placeholder="Old Password" name="oldPass">
                        <br>
                        <input type="password" class="form-control" placeholder="New Password" name="newPass1">
                        <br>
                        <input type="password" class="form-control" placeholder="New Password Again" name="newPass2">
                        <br>

                        <input type="text" name="username" style="display: none;">

                        <input type="submit" class="btn btn-primary form-control">

                    </div>

                   </form>
                
                    
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>


        <!-- Update account details -->
        <div id="changePass" class="modal fade" role="dialog" data-backdrop="false">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change your Password</h4>
              </div>
              <div class="modal-body">

                   <form action="updateAccount.php" method="post">

                    <div class="form-group">

                        

                    </div>

                   </form>
                
                    
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

        ';


    ?>       





    </div>



</body>

</html>