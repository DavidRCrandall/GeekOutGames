<?php

require_once 'loginObject.php';
require_once 'eventObject.php';



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_SESSION['adminFull'])){

        if($_SESSION['adminFull']){

            if(isset($_POST['submitEdit'])){

                if(isset($_POST['eventID']) && isset($_POST['eventName']) && isset($_POST['eventDescription']) && isset($_POST['eventStart']) && isset($_POST['eventEnd']) && isset($_POST['eventProduct']) && isset($_POST['eventColor'])){

                    $eventUpdate = new event();

                    if(!$eventUpdate->updateEvent(
                        $_POST['eventName'], 
                        $_POST['eventDescription'], 
                        $_POST['eventStart'], 
                        $_POST['eventEnd'], 
                        $_POST['eventProduct'], 
                        $_POST['eventColor'], 
                        $_POST['eventID'] )){

                        $_SESSION['error'] = 'The event update failed';

                    unset($eventUpdate);

                    header('Location: ../events.php');

                    die();

                }else{

                    echo $_POST['eventColor'];

                    unset($eventUpdate);

                    header('Location: ../events.php');

                    die(); 

                }

            }else{

                $_SESSION['error'] = 'One of the fields was not set';

                header('Location: ../events.php');

                die();

            }

        }else{

            echo'THIS DOESNT WORK';

            header('Location: ../events.php');

            die();

        }  

    }else{

    $_SESSION['error'] = 'Please Log in.';

    header('Location: ../events.php');

    die();

}

}else{

    $_SESSION['error'] = 'Please Log in.';

    header('Location: ../events.php');

    die();

}

}else{

    $_SESSION['error'] = 'Please Log in.';

    header('Location: ../events.php');

    die();

}

?>