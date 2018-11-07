<?php 
require_once 'inc/nav.php'; 
require_once 'inc/blogAndPicDefinitions.php';
require_once 'inc/blogObjects.php';
require_once 'inc/pictureObject.php';

//session_start();

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
            <div class="col-lg-9">
                <h1 class="page-header">The Cheif Geek's Blog
                    <small>Subheading</small>
                </h1>

                <div class="col-md-8 col-lg-8">

                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li class="active">Blog Home One</li>
                    </ol>

                </div>
            </div>

            <div class="col-lg-3">
                
                  <?php
                    

                if($_SESSION['adminFull']){

                    echo'<hr><div class="container"><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                            New Blog Entry
                        </button></div>';

                    }

                ?>

            </div>
        </div>
       

            <!-- Blog Entries Column -->
            <div class="col-md-9 col-lg-9">

                <!-- First Blog Post -->

        <?php
                
        $blogs = new blog();

        $blogsArr = $blogs->fetchDateandPage(Blog);

        if($_SESSION['adminFull']){

            $blogCount = 0;

            foreach($blogsArr as $thing){

                echo'

                    <div id="outerDiv" class="row">

                        <div class="row">

                            

                                <div class="col-md-6 col-lg-6">

                                    <div id="titleLive">' . htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) . '</div>

                                </div>

                                <div class="col-md-6 col-lg-6">

                                    <button data-toggle="collapse" data-target="#titleEditor'. $blogCount .'" class="btn btn-default btn-sm" >Edit This</button>
                                    <input id="id" type="text" style="display: none;" readonly value="'. $thing['blogID'] .'">

                                    <button class="btn btn-sm btn-danger deleteBlog">Delete This Blog</button>

                                </div>

                            

                        </div>

                        <div class="row">

                            

                                <div id="titleEditor'. $blogCount .'" class="collapse">

                                    <input id="id" type="text" style="display: none;" readonly value="'. $thing['blogID'] .'">

                                    <div id="titleEdit" class="summernote">' . htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) . '</div>

                                </div>

                                                      

                        </div>

                    </div>
                    <p class="lead">
                        by <a href="index.php">Chief Geek</a>
                    </p>
                    <p><i class="fa fa-clock-o"></i> Posted on ' . $thing['blogDate'] . '</p>
                    <hr>

                    

                    

                    <form action="blog-post.php" method="post">

                        <input id="id" name="id" class="text" style="display: none;" value="' . $thing['blogID'] . '" >

                        <input type="submit" class="btn btn-primary btn-md" value="Read More">

                    </form>
                        <hr>

                        ';

                        $blogCount++;

                }


                echo'<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Create a new Blog Entry</h4>
                          </div>

                          <!-- MODAL CONTENT -->
                          <div class="modal-body">

                                <div class="row">

                                    <div id="titleNew" class="summernote"></div>

                                    <div id="bodyNew" class="summernote"></div>

                                </div>

                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="saveButton" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>';

                    

            }else{

            foreach($blogsArr as $thing){

                 echo '<div id="outerDiv" class="row">

                            <div class="row">

                                <div class="container">

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                        <div id="titleLive">' . htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) . '</div>

                                    </div>

                                 </div>

                            </div>

                        </div>
                        <p class="lead">
                            by <a href="index.php">Chief Geek</a>
                        </p>
                        <p><i class="fa fa-clock-o"></i> Posted on ' . $thing['blogDate'] . '</p>

                        <div class="col-md-3 col-lg-3 col-md-offset-6 col-lg-offset-6">

                            <form action="blog-post.php" method="post">

                                <input id="id" name="id" class="text" style="display: none;" value="' . $thing['blogID'] . '" />

                                <input type="submit" class="btn btn-primary btn-md" value="Read"/>

                            </form>

                        </div>
                        <hr>';

                        

                    }


            }

        ?>


            </div>
            <!--About the blog-->

           <?php 
            /*

            if(isset($_SESSION['adminFull'])){

                if($_SESSION['adminFull']){

                    $blogSideBar = new blog();

                    $blogSideArr = $blogSideBar->fetchByPage(BlogSideBar);

                    $blogSidePic = new picture();

                    $blogSidePicArr = $blogSidePic->fetchByPage(BlogSideBarPic);

                    foreach($blogSidePicArr as $thing){

                        echo'
                        <div class="col-md-3 col-lg-3">

                            <div class="row">
                             
                                <img src="'. $thing['pictureLocation'] .'\\'. $thing['pictureTitle'] .'" height="auto" width="100%">

                            </div>';


                    }

                    echo "

                                        <form action=\"inc/blogSidePicUpload.php\" method=\"post\" enctype=\"multipart/form-data\">
                                            <input type=\"file\" name=\"blogSidePicImg\" class=\"btn-md\">
                                            <input type=\"submit\" value=\"Upload New Image\" class=\"btn-md\" name=\"submitNewCar\">
                                        </form>

                                    ";

                    foreach($blogSideArr as $thing){


                        echo'

                            <div class="row">

                                <input id="id" readonly style="display: none;" value="'. $thing['blogID'] .'">

                                <div id="title" class="summernote">'. htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) .'</div>

                                <div class="well well-sm">

                                    <input id="id" readonly style="display: none;" value="'. $thing['blogID'] .'">

                                    <div id="body" class="summernote">'. htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) .'</div>

                                </div>

                            </div>

                        </div>';

                    }

                }else{


                    $blogSideBar = new blog();

                    $blogSideArr = $blogSideBar->fetchByPage(BlogSideBar);

                    $blogSidePic = new picture();

                    $blogSidePicArr = $blogSidePic->fetchByPage(BlogSideBarPic);

                    foreach($blogSidePicArr as $thing){

                        echo'
                        <div class="col-md-3 col-lg-3">

                            <div class="row">
                                
                                    

                                    <img src="'. $thing['pictureLocation'] .'\\'. $thing['pictureTitle'] .'" height="auto" width="100%">



                            </div>';


                    }

                    foreach($blogSideArr as $thing){


                        echo'

                            <div class="row">

                                <div>'. htmlspecialchars_decode(urldecode($thing['blogTitle']), ENT_QUOTES) .'</div>

                                <div class="well well-sm">'. htmlspecialchars_decode(urldecode($thing['blogBody']), ENT_QUOTES) .'</div>

                            </div>

                        </div>';

                    }


                }


            }

            ?>
            
*/

