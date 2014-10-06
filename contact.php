
<?php
/**
 * Yard Development: AJAX Script
 *
 * @author Elie ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package YARD Development
 */
# Start Session
session_start();

# Include Required Scripts
include_once(dirname(__FILE__). "/backend/framework/include.php");
Application::include_models();
Application::include_helpers();
Application::db_connect();

if (isset($_POST['submit'])) {
   $name        = $_POST['name'];
   $email       = $_POST['email'];
   $subject     = $_POST['subject'];
   $message     = "Name : ".$name."<br>";
   $message     .= "Email Address: ".$email."<br>";
   $message     .= "Message: <br>";
   $message     .= $_POST['message'];

   #Sending Email
    $receivers           = array('admin@yardweb.co.za','elieish@gmail.com');
    foreach ($receivers as $value) {
         $to_email               = $value;
         $email_subject          = "Enquiry";
         html_email($to_email, $email_subject, $message, $message,$email);
    }

    $class = "";

}
else
{
    $class = "hidden";
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Contact Us - YARD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="templatemo">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
</head>
<body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
            <![endif]-->

        <div class="site-header">
            <div class="container">
                <div class="main-header">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-10">
                            <div class="logo">
                                <a rel="nofollow" href="#">
                                    <img src="images/logo.png" alt="travel by templatemo" title="">
                                </a>
                            </div> <!-- /.logo -->
                        </div> <!-- /.col-md-4 -->
                        <div class="col-md-8 col-sm-6 col-xs-2">
                            <div class="main-menu">
                                <ul class="visible-lg visible-md">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="members.php">Members</a></li>
                                    <li><a href="project.html">Projects</a></li>
                                    <li><a href="governance.html">Governance</a></li>
                                    <li><a href="contribute.php">Contribute</a></li>
                                    <li class="active"><a href="contact.php">Contact</a></li>
                                </ul>
                                <a href="#" class="toggle-menu visible-sm visible-xs">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div> <!-- /.main-menu -->
                        </div> <!-- /.col-md-8 -->
                    </div> <!-- /.row -->
                </div> <!-- /.main-header -->
                <div class="row">
                    <div class="col-md-12 visible-sm visible-xs">
                        <div class="menu-responsive">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="members.html">Members</a></li>
                                <li><a href="project.html">Projects</a></li>
                                <li><a href="governance.html">Governance</a></li>
                                <li><a href="contribute.php">Contribute</a></li>
                                <li class="active"><a href="contact.php">Contact</a></li>
                            </ul>
                        </div> <!-- /.menu-responsive -->
                    </div> <!-- /.col-md-12 -->
                </div>

            </div> <!-- /.container -->
        </div> <!-- /.site-header -->

        <div>
            <img src="images/pictureyard.jpg" alt="Ancillary Objectives" title="Ancillary Objectives">
        </div>

        <div class="middle-content">
            <div class="container">
                <div class="<?php  print $class ;?> alert alert-success" role="alert">Thank you! Your message has been sent successfully.</div>

                <div class="row"><!-- first row -->

                    <div class="col-md-6"><!-- second column -->
                        <div class="list-group">
                          <a href="#" class="list-group-item active">
                            <font size="5">
                                <center>
                                    Contact Details
                                </center>
                            </font>
                          </a>
                          <ul>
                            <li><h5>Operational Hours:</h5>

                                To reach YARD, please contact us Monday to Friday, between 8am and 5pm.</li>
                            <li><h5>Office Contact Details:</h5>
                                PO Box 2681, Umhlanga Rocks, 4320, KZN Province, South Africa</li>
                            <li><h5>Physical Address:</h5>
                                1B Iduli Close, Izinga Ridge, Durban, 4319, KZN Province, South Africa</li>
                            <li>Tel: +2731 822 2052</li>
                            <li><h5>Provincial Contacts:</h5>
                                To reach the provincial contacts of YARD, please visit our governance section of the site or click here to email us, to send the contact details to you.</li>
                            <li>Email: <a href="mailto:admin@yardweb.co.za">admin@yardweb.co.za</a></li>
                          </ul>
                        </div>
                    </div> <!-- /.col-md-6 -->
                   <div class="col-md-6"><!-- first column -->
                        <div class="contact-form">
                            <form name="contactform" id="contactform" action="contact.php" method="post">
                                <p>
                                    <input name="name" type="text" id="name" placeholder="Your Name">
                                </p>
                                <p>
                                    <input name="email" type="text" id="email" placeholder="Your Email">
                                </p>
                                <p>
                                    <input name="subject" type="text" id="subject" placeholder="Subject">
                                </p>
                                <p>
                                    <textarea name="message" id="message" placeholder="Message"></textarea>
                                </p>
                                <input type="submit" class="mainBtn" id="submit" name="submit" value="Send Message">
                            </form>
                        </div> <!-- /.contact-form -->
                    </div> <!-- /.col-md-6 -->
                </div><!-- row -->

                <div class="row"><!-- first row -->
                   <div class="col-md-12"><!-- first column -->
                        <div class="google-map">
                            <h1>Google Map</h1>
                        </div> <!-- /.contact-form -->
                    </div> <!-- /.col-md-6 -->
                </div><!-- row -->
            </div><!-- /. container -->
            </div><!-- /. container -->
            <div class="partner-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">

                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">

                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">

                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">

                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">

                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item last">

                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.partner-list -->


        <div class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="footer-logo">
                            <a href="index.php">
                                <img src="images/logo.png" alt="">
                            </a>
                        </div><!-- footer-logo -->
                    </div> <!-- /.col-md-4 -->

                    <div class="col-md-4 col-sm-4">
                        <div class="copyright">
                            <span>Copyright &copy; 2014 <a href="frontend/login.php">YARD</a> </span>
                        </div>
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-4">
                        <ul class="social-icons">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div> <!-- /.col-md-4-->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.site-footer -->



        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/bootstrap.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

<!-- mack kapya D 409 YARD -->
</body>
</html>
