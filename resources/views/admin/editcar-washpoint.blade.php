<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$id=$_GET['wpid'];
$wpname=$_POST['washingpointname'];
$wpaddress=$_POST['address'];	
$wpcnumber=$_POST['contactno'];

$sql="update  tblwashingpoints set washingPointName=:wpname,washingPointAddress=:wpaddress,contactNumber=:wpcnumber where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':wpname',$wpname,PDO::PARAM_STR);
$query->bindParam(':wpaddress',$wpaddress,PDO::PARAM_STR);
$query->bindParam(':wpcnumber',$wpcnumber,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

 echo "<script>alert('Car wash point updated successfully');</script>";
 echo "<script>window.location.href ='managecar-washingpoints.php'</script>";
}




	?>
<!DOCTYPE HTML>
<html>
<head>
<title>CWMS | Edit Washing Point</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="cssadmin/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="cssadmin/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="cssadmin/morris.css" type="text/css"/>
<link href="cssadmin/font-awesome.css" rel="stylesheet"> 
<script src="jsadmin/jquery-2.1.4.min.js"></script>
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
											<li> <a href="/change-password"><i class="fa fa-lock"></i> Setting</a> </li> 
											<li> <a href="/logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
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
                <li class="breadcrumb-item"><a href="/dashboard">Home</a><i class="fa fa-angle-right"></i>Edit Washing Point </li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
 
<!---->
  <div class="grid-form1">
  	       <h3>Edit Washing Point</h3>
<?php 
$id=$_GET['wpid'];
$sql = "SELECT * from tblwashingpoints where id='$id'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

foreach($results as $result)
{				?>	
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="washingpoint" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Car Wash Point Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="washingpointname" id="washingpointname" value="<?php echo htmlentities($result->washingPointName);?>" required>
									</div>
								</div>
<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Adress</label>
									<div class="col-sm-8">
										<textarea class="form-control" name="address" id="address" placeholder="Address" required rows="4"><?php echo htmlentities($result->washingPointAddress);?></textarea>
									</div>
								</div>

<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Contact Number</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="contactno" id="contactno" value="<?php echo htmlentities($result->contactNumber);?>" required>
									</div>
								</div>



	


														
	

								<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<button type="submit" name="submit" class="btn-primary btn">update</button>

			</div>
		</div>
						
					
						
						
						
					</div>
					
					</form>
<?php } ?>
     
      

      
      <div class="panel-footer">
		
	 </div>
    </form>
  </div>
 	</div>
 	<!--//grid-->

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