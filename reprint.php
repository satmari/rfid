<?php
// Process delete operation after confirmation
    require_once "config.php"; 

$id = $_GET['id'];
$mysqli = new mysqli("localhost", "root", "root", "rfid");

             $mysqli->query("UPDATE labels SET printed = 0 WHERE id = $id");
             $mysqli->commit();
             header("location: landing.php");
                exit();
?>