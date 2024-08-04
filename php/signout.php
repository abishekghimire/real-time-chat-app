<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $signout_id = pg_escape_string($dbconn, $_GET['signout_id']);
    if (isset($signout_id)) {
        $status = "Offline now";
        $sql = pg_query($dbconn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$signout_id}");
        if ($sql) {
            session_unset();
            session_destroy();
            header("location: ../signin.php");
        } else {
            header("location: ../user.php");
        }
    } else {
        header("location: ../signin.php");
    }
}
