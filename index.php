<?php
$apiKey = "d3b0c10ec020bff847cd23828a8e8805";
//$cityId = "524901";


    if(isset($_POST['formSubmit'])) 
    {
        $aCountries = $_POST['formCountries'];
        
        if(!isset($aCountries)) 
        {
            echo("<p>You didn't select any cities!</p>\n");
        } 
        else 
        {
            $nCountries = count($aCountries);
            
           
            for($i=0; $i < $nCountries; $i++)
            {
                
                
                $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $aCountries[$i] . "&lang=en&units=metric&APPID=" . $apiKey;

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                curl_close($ch);
                $data = json_decode($response);

                $currentTime = time();
            }
            echo("</p>");
        }
    }else{
         $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=6619279&lang=en&units=metric&APPID=" . $apiKey;
            $ch = curl_init();

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                curl_close($ch);
                $data = json_decode($response);

                $currentTime = time();
    }

?>

<!doctype html>
<html>
<head>
<title>Forecast Weather using OpenWeatherMap with PHP</title>

<link href="style.css" type="text/css" rel="stylesheet" />

</head>
<body>

    <div class="report-container">

        <h2><span class="city"><?php echo $data->name; ?></span> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max; ?>&deg;C<span
                class="min-temperature">~ <?php echo $data->main->temp_min; ?>&deg;C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
    <form class="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <label for='formCountries[]'>Select the city weather:</label><br>
    <select multiple="multiple" name="formCountries[]">
        <option value="6619279">sydney</option>
        <option value="7839805">Melbourne</option>
        <option value="2171507">Wollongong</option>
    
    </select><br>


    <input type="submit" name="formSubmit" value="Submit" class="btn" >




</form>


</body>
</html>