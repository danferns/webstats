<?php ini_set('display_errors', 1); error_reporting(E_ALL);
include 'settings.php';
$stats = json_decode(file_get_contents($statFilePath), true);
for ($i=0; $i < count($stats); $i++) {
    if (!isset($stats[$i]["ip_legit"])){
        $viewData = array('time'=>$stats[$i]["time"], 'page'=>$stats[$i]["page"]);
        if (isset($stats[$i]["referer"])){
            $referer = strtok($_SERVER['HTTP_REFERER'], '?');
            $viewData = array_merge($viewData, array('referer'=>$referer));
        }
        $ip = $stats[$i]["ip"];
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
        $stats[$i] = $viewData;
    }
}
file_put_contents($statFilePath, json_encode($stats));
?>