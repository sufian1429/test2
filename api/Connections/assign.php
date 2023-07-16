<?php
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL database password here
$dbname = "assign";

$assign = new mysqli($servername, $username, $password, $dbname);

if ($assign->connect_error) {
  die("Connection failed: " . $assign->connect_error);
}
?>