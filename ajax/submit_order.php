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

$staff_id = $data['staff_id'];
$table_id = $data['table_id'];
$tablet_id = $data['tablet_id'];
$foodanddrink_id = $data['foodanddrink_id'];
$output = '';

$sql = "INSERT INTO orders (staff_id, table_id, tablet_id, food_id) VALUES ($staff_id, $table_id, $tablet_id, $foodanddrink_id)";

if ($link->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

echo $output;