//Wesley is going to work on restyling this to make it look better but currently it functions perfectly


    $blog = new blog();

    $entries = $blog->fetchDateAndPageReverse(Blog);
    ?>

<div class="col-md-3 col-lg-3">

    <h2>Browse Articles</h2>
      <div class="scrollable-menu" role="menu">
        <br>
    <?php

        foreach($entries as $entry){
            ?>
            <form action="blog-post.php" method="post">
            <button type="submit" class="btn btn-block btn-primary" name="id" value=<?php echo $entry['blogID']?>> <?php echo filter_var(htmlspecialchars_decode(urldecode($entry['blogTitle']), ENT_QUOTES), FILTER_SANITIZE_STRING) ?></button><br>
        </form>
            <?php
        }
        ?>

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

   
<?php

    if(isset($_SESSION['adminFull'])){

        if($_SESSION['adminFull']){

            echo'    <script>

                $(document).ready(function(){

                    SummerNoteBlogNew();
                    titleEdit();
                    SummerNote(); 

                    


                    $("#saveButton").click(function(){

                        var title = $("#titleNew.summernote").summernote("code");

                        $("#titleNew.summernote").summernote("reset");

                        console.log("The Title submitted: "+title);

                        var body = $("#bodyNew.summernote").summernote("code");

                        $("#bodyNew.summernote").summernote("reset");

                        console.log("The Body submitted: "+body);

                        CreateNewBlog(title, body);

                        location.reload();

                    });

                    $("button.deleteBlog").click(function(){

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
