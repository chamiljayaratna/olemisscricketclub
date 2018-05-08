<?php

    require_once ('session.php');
    require_once ('included_functions.php');
    verify_login();
    $mysqli = db_connection();

    $resID = $_GET['id'];
    echo $resID;

    $query = "DELETE FROM Users WHERE userID = '".$userID."'";
    $result = $mysqli->query($query);
   
?>