<?php
header("Access-Control-Allow-Origin: *");
include "ip.php";
// if($re == 1) die('failed');


function generateRandomID() {
    $characters = '0123456789';
    $id = '';
    for ($i = 0; $i < 5; $i++) {
        $id .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $id;
}

// Generate a unique ID for the order
do {
    $id = generateRandomID();
    $file_path = 'orders/' . $id . '.txt';
} while (file_exists($file_path));

// Retrieve form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$time = $_POST['time'];
$sandwich = $_POST['sandwich'];
$cola = $_POST['cola'];
$green = $_POST['green'];
$lemon = $_POST['lemon'];
$tls = $_POST['tls'];
$bul = $_POST['bul'];
$sp = $_POST['sp'];
// Set A
$sa = $_POST['sa']; 
$sacola = $_POST['sacola'];
$sagreen = $_POST['sagreen'];
$salemon = $_POST['salemon'];
$sasp = $_POST['sasp'];


// Set B
$sb = $_POST['sb']; 
$sbcola = $_POST['sbcola'];
$sbgreen = $_POST['sbgreen']; 
$sblemon = $_POST['sblemon'];
$sbbul = $_POST['sbbul'];
$sbtls = $_POST['sbtls'];
$sbsp = $_POST['sbsp'];


// Set C
$sc = $_POST['sc']; 
$scsp = $_POST['scsp'];
$sccola = $_POST['sccola'];
$scgreen = $_POST['scgreen']; 
$sclemon = $_POST['sclemon'];
$scbul = $_POST['scbul'];
$sctls = $_POST['sctls'];

if ($name == '' || $phone == '') {
    echo 'Invalid input';
    return;
}

$total_cola = $cola + $sacola + $sbcola + $sccola;
$total_sandwich = $sandwich + $sa + $sc;
$total_bul = $bul + $sbbul + $scbul;
$total_tls = $tls + $sbtls * 2 + $sctls * 2;
$total_green = $green + $sagreen + $sbgreen + $scgreen;
$total_lemon = $lemon + $salemon + $sblemon + $sclemon;  
$total_sp = $sp + $sasp + $sbsp + $scsp ;


$money = $sa * 80 + $sb * 80 + $sc * 120 + $sandwich * 50 + 
         intdiv($tls, 2)* 50 + ($tls%2)*30 + $bul * 50 + ($cola + $green + $lemon + $sp) * 40;

// Create order string
$order = "$name, $phone, $time, $total_sandwich, $total_cola, $total_green, $total_lemon, $total_sp, $total_tls, $total_bul, $sa, $sb, $sc, $money";

// Save order to file
$file = fopen($file_path, 'w') or die("failed");
if ($file) {
    fwrite($file, $order);
    fclose($file);
    chmod($file_path, 0777);
    echo $id; // Return the ID
} else {
    die("failed");
}
?>
