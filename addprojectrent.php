<?php
    include('indexDB.php');
    session_start();
    $loc=$city=$desc=$am=$ar=$i=$i1=$i2=$i3=$rent=$dep=$time='';
    $locErr=$cityErr=$descErr=$amErr=$arErr=$iErr=$rentErr=$depErr=$timeErr='';
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$b=true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["loc"])) {
        $locErr = "*Location is required";
        $b=false;
      } else {
        $loc = test_input($_POST["loc"]);
         if (!preg_match("/^[a-zA-Z_ ]*$/",$loc) || $loc=='') {
          $locErr = "*Only letters allowed";
          $b=false; 
        }
      }
      if (empty($_POST["city"])) {
        $cityErr = "*City is required";
        $b=false;
      } else {
        $city = test_input($_POST["city"]);
         if (!preg_match("/^[a-zA-Z]*$/",$city) || $city=='') {
          $cityErr = "*Only letters allowed";
          $b=false; 
        }
      }
      if (empty($_POST["desc"])) {
        $descErr = "*Description is required";
        $b=false;
      } else {
        $desc = test_input($_POST["desc"]);
      }
      if (empty($_POST["amen"])) {
        $amErr = "*Amenities is required";
        $b=false;
      } else {
        $am = test_input($_POST["amen"]);
      }
      if (empty($_POST["img1"])) {
        $iErr = "*Image is required";
        $b=false;
      } else {
        $i = test_input($_POST["img1"]);
        $i1= test_input($_POST["img2"]);
        $i2= test_input($_POST["img3"]);
        $i3= test_input($_POST["img4"]);
      }
  if (empty($_POST["area"])) {
    $arErr = "*Area is required";
    $b=false;
  } else {
    $ar = test_input($_POST["area"]);
    if(!preg_match("/^[0-9]{2,10}$/",$ar) || $ar==''){
    	$arErr = "*Enter only Numbers";
    	$b=false;
    }
  }
  if (empty($_POST["rent"])) {
    $rentErr = "*Rent is required";
    $b=false;
  } else {
    $rent = test_input($_POST["rent"]);
    if(!preg_match("/^[0-9]{2,10}$/",$rent) || $rent==''){
    	$rentErr = "*Enter only Numbers";
    	$b=false;
    }
  }
  if (empty($_POST["dep"])) {
    $depErr = "*Deposit is required";
    $b=false;
  } else {
    $dep = test_input($_POST["dep"]);
    if(!preg_match("/^[0-9]{2,10}$/",$dep) || $dep==''){
    	$depErr = "*Enter only Numbers";
    	$b=false;
    }
  }
  if (empty($_POST["time"])) {
    $timeErr = "*Time is required";
    $b=false;
  } else {
    $time = test_input($_POST["time"]);
    if(!preg_match("/^[0-9]{1,3}$/",$time) || $time==''){
    	$timeErr = "*Enter only Numbers";
    	$b=false;
    }
  }
}
if($b==true && isset($_POST['submit']))
{
    $id='uid';
    $q1="insert into flat(location,$id,city,description,amenities,area,image,image1,image2,image3) values('$loc',".$_SESSION['id'].",'$city','$desc','$am',$ar,'$i','$i1','$i2','$i3')";
    echo $q1;
    $x=$conn->query($q1);
    $q4="select flat_id from flat where location='$loc' and city='$city' and area=$ar and amenities='$am'";
    $r4=$conn->query($q4);
    $y=mysqli_fetch_array($r4, MYSQLI_ASSOC);
    $test1=$y['flat_id'];
    echo "flat id fetched is ".$test1;
    $q5="insert into rent(flat_id,rent_amount,deposit_amount,time_period) values($test1,$rent,$dep,$time)";
    $result5 = $conn->query($q5);
    echo "Rent inserted";
    header('Location: normalHomeRent.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ulzhavar-Koodam</title>
	<meta charset="UTF-8">
	<meta name="description" content="HOUSING-CO">
	<meta name="keywords" content="HOUSING-CO, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
                    <div class="col-10">
                    </div>
					<div class="col-2">
					<?php echo $_SESSION['username']."  ";?><a href="logout.php"><i class="fa fa-user-circle-o"></i>Logout</a>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="site-navbar">
						<a href="index.html" class="site-logo"><img src="img/logo1.png" alt=""></a>
						<div class="nav-switch">
							<i class="fa fa-bars"></i>
						</div>
						<ul class="main-menu">
						   <?php
							    if($_SESSION['type']=='builder')
                            {
                                echo "<li><a href='builderHome.php'>Home</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='normalHomeSale.php'>Home</a></li>";
                            }
                            ?>
							<?php 
							if($_SESSION['type']=='normal')
							{
								echo "<li><a href='normalHomeSale.php'>View property</a></li>";
							}
							else
							{
								echo "<li><a href='builderHome.php'>View property</a></li>";
							}
							?>
				
							 <li><a href="normalHomeSale.php">Need Today</a></li>
                            <li><a href="normalHomeRent.php">Need Daily</a></li>
							<li><a href="upcomingprojects.php">UPCOMING Needs</a></li>			
							<li><a href="PackersAndMovers.php">Packers And Movers</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->
	<section class="hero-section set-bg" data-setbg="img/bg.jpg">
		<div class="container hero-text text-white">
			<h2>List your building on our website.</h2>
		</div>
	</section>
	<br><br><br>
    <!-- Properties section end -->
    <style type="text/css">
body{
background-repeat:no-repeat;
background-image:url("img/service-bg.jpg");
background-size:cover;
background-attachment:fixed;
color:white;
}
input[type=text],input[type=date],input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    background-color: #e0e0d1;
    color:black;
}

 input[type=submit], input[type=reset] {
    background-color: #e0e0d1;
    border: none;
    color: black;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    font-weight:bold;
}
input[type=radio] {
    height: 15px;
    width: 15px;
    
}



select {
	 background-color: #e0e0d1;
    border: none;
    color: black;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    font-weight:bold;
}
textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    background-color:#e0e0d1;
    color:black;
}
table{
 background-color:black;
  border-collapse: collapse; 
  border: 2px solid navy;
}
form{
opacity:0.7;
}
td{
font-weight:bold;
}
span
{
   color:red;
}

