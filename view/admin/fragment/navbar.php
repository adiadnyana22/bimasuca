<?php

require_once "geoplugin.php";
include '../../koneksi.php';
$geoplugin = new geoPlugin();
$geoplugin->locate();
// $lokasi = $geoplugin->city;
$lokasi = 'Malang';
// Weather API Key
$key = $_ENV['WEATHER_API_KEY'];

$link = "http://api.weatherapi.com/v1/current.json?key=$key&q={$lokasi}&aqi=no";
$suhu = file_get_contents($link);
$cek_suhu = json_decode($suhu);
$nilai_suhu = $cek_suhu->current->feelslike_c;
$teks = $cek_suhu->current->condition->text;
$icon = $cek_suhu->current->condition->icon;

?>

<div class="navbar">
    <div class="user-data">
        <span>Hi, <strong><?php echo $_SESSION['nama'];?></strong></span>
        <button id="openSidebar"><i class="fas fa-bars"></i></button>
    </div>
    <div class="weather-data">
        <div>
            <span><strong ><?php echo $lokasi;?></strong> (<span><?php echo $nilai_suhu;?>&#8451;</span>)</span>
            <span>
                <span><?php echo $teks; ?></span>
            </span>
        </div>
        <img src="<?php echo $icon; ?>"></img>
    </div>
</div>