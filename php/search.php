<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$searchTerm = pg_escape_string($dbconn, $_POST['searchTerm']);
$result = "";
$sql = pg_query($dbconn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");
if (pg_num_rows($sql) > 0) {
    include_once "data.php";
} else {
    include_once "data.php";
    $result .= 'No user found';
}
echo $result;
