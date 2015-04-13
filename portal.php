<?php
session_start();
if(!isset($_SESSION['username'])){
	$_SESSION["message"] = "Please login to access the Portal";
   header("Location:index.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">

<?php 
require_once 'config/init.php';?>


<!-- OPEN HEADER -->
<head>

<!-- TITLE -->
<title>Zeus Web Portal - Android Open Source Theft Solution</title>

<!-- META DATA -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- FAVICON LINK -->
<link rel="icon" type="image/x-icon" href="http://zeus.benjarke.com/assets/images/theme/favicon.ico">

<!-- CSS FILES -->
<link rel="stylesheet" href="http://zeus.benjarke.com/assets/css/bootstrap.css">
<link rel="stylesheet" href="http://zeus.benjarke.com/assets/css/extra.css">

<!-- CUSTOM FONTS -->
<link href="http://zeus.benjarke.com/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

<!-- GOOGLE LIBS -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />

<!-- JAVASCRIPT FILES -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbGXsjMbXWXfkbUGEMaLYB1i2qM6HDDLY"></script>

<!--PHP TO GRAB LOCATION COORDINATES FROM DB -->
<?php
$id = $_SESSION['id'];

//GET LAT 
$querylat = "SELECT lat FROM ZeusUsers WHERE id=$id";
$result = mysqli_query($link,$querylat) or exit("Error in query: $query. " . mysqli_error());
$row=$result->fetch_assoc();
$lat=$row['lat'];

//GET LNG 
$querylng = "SELECT lng FROM ZeusUsers WHERE id=$id";
$result = mysqli_query($link,$querylng) or exit("Error in query: $query. " . mysqli_error());
$row=$result->fetch_assoc();
$lng=$row['lng'];

//GET ACC 
$queryacc = "SELECT acc FROM ZeusUsers WHERE id=$id";
$result = mysqli_query($link,$queryacc) or exit("Error in query: $query. " . mysqli_error());
$row=$result->fetch_assoc();
$acc=$row['acc'];

if(!isset($lng,$lat,$acc)) {
   $lat = 0;
   $lng = 0;
   $acc = 0;
}
?>
<!--END OF PHP FOR LOCATION -->

<!-- GOOGLE MAP API JAVASCRIPT -->
<script type="text/javascript">
      function initialize() {
  var lat = "<?php echo $lat; ?>";
  var lng = "<?php echo $lng; ?>";
  
  var myLatlng = new google.maps.LatLng(lat,lng);
  var mapOptions = {
    zoom: 18,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Last Known Location'
  });
// Add circle overlay and bind to marker
var circle = new google.maps.Circle({
  map: map,
  radius: <?php echo $acc; ?>,
  fillColor: '#ADEAEA',
  strokeColor: '#388E8E',
  strokeWidth: '1',
});
circle.bindTo('center', marker, 'position');
}
google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    
<!-- CLOSE HEADER -->     
</head>

<body id="page-top" class="index">

     <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Logo and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Zeus</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    
                    
                    <li class="page-scroll">
                        <a href="#AlarmModal" class="portfolio-link" data-toggle="modal">Alarm</a>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="#LockModal" class="portfolio-link" data-toggle="modal">Lock</a>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="#MessageModal" class="portfolio-link" data-toggle="modal">Message</a>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="/assets/scripts/location.php?id=<?php print $_SESSION['notification_id']?>">Track</a>
                    </li>
                    
                    
                    
                    <li class="page-scroll">
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    
                    <div id="map-canvas"></div>
                    
                    
                </div>
            </div>
        </div>
    </header>

    

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                    <h3>About Zeus</h3>
                        <p>Zeus is a free, open source Android anti-theft solution created by <a href="https://twitter.com/benjarke">&#64;Benjarke</a>.</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/benjarke/" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/+BenClarke1/posts" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="https://www.twitter.com/benjarke" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://uk.linkedin.com/pub/benjamin-clarke/60/aa7/8a0" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Purpose</h3>
                        <p>Designed &amp; developed as final year project at <a href="http://leedsbeckett.ac.uk">Leeds Beckett University</a>.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Zeus
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    
    
    <!-- ALARM MODAL -->
    <div class="portfolio-modal modal fade" id="AlarmModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Sound Alarm</h2>
                            <hr class="star-primary">
                            	<div class="col-lg-4 col-lg-offset-2">
                            	<img src="assets/img/portfolio/speaker.png" class="img-responsive img-centered" alt="">
                                </div>
                                
                                <div class="col-lg-4 control-group">
                                <form class="text-center" id="formpad" action="/assets/scripts/alarm.php" method="POST">
                                <input name="id" id="id" type="hidden" value="<?php print $_SESSION['notification_id']?>">
                                <label class="control-label"><h3> Alarm Sound</h3></label>
                                <div class="controls">
                                	<label class="radio">
                                		<input name="alrm" id="alrm" type="radio" value="ring" checked> Ring</label>
                                    <label class="radio">
                                		<input name="alrm" id="alrm" type="radio" value="ring"> Siren</label>
                                    <label class="radio">
                                		<input name="alrm" id="alrm" type="radio" value="ring"> Modem</label>
                                    <label class="radio">
                                		<input name="alrm" id="alrm" type="radio" value="ring"> Alarm</label>
                                </div>
                                
                                <br><br>
                                <input type="submit" class="btn btn-success" id="lckbtn" value="Activate">
                                </form>
                                <br>
                                <form class="text-center" id="formpad" action="/assets/scripts/alarmstop.php" method="POST">
                                <input name="id" id="id" type="hidden" value="<?php print $_SESSION['notification_id']?>">
                                <input type="submit" class="btn btn-danger" id="lckbtn" value="Stop Alarm">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF ALARM MODAL-->
    
    <!-- LOCK MODAL -->
    <div class="portfolio-modal modal fade" id="LockModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Lock Device</h2>
                            <hr class="star-primary">
                            	<div class="col-lg-4 col-lg-offset-2">
                            	<img src="assets/img/portfolio/lock-open.png" class="img-responsive img-centered" alt="">
                                </div>
                                
                                <div class="col-lg-4 control-group">
                                <br><br>
                                <form class="text-center" id="formpad" action="/assets/scripts/lock.php" method="POST">
                                <input name="id" id="id" type="hidden" value="<?php print $_SESSION['notification_id']?>">
                                <input name="pwd" id="pwd" type="text" placeholder="Password" required>
                                <br><br><br>
                                <input type="submit" class="btn btn-success" id="lckbtn" value="Lock Device">
                                </form>
                                <br>
                                <form class="text-center" id="formpad" action="/assets/scripts/unlock.php" method="POST">
                                <input name="id" id="id" type="hidden" value="<?php print $_SESSION['notification_id']?>">
                                <input type="submit" class="btn btn-danger" id="lckbtn" value="Unlock Device">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF LOCK MODAL-->
    
    <!-- MESSAGE MODAL -->
    <div class="portfolio-modal modal fade" id="MessageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Display a Message</h2>
                            <hr class="star-primary">
                            	<div class="col-lg-4 col-lg-offset-2">
                            	<img src="assets/img/portfolio/alert.png" class="img-responsive img-centered" alt="">
                                </div>
                                
                                <div class="col-lg-4 control-group">
                                <br><br>
                                <form class="text-center" id="formpad" action="/assets/scripts/message.php" method="POST">
                                <input name="id" id="id" type="hidden" value="<?php print $_SESSION['notification_id']?>">
                                <input name="msg" id="msg" type="text" placeholder="Message to Display">
                                <br><br><br>
                                <input type="submit" class="btn btn-success" id="lckbtn" value="Send">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF MESSAGE MODAL-->
    
    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="assets/js/classie.js"></script>
    <script src="assets/js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript 
    <script src="assets/js/jqBootstrapValidation.js"></script>
    <script src="assets/js/contact_me.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="assets/js/freelancer.js"></script>
    
    <!-- RELOAD SCRIPT -->
    <script type="text/javascript">
	if(location.search.indexOf('reloaded=yes') < 0){
		var hash = window.location.hash;
		var loc = window.location.href.replace(hash, '');
		loc += (loc.indexOf('?') < 0? '?' : '&') + 'reloaded=yes';
		setTimeout(function(){window.location.href = loc + hash;}, 7500);
	}
	</script>

</body>
</html>