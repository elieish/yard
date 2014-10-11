
<?php
/**
 * YARDDevelopment: AJAX Script
 *
 * @author Elie ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package YARDDevelopment
 */
# Start Session
session_start();

# Include Required Scripts
include_once(dirname(__FILE__). "/backend/framework/include.php");
Application::include_models();
Application::include_helpers();
Application::db_connect();
$title          = titles_select();
$province       = provinces_select();
$date_select    = html_date();

#Global Variables
global $_db;

$no_of_members		= $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM members");
$no_of_females		= $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM members WHERE gender=2");
$no_of_males		  = $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM members WHERE gender=1");

$members_15_20		= $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM members WHERE (YEAR(now()) - YEAR(dob)) >= 15 AND (YEAR(now()) - YEAR(dob)) <= 20");
$members_21_25		= $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM members WHERE (YEAR(now()) - YEAR(dob)) >= 21 AND (YEAR(now()) - YEAR(dob)) <= 25");
$members_26_30		= $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM members WHERE (YEAR(now()) - YEAR(dob)) >= 26 AND (YEAR(now()) - YEAR(dob)) <= 30");

$members_31_35		= $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM members WHERE (YEAR(now()) - YEAR(dob)) >= 31 AND (YEAR(now()) - YEAR(dob)) <= 35");
$no_of_districts	= $_db->fetch_single("SELECT COUNT(DISTINCT(`district`)) AS 'count' FROM members ");
$no_of_locals		  = $_db->fetch_single("SELECT COUNT(DISTINCT(`local_area`)) AS 'count' FROM members ");

