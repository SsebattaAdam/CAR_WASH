<?php
session_start();
error_reporting(0);

// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','cwmsdb');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 






	?>
<!DOCTYPE HTML>
<html>
<head>
<title>CWMS | All Bookings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="cssadmin/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="cssadmin/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="cssadmin/morris.css" type="text/css"/>
<link href="cssadmin/font-awesome.css" rel="stylesheet"> 
<script src="jsadmin/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="cssadmin/table-style.css" />
<link rel="stylesheet" type="text/css" href="cssadmin/basictable.css" />
<script type="text/javascript" src="jsadmin/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="cssadmin/icon-font.min.css" type='text/css' />
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
            <!--header start here-->
			<div class="header-main">
					<div class="logo-w3-agile">
								<h1><a href="/dashboard">Car Wash Management System</a></h1>
							</div>
				
						
						<div class="profile_details w3l">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="imagesadmin/User-icon.png" alt=""> </span> 
												<div class="user-name">
													<p>Welcome</p>
													<span>Administrator</span>
												</div>
												<i class="fa fa-angle-down"></i>
												<i class="fa fa-angle-up"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="change-password.php"><i class="fa fa-lock"></i> Setting</a> </li> 
											<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							
				     <div class="clearfix"> </div>	
				</div>
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a><i class="fa fa-angle-right"></i>Manage All Bookings</li>
            </ol>
<div class="agile-grids">	
				<!-- tables -->

				<div class="agile-tables">
					<div class="w3l-table-info">
					  <h2>All Bookings</h2>
					    <table id="table">
						<thead>
						  <tr>
						  <th>Booking No.</th>
							<th>Name</th>
							<th width="200">Pacakge Type</th>
							<th>Washing Point </th>
							<th>Washing Date/Time </th>
							<th width="200">Posting date </th>
							<th>Action </th>
							
						  </tr>
						</thead>
						<tbody>
<?php $sql = "SELECT *,tblcarwashbooking.id as bid from tblcarwashbooking, contacttb
join tblwashingpoints on tblwashingpoints.id=tblcarwashbooking.carWashPoint";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>		
						  <tr>
							<td><?php echo htmlentities($result->bookingId);?></td>
							<td><?php echo htmlentities($result->fullName);?></td>
								<td width="50">
								<?php $ptype=$result->packageType;
if($ptype==1): echo "BASIC CLEANING ($10.99)";endif;
if($ptype==2): echo "PREMIUM CLEANING ($20.99)";endif;
if($ptype==3): echo "COMPLEX CLEANING ($30.99)";endif;


							?></td>
							
						
							<td><?php echo htmlentities($result->washingPointName	);?><br />
								<?php echo htmlentities($result->washingPointAddress);?></td>
							<td><?php echo htmlentities($result->washDate."/".$result->washTime);?></td>
							
								<td><?php echo htmlentities($result->postingDate);?></td>
				

<td><a href="booking-details.php?bid=<?php echo htmlentities($result->bid);?>&&bookingid=<?php echo htmlentities($result->bookingId);?>">View</a>
</td>
<?php } ?>
</tr>
						 <?php } else { ?>
						 	<tr>
						 		<td colspan="6" style="color:red;">No Record found</td>

						 	</tr>
						 <?php } ?>
						</tbody>
					  </table>
					</div>
				  </table>

				
			</div>
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© <?php echo date('Y');?> CWMS. All Rights Reserved |  <a href="#">CWMS</a> </p>
</div>	

<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
		<!-- side bar starts here -->
		<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
									<ul id="menu" >
										<li><a href="/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>
										
									 <li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Washing Points</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="/addcar-washpoint">Add</a></li>
											<li id="menu-academico-avaliacoes" ><a href="/managecar-washingpoints">Manage</a></li>
										  </ul>
										</li>

	<li><a href="/add-booking"><i class="fa fa-user" aria-hidden="true"></i>  <span>Add Car Wash Booking</span><div class="clearfix"></div></a></li>


		 <li id="menu-academico" ><a href="#"><i class="fa fa-files-o" aria-hidden="true"></i><span>Car Washing Booking</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="/new-booking">New</a></li>
											<li id="menu-academico-avaliacoes" ><a href="/completed-booking">Completed</a></li>
												<li id="menu-academico-avaliacoes" ><a href="/all-bookings">All</a></li>
										  </ul>
										</li>
									
								
						
									<li><a href="/manage-enquires"><i class="fa fa-file-text-o" aria-hidden="true"></i>  <span>Manage Enquiries</span><div class="clearfix"></div></a></li>
		 <li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Pages</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
										   <ul id="menu-academico-sub" >
										   <li id="menu-academico-avaliacoes" ><a href="/about">About</a></li>
											<li id="menu-academico-avaliacoes" ><a href="/contact2">Contact</a></li>
										  </ul>
										</li>
							     
									
								  </ul>
								</div>
							  </div>
					<!-- 	side bar ends here -->
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="jsadmin/jquery.nicescroll.js"></script>
<script src="jsadmin/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="jsadmin/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>