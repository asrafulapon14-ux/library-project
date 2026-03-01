<?php
include "db.php";

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);

    $query = "INSERT INTO students (name, department, semester)
              VALUES ('$name', '$department', '$semester')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Student Added Successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 400px;
            border-radius: 20px;
            border: none;
            background: rgba(255, 255, 255, 0.95);
        }

        .btn-custom {
            background: #764ba2;
            color: white;
            border-radius: 10px;
        }

        .btn-custom:hover {
            background: #667eea;
        }
    </style>
</head>

<body>

<div class="card shadow p-4">

    <h3 class="text-center mb-4">🎓 Add New Student</h3>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Department</label>
            <input type="text" name="department" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <input type="text" name="semester" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-custom">
                Add Student
            </button>
        </div>

        <div class="text-center mt-3">
            <a href="index.php">← Back to Dashboard</a>
        </div>

    </form>

</div>

</body>
</html>