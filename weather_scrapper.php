<?php
	$weather ="";
	$error = "";
	if($_GET)
	{
		$city = $_GET["city"];
		$city = str_replace(" ", "", $city);
		$url = "https://www.weather-forecast.com/locations/".$city."/forecasts/latest";
		$file_header = @get_headers(($url));
		$isExist = true;
		if($file_header[0]=="HTTP/1.0 404 Not Found"){
			$isExist=false;
			$error.="City not found!!";
		}
		if($isExist){
			$forecastpage = file_get_contents($url);
			$pageArray   = 	explode('</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastpage);
			$maindata = explode('</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9">', $pageArray[1]);
			$weather = $maindata[0];
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Weather</title>
	<style type="text/css">
		#main{
			position: relative;
			margin-top:10%;
			margin-left: 45%;
		}
		h1{
			font-size: 300%;
		}
		#city{
			width: 400px;
			border-radius: 10px;
			margin-left: 10px;
			margin-bottom: 10px;
			height: 30px;
		}
		#submit{
			position: relative;
			height: 40px;
			width: 100px;
			left: 27%;
			border-radius: 10px;
			background-color: lightgreen;
			margin-bottom: 10px;
		}
		html { 
		  background: url(background.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		  width: 1024px;
		}
		.weather{
			background-color: green;
			color: white;
			width: 370px;
			padding: 10px;
			margin-left: 15px;
			align-content: center;
		}
		#error{
			background-color: #CB3F21;
		}
	</style>
</head>
<body>
	<div id="main">
		<h1>What's the weather?</h1>
		<form >
			<input type="text" name="city" id="city" placeholder="Enter city name">
			<br>
			<input type="submit" value="Submit" id="submit">
		</form>
		<?php
			if($weather!="")
			{
				echo '<div class="weather">'.$weather.'</div>';
			}
			else
			{
				if($error!="")
				{
					echo '<div class="weather" id = "error">'.$error.'</div>';
				}
			}
			?>
	</div>
	
</body>
</html>