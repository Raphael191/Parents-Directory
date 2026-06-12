<?php
$conn = mysqli_connect("localhost", "root", "", "Sakito");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
