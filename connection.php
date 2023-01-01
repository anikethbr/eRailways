<?php
session_start();
$con = mysqli_connect(
    "localhost",
    "root",
    "",
    "eRailways"
);
if(!$con){
    die("connection unsuccesful");
}
?>