<?php

$host = "127.0.0.1:3307";
$user = "root";
$pass = "root";
$db = "galaxy";

/* Connect to database */
$link = mysqli_connect($host, $user, $pass, $db);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$data = $_POST['sendData'];
$order_id = $data['id'];
$output = '';

$sql = "UPDATE orders SET is_active = 0 WHERE id = '" .$order_id. "';";
if ($link->query($sql) === TRUE) {
    echo "Updated! ";
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

echo $output;
