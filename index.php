<?php
include "db.php";

$books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"));
$students = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM students"));
$issued = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM issue_books"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .title {
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="title">📚 Library Management System</h1>
        <p class="text-white">Premium Dashboard</p>
    </div>

    <!-- Statistics Section -->
    <div class="row g-4 mb-5">

        <div class="col-md-4">
            <div class="card text-center p-4 bg-light">
                <i class="bi bi-book icon text-primary"></i>
                <h3><?php echo $books['total']; ?></h3>
                <p>Total Books</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4 bg-light">
                <i class="bi bi-people icon text-success"></i>
                <h3><?php echo $students['total']; ?></h3>
                <p>Total Students</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4 bg-light">
                <i class="bi bi-journal-check icon text-danger"></i>
                <h3><?php echo $issued['total']; ?></h3>
                <p>Total Issued Books</p>
            </div>
        </div>

    </div>

    <!-- Menu Section -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>Add Book</h5>
                <a href="add_book.php" class="btn btn-dark mt-3">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>Book List</h5>
                <a href="book_list.php" class="btn btn-dark mt-3">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>Add Student</h5>
                <a href="add_student.php" class="btn btn-dark mt-3">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>Student List</h5>
                <a href="student_list.php" class="btn btn-dark mt-3">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>Issue Book</h5>
                <a href="issue_book.php" class="btn btn-dark mt-3">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-4">
                <h5>Issued Books</h5>
                <a href="issue_list.php" class="btn btn-dark mt-3">Open</a>
            </div>
        </div>

    </div>

</div>

</body>
</html>