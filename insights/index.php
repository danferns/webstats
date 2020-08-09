<?php
include '../maintenance.php';
$stats = file_get_contents("../stats.json");
$insightsPage = file_get_contents("./insights.html");

echo str_replace("statsjsondata", $stats, $insightsPage);
?>