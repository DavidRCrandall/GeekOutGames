<?php
require_once 'inc/nav.php';
require_once 'inc/loginObject.php';
require_once'inc/blogObjects.php';
require_once 'inc/pictureObject.php';
require_once 'inc/blogAndPicDefinitions.php';
require_once 'inc/var.php';

$login = new user();

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
    <link rel="icon" href="images/GOG_Logo_BWG.jpg">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Navbar -->
    <?php DisplayNav("index"); ?>

    <!-- Carousel -->
    <?php
        if (!$_SESSION['adminFull']) {

            $myPic = new picture();
            $carouselImg = $myPic->fetchByPageLocation(0);
            $counterImg = 0;

            echo "
                <!-- Header Carousel -->
                <header id=\"myCarousel\" class=\"carousel slide\">
                    <!-- Indicators 
                    <ol class=\"carousel-indicators\">

                    ";

                    foreach($carouselImg as $thing){


                        if($counterImg == 0){
                            echo"   

                                <li data-target=\"#myCarousel\" data-slide-to=\"". $counterImg ."\" class=\"active\"></li>

                                ";

                                $counterImg++;
                         }


                        echo"

                            <li data-target=\"#myCarousel\" data-slide-to=\"". $counterImg ."\"></li>

                        ";

                        $counterImg++;
                    }

                        

                echo"
                    </ol> -->

                    <!-- Wrapper for slides -->
                    <div class=\"carousel-inner\">";

                    $sexymoose = 0;

                    foreach($carouselImg as $thing){
                        
                        if($sexymoose == 0){
                            echo "<div class=\"item active\">
                                <div class=\"fill\" style=\"background-image:url('" . $thing . "');\"></div>
                                
                            </div>";

                            $sexymoose++;

                        }else{

                            echo "<div class=\"item\">
                                <div class=\"fill\" style=\"background-image:url('" . $thing . "');\"></div>
                            </div>";


                        }

                    }
                echo"</div>
                    <!-- Controls -->
                    <a class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">
                        <span class=\"icon-prev\"></span>
                    </a>
                    <a class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">
                        <span class=\"icon-next\"></span>
                    </a>
                </header>
            ";
        } else if ($_SESSION['adminFull']) {
            // For loop echoing out carousel images
            
            $myPic = new picture();

            $currentPics = $myPic->fetchByPage(CarouselImages);

            echo "<div class=\"panel panel-default\">
                        <div class=\"panel-heading\">Carousel Images</div>
                        <div class=\"panel-body\">";


                    //Dynamically populate editable images.
                foreach($currentPics as $thing){

                    echo "
                            <div class=\"col-md-4 col-sm-6\">
                                  
                                <div style=\"margin-bottom: 5px;\">
                                    <img src=\"" . $thing['pictureLocation']."/".$thing['pictureTitle'] . "\" width=\"350\" height=\"200\">
                                </div>
                                <div style=\"margin-bottom: 5px;\">
                                <form action=\"inc/CarouselImageDelete.php\" method=\"POST\">
                                    <input style=\"display: none;\" type=\"text\" name=\"ImageID\" value=\"" . $thing['pictureID'] . "\">
                                    <input type=\"submit\" class=\"form-control btn-danger\" name=\"delete\" value=\"Delete\"/>
                                </form>
                                </div>
                                
                            </div>

                            ";

                }

                  echo "<div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">

                            <div class=\"panel panel-default\">
                                <div class=\"panel-heading\">Upload New Image</div>
                                    <div class=\"panel-body\">

                                        <form action=\"inc/CarouselImageUpload.php\" method=\"post\" enctype=\"multipart/form-data\">
                                            <input type=\"file\" name=\"newCarImg\" class=\"btn-md\">
                                            <input type=\"submit\" value=\"Upload New Image\" class=\"btn-md\" name=\"submitNewCar\">
                                        </form>

                                    </div>
                               </div>
                            </div>
                        </div>

                        </div>

                    </div>


                       ";  

        }
    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if ($_SESSION['adminFull']) {

                        //This Code dynamically loads in the Banner that is displayed on the home page.
                        $bannerLoad = new blog();

                        $bannerLoadArr = $bannerLoad->fetchByPage(HomePageBanner);

                             foreach($bannerLoadArr as $thing){

                                echo "
                                    <br/>
                                        <input id=\"id\" style=\"display: none;\" value=\"". $thing['blogID'] ."\"/>
                                        <div id=\"body\" class=\"summernote\">" . htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) . "</div>
                                        
                                ";

                            }



                    } else {

                         $bannerLoad = new blog();

                        $bannerLoadArr = $bannerLoad->fetchByPage(HomePageBanner);

                        foreach($bannerLoadArr as $thing){

                            echo "
                                <h1 class=\"page-header\">
                                    " . htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) . "
                                </h1>
                            ";

                        }
                    }
                ?>
                
            </div>
            
               

                <?php

                    
                    $homeEvents = new blog();

                    $homeEventsArr = $homeEvents->fetchByPage(HomePageAnnouncement);

                    

                         
                            // Test for admin account and displays editable content
                            if ($_SESSION['adminFull']) {

                                foreach($homeEventsArr as $thing){

                                    //Echo out editable divs
                                    echo "
                                         <div class=\"col-md-4\">

                                            <div class=\"panel\">

                                                <div class=\"panel-heading\">

                                                        <input id=\"id\" style=\"display: none;\" value=\"" . $thing['blogID'] . "\"/>
                                                        <div id=\"title\" class=\"summernote\">" . htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) . "</div>
                                                                            
                                                </div>

                                                <div class=\"panel-body\">
                                    
                                        
                                                        <input id=\"id\" style=\"display: none;\" value=\"". $thing['blogID'] ."\"/>
                                                        <div id=\"body\" class=\"summernote\">" . htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) . "</div>
                                                        
                                                    
                                           
                                                   
                                           
                                                 </div>

                                            </div>

                                        </div>
                                    ";

                                }
                            // For non admin users, display the normal notice    
                            } else {

                                foreach($homeEventsArr as $thing){

                                    echo "
                                        <div class=\"col-md-4\">

                                            <div class=\"panel panel-default\">

                                                <div class=\"panel-heading\">
                                                    <h4><i></i>". htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) ."</h4>
                                                </div>

                                                <div class=\"panel-body\">". htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) ."</div>

                                            </div>

                                        </div>
                                    ";

                                }
                            }

                     

                    ?>
                   
        </div>
        <!-- /.row -->


        <!-- Event Picture Section -->
        <div class="row">
            <div class="col-lg-12">

                <?php

                    $eventPicTitle = new blog();
                    $eventPicTitleArr = $eventPicTitle->fetchByPage(HomeEventPicsTitle);

                    // If admin is logged in, display summernote form for editing
                    if ($_SESSION['adminFull']) {

                        foreach ($eventPicTitleArr as $eventTitle) {
                            
                            echo "
                                <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                    <div class=\"panel panel-default\">
                                        <div class=\"panel-heading\">
                                            <input id=\"id\" style=\"display: none;\" value=\"" . $eventTitle['blogID'] . "\"/>
                                            <div id=\"title\" class=\"summernote\">" . htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) . "</div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        } 
                        
                    // If no admin is logged in, display section title
                    } else if (!$_SESSION['adminFull']) {

                        foreach($eventPicTitleArr as $eventTitle) {
                            echo "
                                <h2 class=\"page-header\">" . htmlspecialchars_decode(urldecode($eventTitle['blogTitle']), ENT_QUOTES) . "</h2>
                            ";
                        }
                    }

                    // If admin is not logged in, display standard, non-editable content
                    if (!$_SESSION['adminFull']) {
                        $newPicture = new picture();
                        $eventPic = $newPicture->fetchByPage(HomeEventPics);

                        foreach ($eventPic as $pic) {
                            echo "
                            <div class=\"col-md-4 col-sm-6\">
                                <img class=\"img-responsive img-portfolio img-hover\" src=\"" . $pic['pictureLocation'] . "/" . $pic['pictureTitle'] . "\" width=\"700\" height=\"450\">
                            </div>
                            ";
                        }


                    } else if ($_SESSION['adminFull']) {
                        $picture = new picture();
                        $eventPic = $picture->fetchByPage(HomeEventPics);

                        foreach ($eventPic as $pic) {

                            // Display Picture
                            echo "
                                <div class=\"col-md-4 col-sm-6\">
                                    <img class=\"img-responsive img-portfolio\" src=\"" . $pic['pictureLocation'] . "/" . $pic['pictureTitle'] . "\" width=\"700\" height=\"450\">
                                <form style=\"margin-bottom: 2em;\" action=\"inc/HomeEventImageDelete.php\" method=\"POST\">
                                    <input type=\"hidden\" name=\"ImageID\" value=\"" . $pic['pictureID'] . "\">
                                    <input type=\"submit\" class=\"form-control btn-danger\" name=\"delete\" value=\"Delete\"/>
                                </form>
                                </div>
                            ";
                        }

                        // Upload new event pictures
                        echo "
                            <div class=\"col-md-4 col-sm-6 panel panel-default\">
                                <div class=\"panel-heading\">Upload New Image</div>
                                <div class=\"panel-body\">
                                    <form action=\"inc/HomeEventImageUpload.php\" method=\"post\" enctype=\"multipart/form-data\">
                                        <input type=\"file\" name=\"newCarImg\" class=\"btn-md\">
                                        <input type=\"submit\" value=\"Upload New Image\" class=\"btn-md\" name=\"submitNewCar\">
                                    </form>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>

            
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
           
                <?php
                    if ($_SESSION['adminFull']) {

                        $homeFeatures = new blog();

                        $homeFeaturesArr = $homeFeatures->fetchByPage(HomePageFeatures);

                            foreach($homeFeaturesArr as $thing){
                                
                                echo "
                                    <div class=\"col-lg-12\">
                                        <input id=\"id\" type=\"text\" style=\"display: none;\" value=\"". $thing['blogID'] ."\">
                                        <div id=\"title\" class=\"summernote\">".  htmlspecialchars_decode(urldecode($thing['blogTitle']),ENT_QUOTES) ."</div>
                                    </div>

                                    <div class=\"col-md-6\">
                                        <input id=\"id\" type=\"text\" style=\"display: none;\" value=\"". $thing['blogID'] ."\">

                                        <div id=\"body\" class=\"summernote\">".  htmlspecialchars_decode(urldecode($thing['blogBody']),ENT_QUOTES) ."</div>

                                    </div>
                                    
                                ";

                            }


                    } else {

                         $homeFeatures = new blog();

                        $homeFeaturesArr = $homeFeatures->fetchByPage(HomePageFeatures);

                            foreach($homeFeaturesArr as $thing){

                                echo "

                                    <div class=\"col-lg-12\">
                                        <div class=\"page-header\">". htmlspecialchars_decode(urldecode($thing['blogTitle']),ENT_QUOTES) ."</div>
                                    </div>


                                    <div class=\"col-md-6\">".  htmlspecialchars_decode(urldecode($thing['blogBody']),ENT_QUOTES) ."</div>
                                ";

                            }
                    }
                
           
            ?>

            <!-- Store Hours and Storefront Picture -->
            <?php 
                if ($_SESSION['adminFull']) {
                    $storePic = new picture();
                    $homebottomPic = $storePic->fetchByPage(HomeStorefrontPic);

                    $homefrontCounter = 0;

                    foreach ($homebottomPic as $pic) {
                        echo "
                            <div class=\"col-md-6\">
                                <img class=\"img-responsive\" src=\"" . $pic['pictureLocation'] . "/" . $pic['pictureTitle'] . "\">

                                 <div style=\"margin-bottom: 5px;\">
                                <form action=\"inc/HomeEventImageDelete.php\" method=\"POST\">
                                    <input style=\"display: none;\" type=\"text\" name=\"ImageID\" value=\"" . $pic['pictureID'] . "\">
                                    <input type=\"submit\" class=\"form-control btn-danger\" name=\"delete\" value=\"Delete\"/>
                                </form>
                                </div>
                            </div>

                            ";

                            $homefrontCounter++;

                    }
                   
                    	
                    	if($homefrontCounter == 0){
		                    echo "
		                        <div class=\"col-md-4 col-sm-6 panel panel-default\">
                                <div class=\"panel-heading\">Upload New Image</div>
                                <div class=\"panel-body\">
		                                <form action=\"inc/StoreImageUpload.php\" method=\"post\" enctype=\"multipart/form-data\">
		                                    <input type=\"file\" name=\"newCarImg\" class=\"btn-md\">
		                                    <input type=\"submit\" value=\"Upload New Image\" class=\"btn-md\" name=\"submitNewCar\">
		                                </form>

		                                </div>
		                            </div>
		                        </div><!-- END ROW -->
		                    ";

		                }

		                



                } else if (!$_SESSION['adminFull']) {
                    $storePic = new picture();
                    $homebottomPic = $storePic->fetchByPage(HomeStorefrontPic);

                    foreach($homebottomPic as $pic) {
                        echo "
                            <div class=\"col-md-4\">
                                <img src=\"" . $pic['pictureLocation'] . "/" . $pic['pictureTitle'] . "\" height=\"500\" width=\"700\">
                            </div>
                        ";
                    }
                }

            ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <?php 

                $homeSign = new blog();

                $homeSignArr = $homeSign->fetchByPage(HomeSignUp);

                if($_SESSION['adminFull']){

                    

                    foreach($homeSignArr as $thing){

                        echo "  <div class=\"col-md-8\">
                                    <input id=\"id\" style=\"display: none;\" value=\"". $thing['blogID'] ."\"/>
                                    <div id=\"body\" class=\"summernote\">". htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) ."</div>
                                </div>";

                    }

                }else{

                    foreach($homeSignArr as $thing){

                        echo "<div class=\"col-md-8\">". htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) ."</div>";   

                    }                

                }              

                ?>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="signup.php">Sign Up</a>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<?php

     if ($_SESSION['adminFull']) {



        echo"<script src=\"js/geek.js\"></script>

                <!-- Script to Activate the Carousel -->
                <script>
                $('.carousel').carousel({
                    interval: 5000 //changes the speed
                });

                $(document).ready(function(){


                    SummerNote();


                });

            </script>";

    }

?>

</body>

</html>