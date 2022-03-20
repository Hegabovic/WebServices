<?php
//snippits in phpstorm
/*highlight_string('<?php ' . var_export($JSONresponse, true) . ';?>');*/
require("autoload.php");

$cities = new Weather();
$citiesName = $cities->get_cities();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="static/css/style.css">
</head>
<body>
<header class="header-handle">
    <h1>Weather API</h1>
    <h3>All cities in Egypt</h3>
</header>
<section class="body-handle">
    <form action="" method="post" class="formStyle dimensions">
        <p>Choose city:</p>
        <select name="listOfCities">
            <option>-- choose city --</option>
            <?php
            foreach ($citiesName as $city) {
                echo "<option name='xCity'>" . $city["name"] . "</option>";
            }
            ?>
        </select>
        <input class="btn" type="submit" name="getWeather" value="Get Weather">
    </form>
    <div class="dimensions output">
        <?php
        if (isset($_POST["getWeather"]) && isset($_POST["listOfCities"]) && !empty($_POST["listOfCities"]) ) {
            $cities->formTable();
        }
        ?>
    </div>
</section>
</body>
</html>
