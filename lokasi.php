<?php
    $json = file_get_contents('http://api.weatherapi.com/v1/current.json?key=e21884c678314b28a9c34220221603&q=Malang&aqi=no');
    $obj = var_dump(json_decode($json));
    echo $obj;
    
?>