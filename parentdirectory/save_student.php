<?php
include "db.php";

$student_name = $_POST['student_name'];
$parent_name = $_POST['parent_name'];
$phone_number = $_POST['phone_number'];
$class = $_POST['class'];

$sql = "INSERT INTO students 
        (student_name, parent_name, phone_number, class)
        VALUES ('$student_name', '$parent_name', '$phone_number', '$class')";

if (mysqli_query($conn, $sql)) {
    header("Location: directory.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
