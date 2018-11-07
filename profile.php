<?php 

require_once 'inc/nav.php';
require_once'inc/blogObjects.php';
require_once 'inc/pictureObject.php';
require_once 'inc/loginObject.php';
require_once 'inc/blogAndPicDefinitions.php';

$login = new User();

if(isset($_SESSION['LOGIN'])){

    if(isset($_SESSION['USER'])){

        $user = array();

        array_push($user, $login->fetchSingle($_SESSION['USER']));

    }else{

        header('Location: index.php');
        die();

    }

}else{

    header('Location: index.php');
    die();

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
        $userEmail = '';

        foreach($user as $thing){

            $userName = $thing[0]['userName'];
            $userPhone = $thing[0]['userPhone'];
            $userQuestion = $thing[0]['userQuestion'];
            $userFirst = $thing[0]['userFirst'];
            $userLast = $thing[0]['userLast'];
            $userEmail = $thing[0]['userEmail'];

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

        echo'<div class="container-fluid">

        
            <ul class="nav nav-tabs">
                <li class="active"><a href="#Events" data-toggle="tab" aria-expanded="true">Your Events</a></li>

                <li><a href="#account" data-toggle="tab">Your Account</a></li>

            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="Events">
                
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque purus consequat odio feugiat rhoncus. Suspendisse non felis mauris. Sed id nisi vitae nulla pharetra tincidunt. Etiam bibendum eget magna volutpat egestas. Quisque aliquet hendrerit urna, ac porttitor libero consectetur at. In feugiat pretium ornare. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque massa massa, convallis at sodales sed, pretium et libero. Nullam id lorem in neque gravida commodo in eget ex. Donec iaculis nibh non ligula gravida, id blandit neque tincidunt. In sed neque ipsum. Curabitur nunc enim, congue non diam in, scelerisque tempor tortor.

                        Quisque quis venenatis quam, sed placerat sem. Pellentesque commodo sapien vel odio consectetur vulputate. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis lacus nibh, semper vel egestas quis, dignissim non odio. Sed libero quam, placerat id convallis a, suscipit non purus. Sed vitae neque nunc. Vestibulum ut ligula in turpis dapibus porttitor vitae eget elit. Phasellus commodo tellus sed tellus mattis, et volutpat urna mollis. Duis in lacus sed tortor cursus fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.

                        Sed ultricies turpis et nulla semper eleifend. Nullam posuere, eros id finibus ultrices, purus elit malesuada eros, eget finibus odio magna non dolor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque id vestibulum nisl, et fringilla tortor. Suspendisse vel sagittis ipsum. In bibendum, arcu id lacinia egestas, nunc arcu sodales mi, eu egestas neque purus a leo. Nunc gravida nibh a massa dapibus pharetra mollis nec urna.

                        In sed bibendum erat. Integer pellentesque, nulla et facilisis tempor, libero lectus vulputate justo, a tempor massa leo eu metus. Praesent tempor fermentum erat vel vulputate. Quisque egestas lorem in tellus lobortis bibendum. Suspendisse non justo risus. Mauris mattis dictum diam, sit amet efficitur ipsum ultrices non. Praesent a felis tellus. Nam at sem sapien. Pellentesque dapibus augue porttitor commodo ultrices. Curabitur ac dui diam. Integer ut magna ac elit vehicula molestie. In eget leo non velit sagittis sodales. Sed auctor a mi ut varius.

                        Duis pretium, sem sed dignissim egestas, odio erat congue est, sit amet hendrerit est est sed turpis. Aenean at lorem sit amet turpis viverra maximus. Pellentesque sit amet maximus orci. Etiam nisi odio, molestie porttitor commodo non, egestas non neque. Vivamus ullamcorper urna tortor, non feugiat nulla ornare ut. Duis faucibus urna in sapien fermentum, ac vulputate mauris facilisis. Etiam mattis eget libero in commodo. Etiam convallis arcu in dignissim malesuada. Suspendisse in eros nunc. Nam eget orci blandit, tincidunt arcu vel, rutrum elit. Nullam iaculis ligula felis, et congue urna bibendum at. Vestibulum lobortis mauris ante, et semper dolor mollis non. Sed iaculis sed elit ut blandit. Aliquam erat volutpat.</p>

                </div>

                <div class="tab-pane fade in" id="account">

                    <div class="well well-lg">

                        <div class="container text-left" style="word-wrap: break-word;">

                            <div class="row">

                                    <h2><strong>First Name:</strong><div class="text-center">'.$userFirst.'</div></h2>
                                    
                            </div><hr>

                            <div class="row">

                                <h2><strong>Last Name:</strong><div class="text-center">'.$userLast.'</div></h2>

                            </div><hr>

                            <div class="row">

                                <div class="container">

                                    <h2><strong>Email:</strong><div class="text-center">'.$userEmail.'</div></h2>

                                </div>

                            </div><hr>

                            <div class="row">

                            <h2><strong>Phone:</strong><div class="text-center">'.$userPhone.'</div></h2>

                            </div><hr>

                            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#userInfo">Update Personal Info</button><br><br>

                            <!-- Modal -->
                            <div id="userInfo" class="modal fade" role="dialog">
                              <div class="modal-dialog modal-sm">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <form action="inc/userUpdate.php" method="post">

                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Update Your Personal Info.</h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <div class="form-group">

                                                First Name:<input type="text" class="form-control" name="userFirst"  value="'.$userFirst.'"><hr>

                                                Last Name:<input type="text" class="form-control" name="userLast"  value="'.$userLast.'"><hr>

                                                Phone:<input type="text" class="form-control" name="userPhone"  value="'.$userPhone.'"><hr>

                                                Email:<input type="text" class="form-control" name="userEmail" value="'.$userEmail.'">

                                                    <input type="text" readonly style="display: none;" name="page" value="'.$_SERVER['PHP_SELF'].'">


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary">
                                            </div>

                                            </form>
                                    </div>

                                  </div>
                                </div>

                            </div>

                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#updatePassword">Update Your Password</button><br><br>

                            <!-- Modal -->
                                <div id="updatePassword" class="modal fade" role="dialog">
                                  <div class="modal-dialog modal-sm">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Update your Password</h4>
                                      </div>
                                      <div class="modal-body form-group">
                                        
                                      <form action="inc/changepass.php" method="post">

                                          <input type="password" name="oldPass" placeholder="Old Password" class="form-control"><br><br>

                                          <input type="password" name="newPass1" placeholder="Type your new Password" class="form-control"><br><br>

                                          <input type="password" name="newPass2" placeholder="Retype your new Password" class="form-control"><br><br>

                                          <input type="submit" class="btn btn-primary form-control" value="Change Password">

                                      </form>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>

                            <a href="inc/userDelete.php" class="btn btn-danger btn-block">DELETE ACCOUNT</a>


                        </div>

                    </div>

                </div>
              
            </div>


        </div>';


    ?>       





    </div>



</body>

</html>