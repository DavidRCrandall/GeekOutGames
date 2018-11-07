<?php 
require_once 'inc/nav.php';
require_once 'inc/loginObject.php';
require_once 'inc/eventObject.php';

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

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Summernote JS -->
    <script src="js\summernote\dist\summernote.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

    <!-- Scripts and styling for FullCalendar -->
    <link rel="stylesheet" href="calendar/fullcalendar.css" />
    <script src='calendar/lib/jquery.min.js'></script>
    <script src="calendar/lib/moment.min.js"></script>
    <script src="calendar/fullcalendar.js"></script>
    <script type="text/javascript" src="js/datetimepicker.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <style>

        .scrollable-menu {
            height: auto;
            max-height: 400px;
            overflow-x: hidden;
        }

    </style>    

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

        <!-- Display Navbar -->
        <?php DisplayNav("index");
        if(isset($_SESSION['ATTEND'])){
            echo $_SESSION['ATTEND'];
            unset($_SESSION['ATTEND']);
        }

        $event = new event();

        $events = $event->fetchAll();

        if(isset($_SESSION['error'])){

            echo'

            <div class="alert alert-danger">

                <strong>ATTENTION!</strong>'.$_SESSION['error'].'

            </div>

            ';

            unset($_SESSION['error']);

        }

        ?>

        <div class="container">



            <script>

                $(document).ready(function() {

                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        selectHelper: true,
                        editable: false,
                        eventLimit: true,
                        navLinks: true,

                        events: 'inc/events.json'

                    });

                    $(".date").datetimepicker({

                        format:"YYYY-MM-DD HH:mm:ss"

                    });


                });

            </script>



            <div class="col-md-8" style="margin-top: 2em;">
                <div id="calendar"></div>
            </div>

            <!-- This is where the event list will be displayed -->
            <div class="col-md-4">

                <div class="row">

                    <img src="images/GOG_Logo_FullColor.jpg" class="pull-right" margin-top: 2rem;" width="150" height="150">

                </div>
                <hr>
                <div class="row">

                    <?php 

                    if($_SESSION['adminFull']){

                       echo'

                       <div class="container">

                        <div class="row">

                            <a class="btn btn-lg btn-primary pull-left" style="vertical-align: bottom;" href="inc/eventCreate.php">Create Event</a>

                        </div>

                    </div>

                    <br>
                    ';

                }

                ?>

                <div class="scrollable-menu" role="menu">

                    <?php  

                    if($_SESSION['adminFull']){

                        foreach($events as $thing){



                            echo'
                            <div class="panel panel-default">

                                <div class="panel-body">

                                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4"style="background: '.$thing['eventColor'].';">'.$thing['eventName'].'</div>

                                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">Current Attendance:'.$event->countFourms($thing['eventID']).'</div>

                                    <!-- Trigger the modal with a button -->
                                    <div class="col-md-4 col-lg-4">

                                        <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#event'.$thing['eventID'].'">Edit</button>

                                    </div>

                                    <!-- Modal -->
                                    <div id="event'.$thing['eventID'].'" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit: '.$thing['eventName'].'</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="inc/eventEdit.php" method="post">

                                                        <input type="text" name="eventID" readonly style="display: none;" value="'.$thing['eventID'].'">

                                                        Event Name:<input name="eventName" type="text" class="form-control" value="'.$thing['eventName'].'">

                                                        Event Description:<input name="eventDescription" type="text" class="form-control" value="'.$thing['eventDescription'].'">

                                                        Date Start:<input id="dateStart'.$thing['eventID'].'" class="date form-control" name="eventStart" type="text" value="'.$thing['eventStart'].'">
                                                        
                                                        Date End:<input id="dateEnd'.$thing['eventID'].'" class="date form-control" name="eventEnd" type="text" value="'.$thing['eventEnd'].'">

                                                        Product: <input name="eventProduct" class="form-control" type="text" value="'.$thing['eventProduct'].'">

                                                        Event Color: <input name="eventColor" type="color" class="form-control" value="'.$thing['eventColor'].'">

                                                        <input name="submitEdit" type="submit" class="btn btn-success form-control" value="Save Changes">

                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>                               

                            ';

                        }


                    }else{

                        if(isset($_SESSION['LOGIN'])){

                                //user logged in
                            foreach($events as $thing){

                                echo'
                                <div class="panel panel-default">

                                    <div class="panel-body">

                                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="background: '.$thing['eventColor'].';">'.$thing['eventName'].'</div>


                                        <!-- Details form -->
                                        <!-- Trigger the modal with a button -->
                                        <div class="col-md- col-lg-4">

                                            <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#event'.$thing['eventID'].'">Details</button>

                                        </div>

                                        <!-- Modal -->
                                        <div id="event'.$thing['eventID'].'" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h1 class="modal-title">'.$thing['eventName'].'</h1>
                                                    </div>
                                                    <div class="modal-body">

                                                        <u><h2>Event Description:</h2></u><p>'.$thing['eventDescription'].'</p>

                                                        <u><h2>Date Start:</h2></u><h3>'.$thing['eventStart'].'</h3><br>

                                                        <u><h2>Date End:</h2></u><h3>'.$thing['eventEnd'].'</h3><br>

                                                        <u><h2>Product:</h2></u><h3>'.$thing['eventProduct'].'</h3><br>

                                                        <form action="inc/userAttend.php" method="post">

                                                            <input name="id" type="text" readonly style="display: none;" value="'.$thing['eventID'].'">

                                                            <input name="submit" type="submit" class="btn btn-block btn-success pull-right" value="Attend">

                                                        </form><br><br>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>                               

                                ';

                            }


                        }else{

                    //No user logged in
                            foreach($events as $thing){

                                echo'
                                <div class="panel panel-default">

                                    <div class="panel-body">

                                        <div class="col-md-4 col-lg-4" style="background: '.$thing['eventColor'].';">'.$thing['eventName'].'</div>


                                        <!-- Details form -->
                                        <!-- Trigger the modal with a button -->
                                        <div class="col-md-4 col-lg-4">

                                            <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#attend'.$thing['eventID'].'">Attend</button>

                                        </div>

                                        <!-- Modal -->
                                        <div id="attend'.$thing['eventID'].'" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h1 class="modal-title" >'.$thing['eventName'].'</h1>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="inc/guestAttend.php" method="post">

                                                            <input name="id" type="text" readonly style="display: none;">

                                                            <!-- put fourm data in here -->
                                                            *First Name:<input name="FirstName" type="text" class="form-control" required>

                                                            *Last Name:<input name="LastName" type="text" class="form-control" required>

                                                            *Email:<input name="Email" type="email" class="form-control" required>
                                                            
                                                            Phone Number:<input name="Phone" type="text" class="form-control">
                                                            <br>

                                                            Recive Reminders <input type="checkbox" name = "Push" value="true">

                                                            <br>
                                                            <input name="submit" type="submit" class="btn btn-sm btn-success pull-right" value="Attend">
                                                            <br>

                                                        </form>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <!-- Details form -->
                                        <!-- Trigger the modal with a button -->
                                        <div class="col-md-4 col-lg-4">

                                            <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#details'.$thing['eventID'].'">Details</button>

                                        </div>

                                        <!-- Modal -->
                                        <div id="details'.$thing['eventID'].'" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h1 class="modal-title">'.$thing['eventName'].'</h1>
                                                    </div>
                                                    <div class="modal-body">

                                                        <u><h2>Event Description:</h2></u><p>'.$thing['eventDescription'].'</p>

                                                        <u><h2>Date Start:</h2></u><h3>'.$thing['eventStart'].'</h3><br>

                                                        <u><h2>Date End:</h2></u><h3>'.$thing['eventEnd'].'</h3><br>

                                                        <u><h2>Product:</h2></u><h3>'.$thing['eventProduct'].'</h3><br>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                </div>                               

                                ';

                            }                                

                        }

                    }

                    ?>

                </div>

            </div>
        </div>
    </div>
</body>
</html>