$no_of_coops		  = $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM `members` WHERE group_id = 2");
$no_of_smmes		  = $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM `members` WHERE group_id = 1");
$no_of_individuals= $_db->fetch_single("SELECT COUNT('uid') AS 'count' FROM `members` WHERE group_id = 3");

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
    <title>Members - YARD</title>
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
    <link rel="stylesheet" href="js/datepicker/css/datepicker.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- JavaScripts -->
    <script src="js/vendor/jquery-1.11.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="js/jquery.singlePageNav.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.lightbox.js"></script>
    <script src="js/templatemo_custom.js"></script>
    <script src="js/jquery-git2.js"></script><!-- previous next script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <script src="js/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="js/main.js"></script>
    <script src="js/member.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/php.js"></script>
    <script src="js/forms.js"></script>
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
                                    <li class="active"><a href="members.php">Members</a></li>
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
                                <li><a href="index.php">Home</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li class="active"><a href="members.php">Members</a></li>
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
                <div class ="row">
                  <div class="col-md-12">
                    <div class="sample-thumb">
                    	 <div class="panel panel-default">
                              <div class="bordertitle">
                                  <span class="glyphicon glyphicon-stats"></span> Statistics
                              </div>
                    	     <div  class="panel-body">


            							     <div class="row">
                    								<div class="col-lg-3">
                    									<ul class="list-group">
                    									  <li class="list-group-item list-group-item-success btn-xs"><span class="badge"><?php echo $no_of_members;?></span>No. of Members</li>
                    									  <li class="list-group-item list-group-item-info btn-xs"><span class="badge"><?php echo $no_of_females;?></span>No. of Females</li>
                    									  <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $no_of_males;?></span>No. of Males</li>
                    									 </ul>
                    								</div>
                    								<div class="col-lg-3">
                    									<ul class="list-group">
                    									  <li class="list-group-item list-group-item-success btn-xs"><span class="badge"><?php echo $members_15_20;?></span>Members aged 15-20</li>
                    									  <li class="list-group-item list-group-item-info btn-xs"><span class="badge"><?php echo $members_21_25;?></span>Members aged 21-25</li>
                    									  <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $members_26_30;?></span>Members aged 26-30</li>
                    									 </ul>
                    								</div>
                    								<div class="col-lg-3">
                    									<ul class="list-group">
                    									  <li class="list-group-item list-group-item-success btn-xs"><span class="badge"><?php echo $members_31_35;?></span>Members aged 31-35</li>
                    									  <li class="list-group-item list-group-item-info btn-xs"><span class="badge"><?php echo $no_of_districts;?></span><small>No. of Active Districts</small></li>
                    									  <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $no_of_locals;?></span><small>No. of Active Local Area/Wards</small></li>
                    									 </ul>
                    								</div>
                    								<div class="col-lg-3">
                    									<ul class="list-group">
                    									  <li class="list-group-item list-group-item-success btn-xs"><span class="badge"><?php echo $no_of_coops;?></span>No. of Co-ops </li>
                    									  <li class="list-group-item list-group-item-info btn-xs"><span class="badge"><?php echo $no_of_smmes;?></span>No. of SMMEs</li>
                    									  <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $no_of_individuals;?></span>No. of Individuals</li>
                    									 </ul>
                    								</div>
            							    </div>
							             </div>
						          </div>
                    </div>
                          <div class="bordertitle">
                          </div>

                            <div class="well well-lg">YARDundergirds stable socio-economic growth and national
                             development, through cultivating and availing support resources, while administrating
                             and managing their distribution, for youth-led entrepreneurial projects and their related
                              organizational needs throughout South Africa.
                            </div>
                    </div>
                </div>

                <div class="row"><!-- first row -->

                 <div class="col-md-4"><!-- first column -->

                  <div class="">


                    <div class="service-item"><!-- /.service-icon -->
                      <div class="service-content">


                       <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="frontend/login.php">National Official<br>Click here   </a></li>

                      </ul>
                    </div>
                    <!-- /.service-content -->
                  </div> <!-- /.service-item -->

                  <div class="service-item"><!-- /.service-icon -->
                    <div class="service-content">

                      <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="frontend/login.php">Provincial Official <br>Click here   </a></li>

                      </ul>
                    </div> <!-- /.service-content -->
                  </div> <!-- /.service-item -->

                  <div class="service-item"><!-- /.service-icon -->
                    <div class="service-content">

                      <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="frontend/login.php">District Official<br>Click here   </a></li>

                      </ul>
                    </div> <!-- /.service-content -->
                  </div> <!-- /.service-item -->

                  <div class="service-item"><!-- /.service-icon -->
                    <div class="service-content">

                      <ul class="nav nav-pills nav-stacked">
                        <li class="active" data-toggle="modal" data-target=".bs-example-modal-lg"><a href="#">To complete Membership Form<br> Click here</a></li>

                      </ul>
                      <!-- <button  data-target=".bs-example-modal-lg">Large modal</button> -->

                    </div> <!-- /.service-content -->
                  </div> <!-- /.service-item -->

                </div> <!-- /.widget-item -->

            </div> <!-- /.col-md-4 -->

            <div class="col-md-4"><!-- second column -->
                <div class="">
                  <div class="sample-thumb">
                    <img src="images/member1.jpg" alt="New Event" title="New Event">
                  </div> <!-- /.sample-thumb -->
                  <div class="list-group">
                                    <div class="bordertitle">
                                        National Level
                                    </div>

                                    <div class="well well-lg" style="min-height: 200px">
                                    While YARDprogrammes are rolled out on national level; investment, resourcing and the
                                    development activities are focused at the level of SMMEs, community-based youth
                                    co-operatives and youth-led organizational structures, in the various provinces, on
                                    local level. TYA exists to ensure that youth structures be developed for integration
                                    into the formal economy and achieve their socio-economic development aims. TYA is
                                    careful
                                    t to be bogged-down by the necessary internal bureaucratic and democratic processes, typical
                                    f a national organization.</div><!-- /.well well-lg -->
                                </div><!-- /.list-group -->
                </div> <!-- /.widget-item -->
            </div> <!-- /.col-md-4 -->
            <div class="col-md-4">

                  <ul class="list-group">
                    <li class="list-group-item list-group-item-success btn-xs"><span class="badge"><?php echo $no_of_members;?></span>No of SMMES</li>
                    <li class="list-group-item list-group-item-info btn-xs"><span class="badge"><?php echo $no_of_females;?></span>No of Members in SMMEs</li>
                    <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $no_of_males;?></span>No of Cooperatives</li>
                    <li class="list-group-item list-group-item-success btn-xs"><span class="badge"><?php echo $no_of_members;?></span>No of Membes in Cooperative</li>
                    <li class="list-group-item list-group-item-info btn-xs"><span class="badge"><?php echo $no_of_females;?></span>No of Members still as Individuals</li>
                    <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $no_of_males;?></span>No of Male District Leaders</li>
                    <li class="list-group-item list-group-item-success btn-xs"><span class="badge"><?php echo $no_of_members;?></span>No of Female District Leaders</li>
                    <li class="list-group-item list-group-item-info btn-xs"><span class="badge"><?php echo $no_of_females;?></span>No of District Leaders aged 20 - 25 yrs</li>
                    <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $no_of_males;?></span>No of District Leader aged 26 - 30 yrs</li>
                    <li class="list-group-item list-group-item-warning btn-xs"><span class="badge"><?php echo $no_of_males;?></span>No of District Leader aged 31 - 35 yrs</li>

                  </ul>

            </div>
            </div> <!-- /.row first -->

            <div class="row"><!-- second row -->

             <div class="col-md-4"><!-- first column -->
              <div class="">
                <div class="sample-thumb">
                  <img src="images/member2.jpg" alt="New" title="New">
                </div> <!-- /.sample-thumb -->
                <div class="list-group">
                                   <div class="bordertitle">
                                        Provincial
                                    </div>
                                    <div class="well well-lg" style="min-height: 200px">
                                      The Provincial office is the administrative head of the districts and their
                                      local beneficiaries’ structures. The structure is responsible for ensuring the
                                      successful roll-out and governance of the YARDprogramme in each province.</div><!-- /.well well-lg -->
                                </div><!-- /.list-group -->

              </div> <!-- /.widget-item -->
            </div> <!-- /.col-md-4 -->

            <div class="col-md-4"><!-- second column -->
              <div class="">
                <div class="sample-thumb">
                  <img src="images/member3.jpg" alt="New Event" title="New Event">
                </div> <!-- /.sample-thumb -->
                <div class="list-group">
                                    <div class="bordertitle">
                                        District
                                     </div>
                                    <div class="well well-lg" style="min-height: 200px">
                                    The District levels of YARDare critical for the implementation of
                                    the projects and enterprises on local level. Their direct oversight
                                    ensures that structures operate, intra-collaborate and filter critical
                                    information that informs the YARD
                                    </div><!-- /.well well-lg -->
                                </div><!-- /.list-group -->

              </div> <!-- /.widget-item -->
            </div> <!-- /.col-md-4 -->

            <div class="col-md-4"><!-- third column -->
              <div class=""
                <div class="sample-thumb">
                  <img src="images/member4.jpg" alt="Special Eve" title="Special Eve">
                  <div class="list-group">
                                        <div class="bordertitle">
                                              Local
                                        </div>
                                    <div class="well well-lg" style="min-height: 200px">
                                    The local level of YARDis where the most important work of the organization is done.
                                    This level receives the highest intensity of input and resourcing; is the most critical
                                    level for the aimed development outcomes and is monitored, supported and evaluated
                                    regularly to ensure the achievements of the desired results.
                                    </div><!-- /.well well-lg -->
                                </div><!-- /.list-group -->
                </div> <!-- /.sample-thumb -->

              </div> <!-- /.widget-item -->
            </div> <!-- /.col-md-4 -->
          </div> <!-- /.row second -->

        </div> <!-- /.container -->
      </div> <!-- /.middle-content -->



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

                <span>Copyright &copy; 2014 <a href="#">YARD</a> </span>

              </div>
            </div> <!-- /.col-md-4 -->
          </div> <!-- /.row -->
        </div> <!-- /.container -->
      </div>
      <!--Membership Modal -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="membershipModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h2 class="modal-title" id="myModalLabel">MEMBERSHIP REGISTRATION FORM</h2>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <form role="form" action='registration.php' method='POST' id='registrationform' >
                     <!-- <div class="alert alert-success" style="display: none;"></div> -->

                    <div class="form-group">
                      <label>Title</label>

                      <?php print $title;?>
                    </div>
                    <div class="form-group">
                      <label>Name:</label>
                      <input class="form-control validate_nonempty" name="name" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label>Surname:</label>
                      <input class="form-control validate_nonempty"  placeholder="Surname" name="surname" id="surname">
                    </div>
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control validate_nonempty" name="gender" id="gender">
                        <option value="">Select One</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Date of Birth:</label><br>
                      <!-- <input class="datepicker form-control validate_nonempty"   name="dob" id="dob" placeholder="Date of Birth" readonly> -->
                      <?php  print $date_select ;?>
                    </div>
                    <div class="form-group">
                      <label>Telephone:</label>
                      <input class="form-control validate_nonempty" placeholder="Telephone" name="telephone" id="telephone">
                    </div>
                    <div class="form-group">
                      <label>Cellphone:</label>
                      <input class="form-control validate_nonempty validate_duplicate_cellphone"  placeholder="Cellphone" name="cellphone" id="cellphone">
                    </div>
                    <div class="form-group">
                      <label>Email:</label>
                      <input class="form-control validate_nonempty validate_dublicate_email"  placeholder="email" name="email" id="email" >
                    </div>
                    <div class="form-group validate_nonempty">
                      <label>Province:</label>
                      <?php print $province;?>
                    </div>
                    <div class="form-group validate_nonempty">
                      <label>District:</label>
                      <div id='district'></div>
                    </div>
                    <div class="form-group validate_nonempty">
                      <label>Local Municipality:</label>
                      <div id='local'></div>
                    </div>


                    <div class="form-group">
                     <button type="submit" class="btn btn-primary">Submit</button>
                   </div>
                   <!-- div class="alert alert-success" style="display: none;"></div> -->
                 </form>
               </div>
             </div>
             <!-- Modal -->
             <!-- Button trigger modal -->
           </div>
           <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>


    </body>
    </html>

