<?php
    require('connection.php');
    if(isset($_SESSION['signedup'])){
        unset($_SESSION['signedup']);
    }
    if(isset($_SESSION['loggedin'])){
        unset($_SESSION['loggedin']);
    }
    if(isset($_SESSION['pid'])){
        unset($_SESSION['pid']);
    }
    if(isset($_SESSION['admin'])){
        unset($_SESSION['admin']);
    }
    echo'<script>alert("successfully logged out");</script>';
    header("location:./index.php");
    die();
?>