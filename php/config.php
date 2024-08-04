<?php
$conn_string = "host=localhost dbname=guff-gaff user=postgres password=abishek123";
$dbconn = pg_connect($conn_string) or die("Connection failed" . pg_last_error());
