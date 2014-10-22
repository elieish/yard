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
    <title>Home - YARD</title>
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

   <div class="container">
    <div id="yardslider">
            <div class="item"><img src="images/sliders/1.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/2.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/8.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/3.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/6.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/7.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/9.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/10.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/11.jpg" alt=""></div>
            <div class="item"><img src="images/sliders/12.jpg" alt=""></div>

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
                                    <li class="active"><a href="index.php">Home</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="members.php">Members</a></li>
									<li><a href="project.html">Projects</a></li>
                                	<li><a href="governance.html">Governance</a></li>
									<li><a href="contribute.php">Contribute</a></li>
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
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="members.php">Members</a></li>
								<li><a href="project.html">Projects</a></li>
                                <li><a href="governance.html">Governance</a></li>
								<li><a href="contribute.php">Contribute</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div> <!-- /.menu-responsive -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.site-header -->



        <div class="middle-content">
        <div class="container">
            <div class="row">
                <div class="our-listing">
                    <div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>OUR AIMS</h4>
                            </div>
                            <img src="images/destination_2.jpg" alt="destination 2">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">
                            <a href="subpage.html" class="price-btn">MORE INFO</a>
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
                            <a href="subpage2.html" class="price-btn">MORE INFO</a>
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

                            <a href="about.html" class="price-btn">MORE INFO</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
                    <div class="list-item">
                        <div class="list-thumb">
                            <div class="title">
                                <h4>YARD Statistics</h4>
                            </div>
                            <img src="images/Home/home.jpg" alt="destination 5">
                        </div> <!-- /.list-thumb -->
                        <div class="list-content">

                            <a href="members.php" class="price-btn">MORE INFO</a>
                        </div> <!-- /.list-content -->
                    </div> <!-- /.list-item -->
                </div> <!-- /.our-listing -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
        </div>

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
                            <span>Copyright &copy; 2014 <a href="frontend/login.php">YARD</a><i class="fa fa-login fa-fw"></i></span>
                        </div>
                    </div> <!-- /.col-md-4 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.site-footer -->

        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/bootstrap.js"></script>
        <script src="js/plugins.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
         <!-- Bootstrap Core JavaScript -->
        <script src="js/jquery-ui.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>
        <script src="js/main.js"></script>

        <!-- Start of StatCounter Code for Default Guide -->
        <script type="text/javascript">
        var sc_project=10093677;
        var sc_invisible=0;
        var sc_security="a056a256";
        var scJsHost = (("https:" == document.location.protocol) ?
        "https://secure." : "http://www.");
        document.write("<sc"+"ript type='text/javascript' src='" +
        scJsHost+
        "statcounter.com/counter/counter.js'></"+"script>");
        </script>
        <noscript><div class="statcounter"><a title="click tracking"
        href="http://statcounter.com/" target="_blank"><img
        class="statcounter"
        src="http://c.statcounter.com/10093677/0/a056a256/0/"
        alt="click tracking"></a></div></noscript>
        <!-- End of StatCounter Code for Default Guide -->
        <a href="http://statcounter.com/p10093677/?guest=1">View MyStats</a>
</html>

