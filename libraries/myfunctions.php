<?php
include_once('./mysql-fix.php');

function connectToDB($host,$user,$pass,$db) {
    $dbconn = mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
    mysql_select_db($db, $dbconn) or die("Could not select to the database");
}

?>