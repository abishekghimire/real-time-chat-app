<?php
session_start();
require_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = pg_query($dbconn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}"); // removing loged in user from user list
$result = "";

if (pg_num_rows($sql) == 0) {
   $result .= "No users are available to chat";
} elseif (pg_num_rows($sql) > 0) {
   include_once "data.php";
}
echo $result;
