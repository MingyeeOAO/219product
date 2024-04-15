<?php

function mark($ip,$c) {
    $f = fopen('ip.log','a');
    fwrite($f,$ip . ' ' . time() . ' ' . $c . PHP_EOL);
    return;
}

$clientIP = $_SERVER['REMOTE_ADDR'];


$logFile = 'order_logs.txt';

$currentTime = time();

$logData = [];
if (file_exists($logFile)) {
    $logData = json_decode(file_get_contents($logFile), true);
}

// foreach ($logData as $ip => $timestamp) {
//     if ($currentTime - $timestamp > 15) {
//         unset($logData[$ip]);
//     }
// }

if(isset($logData[$clientIP])) {
    if($currentTime - $logData[$clientIP] > 30) {
        unset($logData[$clientIP]);
    }
}

$re = 0;
if (array_key_exists($clientIP, $logData)) {
    $re = 1;
    mark($clientIP,'DENY');
    die('failed');
    //die("IP restriction exceeded");
}
$logData[$clientIP] = $currentTime;


mark($clientIP,'ALLOW');
$f = fopen($logFile,'w');
fwrite($f,json_encode($logData));

// echo 1;
return;
?>
