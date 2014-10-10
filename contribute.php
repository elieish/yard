
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
   $title           = $_POST['title'];
   $name            = $_POST['name'];
   $surname         = $_POST['surname'];
   $organization    = $_POST['organization'];
   $type            = $_POST['type'];
   $tel             = $_POST['tel'];
   $cell            = $_POST['cell'];
   $email           = $_POST['email'];
   $subject         = "Contribution Request";
   $message         = "Title : ".$title."<br>";
   $message         = "Name : ".$name."<br>";
   $message         = "Surname : ".$surname."<br>";
   $message         = "Organization : ".$organization."<br>";
   $message         = "Organization Type  : ".$type."<br>";
   $message         = "Telephone  : ".$tel."<br>";
   $message         = "Cellphone  : ".$cell."<br>";
   $message         .= "Email Address: ".$email."<br>";
   $message         .= "Message: <br>";
   $message         .= $_POST['message'];

   #Sending Email
    $receivers           = array('admin@theyardagency.org.za','elieish@gmail.com');
    foreach ($receivers as $value) {
         $to_email               = $value;
         $email_subject          = "Contribution Request";
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
    <title>YARD</title>
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

   <div class="container">
    <div id="yardslider">
            <div class="item"><img src="images/sliders/1.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/2.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/8.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/3.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/5.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/6.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/7.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/9.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/10.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/11.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/12.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/4.jpg" alt=""></div>
    </div>
    </div>

        <div class="site-header">
            <div class="container">
                <div class="main-header">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-10">
                            <div class="logo">
                                <a rel="nofollow" href="#">
                                    <img src="images/logo.png" alt="" title="">
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
                                    <li class="active"><a href="contribute.php">Contribute</a></li>
                                    <li><a href="contact.php">Contact</a></li>
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
                                <li class="active"><a href="contribute.php">Contribute</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div> <!-- /.menu-responsive -->
                    </div> <!-- /.col-md-12 -->
                </div>

            </div> <!-- /.container -->
        </div> <!-- /.site-header -->

        <div>

            <img src="images/pictureyard.jpg" alt="Ancillary Objectives" title="Ancillary Objectives"/>
        </div>

        <div class="middle-content">
            <div class="container">
            <div class="<?php  print $class ;?> alert alert-success" role="alert">Thank you! Your message has been sent successfully.</div>

                <div class ="row">
                    <div class="col-md-12">

                        <div class="sample-thumb">
                        <div>
                            <ul class="nav nav-pills nav-stacked">
                                  <li class="active">
                                    <a>What You’re Donating To
                                    </a>
                                  </li>
                              </ul>
                        </div>
                            <img src="images/picturec.jpg" alt="New Event" title="New Event"/>
                            <a href="#" class="list-group-item active"><font size="5"><center>
                                </center></font>
                            </a>

                            <div class="well well-lg">The work that we do and the development improvements our beneficiaries make are not possible without our funding and grant partners. It is their means which allows us to create opportunities and provide the support; which our beneficiaries use to change their lives. The funds received are a fundamental component in the missionto improve not only their socio-economic conditions, but also that of thousands of people whose development paths are connected to theirs. We thank and solute our donors for their generosity and encourage others to take up the banner with them.
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

                <div class="row"><!-- first row -->

                   <div class="col-md-6"><!-- first column -->
                            <div class="widget-item">

                                <div class="sample-thumb">
                                    <img src="images/about_11.jpg" alt="Our aims" title="Our aims">
                                </div> <!-- /.sample-thumb -->
                                <div class="list-group">
                                    <a href="#" class="list-group-item active"><font size="5"><center>
                                    When You Donate</center></font>
                                    </a>
                              <div class="well well-lg">
                                    1.    Consider calling us first, to let us know your intentions. Otherwise, <a href="#"><br>&#91;click here&#93;</a> to enquire about making a donation.<br><br>

                                     2.  Consider making yourself available for an appointment with us.
                                     We would be thrilled to show you around our projects and tell you more.
                                     Please fill in the form provided on this page.<br><br>
                                     3.  Ensure that you reference clearly your donation when you make a deposit.
                                     This will help us acknowledge your gift and accurately allocate it to the area of our work you wish to support.<br><br><br><br><br>
                             </div><!-- /.well well-lg -->
                                </div><!-- /.list-group -->
                            </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-6 -->
                    <div class="col-md-6"><!-- second column -->
                        <div class="widget-item">
                                <div class="sample-thumb">

                                </div> <!-- /.sample-thumb -->

                        <div class="col-md-12 col-sm-12">

                        <div class="contact-form">
                            <form name="contactform" id="contactform" action="contribute.php" method="post">
                                <p>
                                    <input name="title" type="text" id="title" placeholder="Title">
                                </p>
                                <p>
                                    <input name="name" type="text" id="name" placeholder="Name">
                                </p>
                                <p>
                                    <input name="surname" type="text" id="surname" placeholder="Surname">
                                </p>
                                <p>
                                    <input name="organization" type="text" id="organization you represent" placeholder="The Organization you Represent">
                                </p>
                                <p>
                                    <input name="type" type="text" id="name" placeholder="Type of Organization">
                                </p>
                                <p>
                                    <input name="tel" type="text" id="email" placeholder="Tel">
                                </p>
                                <p>
                                    <input name="cell" type="text" id="subject" placeholder="Cell">
                                </p>
                                <p>
                                    <input name="email" type="text" id="email" placeholder="Your Email">
                                </p>
                                <p>
                                    <textarea name="message" id="message" placeholder="Message"></textarea>
                                </p>
                                <input type="submit" class="mainBtn" value="Send Message" name="submit">
                            </form>
                        </div> <!-- /.contact-form -->
                    </div><!-- /.col-md-12 col-sm-12 -->
                                 <!-- /.list-group -->
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-6 -->
                </div><!-- row -->
                <!--Second rows-->
                <div class="row"><!-- first row -->

                   <div class="col-md-6"><!-- first column -->
                        <div class="widget-item">

                                <div class="sample-thumb">

                                </div> <!-- /.sample-thumb -->

                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-6 -->
                    <div class="col-md-6"><!-- second column -->
                        <div class="widget-item">
                            <div class="sample-thumb">

                            </div> <!-- /.sample-thumb -->

                        </div><!-- /.widget-item -->
                    </div> <!-- /.col-md-6 -->
                </div> <!-- /. first row -->
            </div><!-- /. container -->
            <div class="container">
                <div class ="row">
                   <div class="col-md-12">
                        <div class="sample-thumb">
                        <div>
                            <ul class="nav nav-pills nav-stacked">
                              <li class="active">
                              <a href="#">Projects to Donate To  </a></li>
                            </ul>
                        </div>
                            <img src="images/picture29.jpg" alt="New Event" title="New Event"/>
                            <a href="#" class="list-group-item active"><font size="5"><center>
                                </center></font>
                            </a>

                            <div class="well well-lg">There are a number of Projects we embark on, which provide necessary complementary support systems to the enterprises our beneficiaries are involved in. A few of these projects are in the consulting and business plan development phase. For info on our current and imminent projects, please click on one of the links below. You may also choose to donate to any other aspect of our work.

                        </div>
                        </div> <!--sample-thumb-->

                    </div><!--col-md-12-->
                </div><!-- /.row -->
        </div>

        <div class="partner-list">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">


                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">
                            <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="#">Uthungulu Fresh Produce Market  </a></li>
                            </ul>
                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">
                            <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="#">SMME Hub Facility  </a></li>
                            </ul>
                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">
                            <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="#">SMME Rd Repairs Project  </a></li>
                            </ul>
                        </div> <!-- /.partner-item -->
                    </div> <!-- /.col-md-2 -->
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="partner-item">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="#">Biodiesel Grain<br><br></a></li>
                            </ul>
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
                    "" <!-- /.col-md-4-->
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
