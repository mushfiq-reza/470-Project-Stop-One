<?php
include_once '../model/db_conn.php';

$Name     = $_POST['Name'];
$Email     = $_POST['Email'];
$Password      = $_POST['Password'];


$sql = "INSERT INTO  salesman (name,email, password) VALUES ('$Name', '$Email', '$Password')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    set_time_limit(5);
    header("location: ../list-salesmans.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
