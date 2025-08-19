<?php
// db.php
$host = "localhost"; // Change if your host is different
$dbname = "dbka9b264bobow";
$username = "u4bnbyhiyrxai";
$password = "_s^4&i)%s^{#";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<h2 style='color:red; text-align:center;'>Database Connection Failed: " . $conn->connect_error . "</h2>");
}
?>
