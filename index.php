<?php
include 'maintenance.php';
$stats = file_get_contents("./stats.json");
$detailsPage = file_get_contents("./details.html");

echo str_replace("statsjsondata", $stats, $detailsPage);
?>