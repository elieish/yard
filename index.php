<?php
# Start Session
session_start();

# Include Required Scripts
include_once(dirname(__FILE__). "/backend/framework/include.php");
Application::include_models();
Application::include_helpers();
Application::db_connect();

$title          = titles_select();
$province       = provinces_select();
?>
<html>
  <head>
    <title>Yard</title>
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
    <!-- JavaScripts -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery.singlePageNav.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/validate.js"></script>

    <script src="js/custom.js"></script>
     <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery.lightbox.js"></script>
    <script src="js/templatemo_custom.js"></script>
    <script src="js/jquery-git2.js"></script><!-- previous next script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
  </head>
  <body>

        <div class="site-header">
            <div class="container">
                <div class="main-header">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-10">
                            <div class="logo">
                                <a rel="nofollow" href="#">
                                    <img src="images/logo.png" alt="travel by templatemo" title="travel - free html5 template">
                                </a>
                            </div> <!-- /.logo -->
                        </div> <!-- /.col-md-4 -->
                        <div class="col-md-8 col-sm-6 col-xs-2">
                            <div class="main-menu">
                                <ul class="visible-lg visible-md">
                                    <li class="active"><a href="index.php">Home</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="members.php">Members</a></li>
									<li><a href="#">Projects</a></li>
                                	<li><a href="#">Governance</a></li>
									<li><a href="#">Contribute</a></li>
                                    <li><a href="#">Contact</a></li>
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
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="members.php">Members</a></li>
								<li><a href="#">Projects</a></li>
                                <li><a href="#">Governance</a></li>
								<li><a href="#">Contribute</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div> <!-- /.menu-responsive -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.site-header -->

        <div class="flexslider">
            <ul class="slides">
                <li>
                    <div class="overlay"></div>
                    <img src="images/templatemo_slide_1.jpg" alt="Special 1">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-lg-4">
                                <div class="flex-caption visible-lg">

                                    <h3 class="title">OUR AIMS</h3>
                                    <p>The Aims of YARD are to:
                                        Promote and support the developmental objectives of disadvantaged and impoverished youth, through self-help collective programmes and organizational structures of YARD, in rural and similarly underdeveloped areas . . . </p>
                                        <br>

                            			<!--<a rel="nofollow" href="http://unsplash.com">Unsplash</a>.</p>-->
                                    <!--<a href="#" class="slider-btn">Pre-booking</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="overlay"></div>
                    <img src="images/templatemo_slide_2.jpg" alt="Special 2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-lg-4">
                                <div class="flex-caption visible-lg">

                                    <h3 class="title">OUR OBJECTIVES</h3>
                                    <p>The Ancillary Objectives of YARD ensure that the development objectives of disadvantaged and impoverished youth, in self-help collective programmes and organizational structures, in rural and similarly underdeveloped areas, are achieved in terms of . . . . </p>
                                    <!--<a href="#" class="slider-btn">Reserve Now</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="overlay"></div>
                    <img src="images/templatemo_slide_3.jpg" alt="Special 3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-lg-4">
                                <div class="flex-caption visible-lg">

                                    <h3 class="title">MISSION STATEMENT</h3>
                                    <p>YARD undergirds stable socio-economic growth and national development, through cultivating and availing support resources, while administrating and managing their distribution, for youth-led entrepreneurial projects and their related organizational needs throughout South Africa.</p>
                                    <!--<a href="#" class="slider-btn">&nbsp;</a>-->
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </div> <!-- /.flexslider -->



        <div class="container">
            <div class="row">
                <div class="our-listing owl-carousel">
                 <!--   <div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>Italy</h4>
                            </div>
                            <img src="images/destination_1.jpg" alt="destination 1">
                        </div> <!-- /.list-thumb
                        <div class="list-content">
                            <h5>Rome, Milan, Naples</h5>
                            <span>SILVER HOTEL, 4 NIGHTS, 5 STARS</span>
                            <a href="#" class="price-btn">$1,800 Book Now</a>
                        </div>
                    </div>-->
                    <div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>OUR AIMS</h4>
                            </div>
                            <img src="images/destination_2.jpg" alt="destination 2">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">
                            <h5></h5>
                            <span>&nbsp;</span>
                            <a href="about.html" class="price-btn">MORE INFO</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
                    <div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>OUR OBJECTIVES</h4>
                            </div>
                            <img src="images/destination_3.jpg" alt="destination 3">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">
                            <h5></h5>
                            <span>&nbsp;</span>
                            <a href="about.html" class="price-btn">MORE INFO</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
                    <div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>ORGANIZATIONAL STRUCTURE</h4>
                            </div>
                            <img src="images/destination_4.jpg" alt="destination 4">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">
                            <h5></h5>
                            <span>&nbsp;</span>
                            <a href="about.html" class="price-btn">MORE INFO</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
                    <div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>VIDEOS</h4>
                            </div>
                            <img src="images/destination_5.jpg" alt="destination 5">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">
                            <h5></h5>
                            <span>&nbsp;</span>
                            <a href="#" class="price-btn">MORE VIDEOS</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
                </div> <!-- /.our-listing -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->

		<div class="middle-content"></div>

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
                            <a href="index.html">
                                <img src="images/logo.png" alt="">
                            </a>
                        </div>
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="copyright">
                            <span>Copyright &copy; 2014 <a href="#">YARD</a></span>
                        </div>
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-4">
                        <ul class="social-icons">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div> <!-- /.col-md-4 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.site-footer -->

        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/bootstrap.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
         <!-- Bootstrap Core JavaScript -->
        <script src="js/jquery-ui.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>
        <script src="js/main.js"></script>

</html>

