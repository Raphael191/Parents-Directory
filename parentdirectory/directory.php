<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.html");
    exit();
}
include "db.php";

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM students
        WHERE student_name LIKE '%$search%'
        OR parent_name LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Parent Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <h3>Parent Directory</h3>

        <form class="mb-3" method="GET" action="directory.php">
            <input type="text" name="search" class="form-control"
                placeholder="Search by student or parent name"
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

        </form>

        <table class="table table-bordered table-striped">
            <tr>
                <th>Student Name</th>
                <th>Parent Name</th>
                <th>Phone</th>
                <th>Class</th>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                    <th>Actions</th>
                <?php } ?>


            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['student_name']; ?></td>
                    <td><?= $row['parent_name']; ?></td>
                    <td><?= $row['phone_number']; ?></td>
                    <td><?= $row['class']; ?></td>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                        <td>
                            <a href="delete_student.php?id=<?= $row['id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this student?')">
                                Delete
                            </a>
                        </td>
                    <?php } ?>

                </tr>
            <?php } ?>
            </tbody>


        </table>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
            <a href="add_student.html" class="btn btn-primary">Add Student</a>
        <?php } ?>
    </div>

</body>

</html>