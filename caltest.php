<?php 
// Database links here

?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Geek Out Games</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


	<!-- Scripts and styling for FullCalendar -->
    <link rel="stylesheet" href="calendar/fullcalendar.css" />
	<script src='calendar/lib/jquery.min.js'></script>
	<script src="calendar/lib/moment.min.js"></script>
	<script src="calendar/fullcalendar.js"></script>

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
	
	<!--<script src="moment.js"></script>
	<script>
	    moment().format();
	</script>-->

	<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			/*googleCalKey: 'AIzaSyCxbzLkjlLBULDX3pymD8BaRj0QaBxc2Pw',
			events: {
				googleCalID: 'vdsq5a9r82013lmcoscfao7hkk@group.calendar.google.com'
			}*/

			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectHelper: true,
			editable: false,
			eventLimit: true,
			navLinks: true,

			events: 'js/events.json'

		});


	});

	</script>

	<!-- js file for event data javascript functions 
	<script src="test.js"></script>-->
	
	<div class="col-md-8">
		<div id="calendar"></div>
	</div>

	

</body>


</html>