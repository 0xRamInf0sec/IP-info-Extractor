<html>
<head>
<title>Ip Details Collector</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
.jumbotron {
 background-color:transparent;
  margin: 5px auto;
  height:500px;
  justify-content: center;
padding:0;
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
input[type=submit] {
  background-color:#f4253e;
  color: white;
  position: 10px 100 px;
  padding: 6px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: center;
}
.text-line {
    background-color: transparent;
    color:solid #000000;
    outline: none;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid #000000 1px;
    padding: 3px 10px;
}
.text-line:focus
{
	    background-color: transparent;
}
</style>
<body >
<div class="jumbotron bg-cover" style="width:50%;">
<div style='background-color:#436cee;padding:30px;text-align:center'>
  <h3 style='color:white'>IP Info Extractor</h3>
  <h5 style="float:right;color:white">by Ramalingasamy M K</h5>
  </div>
  <br>
<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<div class="form-group">
<label for="Consumer_number :"><b>Enter IpV4 or IpV6</b></label>
<input type="text" name="ip" placeholder="Enter IpV4 or IpV6" class="text-line" required="">
</div>
<div class="form-group">
<input type="submit" name="form" value="Check IP" >
</div>
</form>
<div>
<?php
			 if ($_SERVER["REQUEST_METHOD"] == "POST") {

               $ip= test_input($_POST["ip"]);
			  
            }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		 if(isset($_POST['form']))
		 {
			 $url="http://ip-api.com/php/".$ip;
			 $urldata=file_get_contents($url);
			 $data=unserialize($urldata);
			 $stat=$data['status'];
			 if($stat=='success')
			 {
			 $country=$data['country'];
			 $ccode=$data['countryCode'];
			 $region=$data['region'];
			 $regionname=$data['regionName'];
			 $city=$data['city'];
			 $zip=$data['zip'];
			 $lat=$data['lat'];
			 $long=$data['lon'];
			 $link="http://www.google.com/maps/place/".$lat.",".$long."/@".$lat.",".$long.",17z/data=!3m1!1e3";
			 $time=$data['timezone'];
			 $isp=$data['isp'];
			 
			 echo "<b>Status : </b><p style='color:green'>".$stat."</p>";
			 echo "<b>Country : </b>".$country."<br>";
			 echo "<b>Country Code : </b>".$ccode."<br>";
			 echo "<b>Region : </b>".$region."<br>";
			 echo "<b>Region Name : </b>".$regionname."<br>";
			 echo "<b>City : </b>".$city."<br>";
			 echo "<b>Zip Code : </b>".$zip."<br>";
			 echo "<b>Latitude : </b>".$lat."<br>";
			 echo "<b>Longtitude : </b>".$long."<br>";
			 echo "<b>Time Zone : </b>".$time."<br>";
			 echo "<b>ISP : </b>".$isp."<br>";
			echo "<a href=".$link." target='_blank'><b>Click Here To see in Google Maps</b></a>";
			 }
			 if($stat=='fail')
			 {
				 $message=$data['message'];
				 echo "<b>Status : </b><p style='color:red'>".$stat."</p>";
				 echo "<b>Message : </b><p style='color:red'>".$message;
			 }
			 
		 }

?>
</div>
</body>
</html>