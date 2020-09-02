<?php
include 'header.html';


class Galaxy {
    private $host = "127.0.0.1:3307";
    private $user = "root";
    private $pass = "root";
    private $db = "galaxy";
    private $link;

    public function __construct() {

        /* Connect to database */
        $this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        // Check connection
        if($this->link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    }

    public function showHeader() {
        echo "<h1 class='title'>The Restaurant at the End of the Universe</h1>";
        echo "<div class='content row'>";
    }

    public function showFooter() {
        echo "</div>";
    }

    public function showClients() {
        $sql = "SELECT * FROM clients";
        if($result = mysqli_query($this->link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<div class='col-3'>";
                    echo "<h2>Clients</h2>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>id</th>";
                    echo "<th>name</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                echo "</div>";
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->link);
        }
    }

    public function showStaffs() {
        $sql = "SELECT * FROM staffs";
        if($result = mysqli_query($this->link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<div class='col-3'>";
                    echo "<h2>Staffs</h2>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>id</th>";
                    echo "<th>name</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                echo "</div>";
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->link);
        }
    }

    public function formInsertStaff() {
        echo "<div class='col-3'>";
            echo "<h3>Insert staff</h3>";
            //echo '<form action="/submit_order.php">';
        echo '</div>';
    }

    public function showOrders() {
        $sql = "SELECT o.id as id, s.name as staffname, t.name as tablename, ts.name as tablet, f.name as foodname, f.type as foodtype, f.price as price FROM orders o
                LEFT JOIN staffs s ON o.staff_id = s.id
                LEFT JOIN foods f ON o.food_id = f.id
                LEFT JOIN tables t ON o.table_id = t.id
                LEFT JOIN tablets ts ON o.tablet_id = ts.id
                WHERE is_active = 1";

        if($result = mysqli_query($this->link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<div class='col-3'>";
                    echo "<h2>Orders</h2>";
                    echo "<table id='table_orders'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Staff</th>";
                    echo "<th>Table</th>";
                    echo "<th>Tablet</th>";
                    echo "<th>Food</th>";
                    echo "<th>Food type</th>";
                    echo "<th>Price</th>";
                    echo "<th></th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['staffname'] . "</td>";
                        echo "<td>" . $row['tablename'] . "</td>";
                        echo "<td>" . $row['tablet'] . "</td>";
                        echo "<td>" . $row['foodname'] . "</td>";
                        echo "<td>" . $row['foodtype'] . "</td>";
                        echo "<td>" . $row['price'] . "€</td>";
                        echo "<td><input type='button' name='confirm' value='Confirm' class='confirm_order' id='" . $row['id'] . "' /></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                echo "</div>";
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->link);
        }
    }

    public function formInsertOrder() {

        echo '<div class="col-3">';
            echo "<h3>Insert order</h3>";
            //echo '<form action="/submit_order.php">';
            echo '<div>';

            echo '<label for="table">Staff:</label><br>';
            $sql = "SELECT * FROM staffs";
            if($result = mysqli_query($this->link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo '<input type="radio" id="' . $row['id'] . '" name="staff[]" value="' . $row['name'] . '">';
                        echo '<label for="' . $row['id'] . '"> ' . $row['name'] . '</label><br>';
                    }
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->link);
            }

            echo '<br><label for="table">Table:</label><br>';
            $sql = "SELECT * FROM tables";
            if($result = mysqli_query($this->link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo '<input type="radio" id="' . $row['id'] . '" name="table[]" value="' . $row['name'] . '">';
                        echo '<label for="' . $row['id'] . '"> ' . $row['name'] . '</label><br>';
                    }
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->link);
            }

            echo '<br><label for="tablet">Tablet:</label><br>';
            $sql = "SELECT * FROM tablets";
            if($result = mysqli_query($this->link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo '<input type="radio" id="' . $row['id'] . '" name="tablet[]" value="' . $row['name'] . '">';
                        echo '<label for="' . $row['id'] . '"> ' . $row['name'] . '</label><br>';
                    }
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->link);
            }

            echo '<br><label for="tablet">Food & Drink:</label><br>';
            $sql = "SELECT * FROM foods";
            if($result = mysqli_query($this->link, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo '<input type="radio" id="' . $row['id'] . '" name="foodanddrink[]" value="' . $row['name'] . '">';
                        echo '<label for="' . $row['id'] . '"> ' . $row['name'] . ' (' . $row['type'] . ') - ' . $row['price'] . '€</label><br>';
                    }
                    // Free result set
                    mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->link);
            }

            echo '<br><br><input type="button" id="submitOrder" value="Submit order">';
            echo '</div>';
        echo '</div>';
    }

    public function closeDB() {
        mysqli_close($this->link);
    }
}

$g = new Galaxy();
$g->showHeader();

$g->showClients();
//$g->formInsertStaff();
$g->showStaffs();
$g->formInsertOrder();
$g->showOrders();

$g->showFooter();
$g->closeDB();