<?php //ini_set('display_errors', 1); error_reporting(E_ALL);
include 'settings.php';

if (isset($_GET[$notrack])){
    exit();
}

//collect data
$time = time();
$page = strtok($_SERVER['REQUEST_URI'], '?');
$viewData = array('time'=>$time, 'page'=>$page);

if (isset($_SERVER['HTTP_REFERER'])){
    $referer = strtok($_SERVER['HTTP_REFERER'], '?');
    $viewData = array_merge($viewData, array('referer'=>$referer));
}

$ip = $_SERVER['REMOTE_ADDR'];
$ip_data = json_decode(file_get_contents('https://api.iplegit.com/full?ip='.$ip), true);

if ($ip_data == null or isset($ip_data["msg"])){
    $viewData = array_merge($viewData, array('ip'=>$ip));
} else {
    $ip_type = $ip_data["type"];
    if ($ip_data["bad"] == false){
        $ip_legit = "good";
    } else {
        $ip_legit = "bad";
    }
    $country = $ip_data["countryCode"];
    $viewData = array_merge($viewData, array('ip_legit'=>$ip_legit, 'type'=>$ip_type, 'country'=>$country));
}

#save data
$stats = array();

if (filesize($statFilePath) != 0){
    $stats = json_decode(file_get_contents($statFilePath), true);
}

$stats[count($stats)] = $viewData;

$statFile = fopen($statFilePath,'w+');

fwrite($statFile, json_encode($stats));
fclose($statFile);
?>