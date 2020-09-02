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

$sql = "SELECT o.id as id, s.name as staffname, t.name as tablename, ts.name as tablet, f.name as foodname, f.type as foodtype, f.price as price FROM orders o
    LEFT JOIN staffs s ON o.staff_id = s.id
    LEFT JOIN foods f ON o.food_id = f.id
    LEFT JOIN tables t ON o.table_id = t.id
    LEFT JOIN tablets ts ON o.tablet_id = ts.id
    WHERE is_active = 1";

$output = '';

if($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $output .= "<tr>";
        $output .= "<th>ID</th>";
        $output .= "<th>Staff</th>";
        $output .= "<th>Table</th>";
        $output .= "<th>Tablet</th>";
        $output .= "<th>Food</th>";
        $output .= "<th>Food type</th>";
        $output .= "<th>Price</th>";
        $output .= "<th></th>";
        $output .= "</tr>";

        while ($row = mysqli_fetch_array($result)) {
            $output .= "<tr>";
            $output .= "<td>" . $row['id'] . "</td>";
            $output .= "<td>" . $row['staffname'] . "</td>";
            $output .= "<td>" . $row['tablename'] . "</td>";
            $output .= "<td>" . $row['tablet'] . "</td>";
            $output .= "<td>" . $row['foodname'] . "</td>";
            $output .= "<td>" . $row['foodtype'] . "</td>";
            $output .= "<td>" . $row['price'] . "</td>";
            $output .= "<td><input type='button' name='confirm' value='Confirm' class='confirm_order' id='" . $row['id'] . "' /></td>";
            $output .= "</tr>";
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
}

echo $output;