</style>
</head>




<form id="form" method="post" action="addprojectrent.php" >

<table cellpadding="7" width="50%" border="0" align="center"cellspacing="2" color="white">

    <!-- I want another button here, center to the tile-->



<tr>
<td colspan=2>
<center><img src="img/logo1.png"></img></center>
</td>
</tr>
<tr>
<td colspan=2>
<center><font size=5><b>ADD PRODUCTS</b></font></center>
</td>
</tr>
<tr>
<td><b>Location:</b></td>
<td><input type="text" name="loc" size="30">
<span class="error"><?php echo $locErr; ?></span>
<br><br>
</td>
</tr>
<tr>
<td><b>City:</b></td>
<td><input type="text" name="city" size="30">
<span class="error"><?php echo $cityErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Description:</b></td>
<td><input type="text" name="desc" size="30">
<span class="error"><?php echo $descErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Size:</b></td>
<td><input type="text" name="amen" size="30">
<span class="error"><?php echo $amErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Area:</b></td>
<td><input type="text" name="area" size="30">
<span class="error"><?php echo $arErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Image1 URL:</b></td>
<td><input type="text" name="img1" size="30">
<span class="error"><?php echo $iErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><b>Image2 URL:</b></td>
<td><input type="text" name="img2" size="30">
  <br><br>
</td>
</tr>
<tr>
<td><b>Image3 URL:</b></td>
<td><input type="text" name="img3" size="30">
  <br><br>
</td>
</tr>
<tr>
<td><b>Image4 URL:</b></td>
<td><input type="text" name="img4" size="30">
  <br><br>
</td>
</tr>
<tr>
<tr>
<td><b>Basic Amount:</b></td>
<td><input type="text" name="rent"size="30">
<span class="error"><?php echo $rentErr; ?></span>
  <br><br>
</td>
</tr>

<tr>
<td><b>Final Amount:</b></td>
<td><input type="text" name="dep" size="30">
<span class="error"><?php echo $depErr; ?></span>
  <br><br>
</td>
</tr>

<tr>
<td><b>harvest period:</b></td>
<td><input type="text" name="time" size="30">
<span class="error"><?php echo $timeErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><input type="reset" value="Reset"></td>
<td><input type="submit" value="Submit" name="submit">

<div style = "font-size:20px; color:#cc0000; margin-top:10px"></div>
</td>
</tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
</form>
	<!-- Clients section -->
	<div class="clients-section">
		<div class="container">
			<div class="clients-slider owl-carousel">
				<a href="#">
					<img src="img/partner/1.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/2.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/3.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/4.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/5.png" alt="">
				</a>
			</div>
		</div>
	</div>
	<!-- Clients section end -->



	<!-- Footer section -->
		<footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 footer-widget">
					<img src="img/logo1.png" alt="">
					<p>We provide you with the best services which is best for your family.</p>
					<div class="social">
						
						<a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
							<a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
							<a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
							<a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
							
					</div>
				</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="contact-widget">
						<h5 class="fw-title">CONTACT US</h5>
						<p><i class="fa fa-map-marker"></i>You can contact us here......  </p>
						<p><i class="fa fa-phone"></i>Number</p>
						<p><i class="fa fa-envelope"></i>info.Ulzhavar-Koodam@gmail.com</p>
						<p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="double-menu-widget">
						<h5 class="fw-title">POPULAR PLACES</h5>
						<ul>
							<li><a href="">Madurai</a></li>
							<li><a href="">Theni</a></li>
							<li><a href="">Chennai</a></li>
							<li><a href="">Karaikal</a></li>
							<li><a href="">Virudhunagar</a></li>
						</ul>
						
					</div>
				</div>
				<div class="col-lg-3 col-md-6  footer-widget">
					<div class="newslatter-widget">
						<h5 class="fw-title">NEWSLETTER</h5>
						<p>Subscribe your email to get the latest news.</p>
						<form class="footer-newslatter-form">
							<input type="text" placeholder="Email address">
							<button><i class="fa fa-send"></i></button>
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</footer>

	<!-- Footer section end -->
                                        
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>