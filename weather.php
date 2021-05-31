<?php
	// define API_KEY constant to store your API Key
	// please get your API Key by registering yours at: 
	// https://developers.accuweather.com/
	define('API_KEY','2sGJAGzWeDLBhoi0FEU7mGDsC2v92NBG');
	// If the API Key doesn't work because it has reach its limit of 50 requests,
	// Delete the old key and create a new one.

	$apikey = API_KEY;

	// Use this when testing in localhost
	// $user_ip = '123.16.195.21';

	// Use this when you public your web site
	$user_ip = '27.76.176.235';

	$location = json_decode(file_get_contents("http://dataservice.accuweather.com/locations/v1/cities/ipaddress?apikey={$apikey}&q={$user_ip}"), true);

	$loc_key = $location['Key'];
	
	$weather = json_decode(file_get_contents("http://dataservice.accuweather.com/currentconditions/v1/{$loc_key}?apikey={$apikey}"), true);

	//print_r($location);
	//echo "<hr>";
	//print_r($weather);
	//echo "<hr>";

	$city = $location['EnglishName'];
	$country = $location['Country']['EnglishName'];
	$dt = $weather[0]['LocalObservationDateTime'];
	$temp = $weather[0]['Temperature']['Metric']['Value'];
	$img = $weather[0]['WeatherIcon'];
		if($img<10) {
			$img = "0{$img}";
		}

	echo '<p><br />Welcome, guest!</p><p>';
	echo $city . ', ' . $country . "<br />";
	echo substr($dt,0,10) . " " . substr($dt,11,8);
	echo "</p><p>Temperature: {$temp} C<br />";
	echo "<img src='https://developer.accuweather.com/sites/default/files/{$img}-s.png'>";


?>