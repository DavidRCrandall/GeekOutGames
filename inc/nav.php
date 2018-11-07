<?php
// Displays the navbar with the current page showing as active
function DisplayNav ($id) {
    echo "
    <nav class=\"navbar navbar-default navbar-fixed-top\" role=\"navigation\">
        <div class=\"container\">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"index.php\">Geek Out Games</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav navbar-right\">";
                if ($id == "about") {
                    echo "<li class=\"active\">";
                } else {
                    echo "<li>";
                }
                    echo "<a href=\"about.php\">About</a>
                    </li>";
                if ($id == "events") {
                    echo "<li class=\"active\">";
                } else {
                    echo "<li>";
                }
                    echo "<a href=\"events.php\">Events</a>
                    </li>";
                if ($id == "products") {
                    echo "<li class=\"active\">";
                } else {
                    echo "<li>";
                }
                    echo "<a href=\"products.php\">Products</a>
                    </li>";
                if ($id == "contact") {
                    echo "<li class=\"active\">";
                } else {
                    echo "<li>";
                }
                    echo "<a href=\"contact.php\">Contact</a>
                    </li>";
                if ($id == "blog") {
                    echo "<li class=\"active\">";
                } else {
                    echo "<li>";
                }
                    echo "<a href=\"blog-home-1.php\">Chief Geek's Blog</a>
                    </li>";
                    ?>

                    <?php
                    echo "<li>";


    if(!isset($_SESSION['LOGIN'])){
       
        echo '<a data-toggle="modal" data-target="#login">Log In</a>

                <!-- Modal -->
                <div id="login" class="modal fade" role="dialog" data-backdrop="false">
                  <div class="modal-dialog" >

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Login In</h4>
                      </div>
                      <div class="modal-body">
                        <form action="login.php" method="post">
                            Username:<br> <input type="text" name="username"><br>
                            Pasword:<br>  <input type="password" name="password"><br>

                            <input type="text"  style="display: none;" readonly value="'.$_SERVER['PHP_SELF'].'" name="page">
                            <br/>
                            <input type="submit" value="Submit">
                        </form>
                        <br/>
                        <a href="recover.php">Forgot Password?</a>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>';

    }else{
        

    echo'<a data-toggle="modal" data-target="#signout">User Services</a>

        <!-- Modal -->
        <div id="signout" class="modal fade" role="dialog" data-backdrop="false">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sign Out</h4>
              </div>
              <div class="modal-body">

                    <a class="btn btn-primary form-control" href="profile.php">Your Profile</a>
                    <hr>

                    <form action="login.php" method="post">
                     <button type="submit" class="btn-danger form-control" name="signout" value=1>Sign Out</button>
                     <input type="text"  style="display: none;" readonly value="'.$_SERVER['REQUEST_URI'].'" name="page">
                    </form>

                    
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>';

    }

                    echo " </li>
                    </ul>



            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>";
} 
?>
