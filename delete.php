<?php

$db = require("db.php");
$config = require('config.php');
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();



$id = $_GET['id'];
// echo $id;
$query = "DELETE FROM userDetails WHERE id=$id";

$result = mysqli_query($conn, $query);

if ($result) {
    echo "Record deleted successfully";
    header("Location:addCrud.php");
    exit();
} else {
    echo "Record no successfully";
}
