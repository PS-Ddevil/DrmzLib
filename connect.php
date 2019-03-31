<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_data";
$datatable = "book_details"; // MySQL table name
$authortable = "author";
$results_per_page = 10; // number of results per page
$results_per_page2 = 5;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
//    echo "Some Error";
}
?>