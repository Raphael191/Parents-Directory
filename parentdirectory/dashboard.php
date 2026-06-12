<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Parent Directory</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
        }

        .card {
            border-radius: 10px;
        }
    </style>
    <?php

    session_start();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.html");
        exit();
    }
    include "db.php";

    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
    $row = mysqli_fetch_assoc($result);
    $totalStudents = $row['total'];

    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
    $row = mysqli_fetch_assoc($result);
    $totalParents = $row['total'];

    ?>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-primary px-4">
        <span class="navbar-brand mb-0 h1">Basic School Parent Directory</span>
        <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container mt-4">

        <!-- DASHBOARD HEADER -->
        <h3 class="mb-4">Admin Dashboard</h3>

        <!-- SUMMARY CARDS -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5>Total Students</h5>
                    <h2><?php echo $totalStudents; ?></h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5>Total Classes</h5>
                    <h2>12</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5>Active Parents</h5>
                    <h2><?php echo $totalParents; ?></h2>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="row mb-4">
            <div class="col-md-6">
                <a href="add_student.html" class="btn btn-success w-100 mb-2">
                    ➕ Add New Student
                </a>
            </div>
            <div class="col-md-6">
                <a href="directory.php" class="btn btn-primary w-100 mb-2">
                    📋 View Parent Directory
                </a>
            </div>
        </div>

        <!-- QUICK SEARCH -->
        <div class="card p-3 shadow">
            <h5>Quick Search</h5>
            <form action="directory.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter student name">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

    </div>

</body>

</html>