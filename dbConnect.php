<?php
$servername = "localhost";
$dbname='storyTelling';
$userName = "root";
$password = "root";

$db = new mysqli($servername, $userName, $password, $dbname);

if ($db->connect_error) {
 die("Connection failed: " . $db->connect_error);
}

?>
