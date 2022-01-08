<?php 
/*
Celsius to Fahrenheit    ° F = 9/5 ( ° C) + 32
        example: 20 degrees Cel = 68 degrees Far
            20 * 1.8 (or 9/5) = 36 + 32 = 68

Fahrenheit to Celsius    ° C = 5/9 (° F - 32)
        example: 90 degrees Far = 32.2 degrees Cel
            (90 - 32 = 58) .5556 * 58 = 32.2

Kelvin to Fahrenheit    ° F = 9/5 (K - 273) + 32
        example: 60 degrees Kel = -351.4 degrees Far
            (60 - 273 = -213) * 1.8 = -384.4 + 32 = -351.4

Fahrenheit to Kelvin    K = 5/9 (° F - 32) + 273
        example: 40 degrees Far = 277.448 degrees Kel
            .5556 (40 - 32 = 8) 4.4448 + 273 = 277.448

Celsius to Kelvin        K = ° C + 273
        example: 32 degrees Cel = 305 degrees Kel
            32 + 273 = 305

Kelvin to Celsius        ° C = K - 273
        example: 500 degrees Kel = 227 degrees Cel
            500 - 273 = 227
*/
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" >
<link href="css/styles.css" type="text/css" rel="stylesheet">
<title>Temp Conversion Calculator</title>
</head>

<body>
<div class="wrapper">
<h1>Temp Converter yay!</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<fieldset>
<label for="temp">Enter The Temperature You Wish to Convert</label>
<input for="temp" name="temp" id="temp">

<label for="unit_1">Converting From</label>
<ul>
<li><input type="radio" name="unit_1" value="far">Fahrenheit</li>
<li><input type="radio" name="unit_1" value="cel">Celsius</li>
<li><input type="radio" name="unit_1" value="kel">Kelvin</li>
</ul>

<label for="unit_2">Converting To</label>
<ul>
<li><input type="radio" name="unit_2" value="far">Fahrenheit</li>
<li><input type="radio" name="unit_2" value="cel">Celsius</li>
<li><input type="radio" name="unit_2" value="kel">Kelvin</li>
</ul>

<input id="submit" type="submit" value="Convert">
</fieldset>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {

if($_POST['unit_1'] == NULL) {
    echo '<span class="error">Please select your unit of measurement!</span>';
}
    
if($_POST['unit_2'] == NULL) {
    echo '<span class="error">What are we converting to?</span>';
}

if(empty($_POST['temp'])) {
    echo '<span class="error">Please fill out your temp!</span>';
}

if(isset(
    $_POST['unit_1'],
    $_POST['unit_2'],
    $_POST['temp']
)) {
    $unit_1 = $_POST['unit_1'];
    $unit_2 = $_POST['unit_2'];
    $temp = intval($_POST['temp']); 
}

if($unit_1 == 'far' && $unit_2 == 'cel') { // Fahrenheit to Celsius    ° C = 5/9 (° F - 32)
    $converted_temp = 5/9 * ($temp - 32);
}

if($unit_1 == 'cel' && $unit_2 == 'far') { // Celsius to Fahrenheit    ° F = 9/5 ( ° C) + 32
    $converted_temp = 9/5 * $temp + 32;
}

if($unit_1 == 'kel' && $unit_2 == 'far') { // Kelvin to Fahrenheit    ° F = 9/5 (K - 273) + 32
    $converted_temp = 9/5 * ($temp - 273) + 32;
}

if($unit_1 == 'far' && $unit_2 == 'kel') { // Fahrenheit to Kelvin    K = 5/9 (° F - 32) + 273
    $converted_temp = 5/9 * ($temp - 32) + 273;
}

if($unit_1 == 'kel' && $unit_2 == 'cel') { // Kelvin to Celsius     ° C = K - 273
    $converted_temp = $temp - 273;
}

if($unit_1 == 'cel' && $unit_2 == 'kel') { // Celsius to Kelvin     K = ° C + 273
    $converted_temp = $temp + 273;
} 
    echo '
    <div class="result">
    <h2>Converted Temp</h2>
    <p>'.$temp.' degrees '.$unit_1.' is equal to '.number_format($converted_temp, 2).' degrees '.$unit_2.'. Good Day!</p>
        </div>';

// if two of the same units are selected
if(isset($_POST['unit_1']) && $_POST['unit_1'] === $_POST['unit_2']) {
    echo '<p>Please Select Two Different Units!</p>';
    }

} // SERVER REQUEST
?>

</div> <!--CLOSE WRAPPER--->
</body>
</html>
