<?php
include "db.php";

// Fetch books and students for dropdown
$books = mysqli_query($conn, "SELECT id, book_name FROM books");
$students = mysqli_query($conn, "SELECT id, name FROM students");

if(isset($_POST['submit'])){
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];

    $query = "INSERT INTO issue_books (book_id, student_id, issue_date, return_date)
              VALUES ('$book_id', '$student_id', '$issue_date', '$return_date')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Book Issued Successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Book</title>
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
            width: 450px;
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

    <h3 class="text-center mb-4">📖 Issue Book</h3>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Select Book</label>
            <select name="book_id" class="form-control" required>
                <option value="">-- Select Book --</option>
                <?php while($book = mysqli_fetch_assoc($books)){ ?>
                    <option value="<?php echo $book['id']; ?>"><?php echo $book['book_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Student</label>
            <select name="student_id" class="form-control" required>
                <option value="">-- Select Student --</option>
                <?php while($student = mysqli_fetch_assoc($students)){ ?>
                    <option value="<?php echo $student['id']; ?>"><?php echo $student['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Issue Date</label>
            <input type="date" name="issue_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Return Date</label>
            <input type="date" name="return_date" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-custom">
                Issue Book
            </button>
        </div>

        <div class="text-center mt-3">
            <a href="index.php">← Back to Dashboard</a>
        </div>

    </form>

</div>

</body>
</html>