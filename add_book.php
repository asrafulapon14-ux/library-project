<?php
include "db.php";

if(isset($_POST['submit'])){
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $query = "INSERT INTO books (book_name, author, category)
              VALUES ('$book_name', '$author', '$category')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Book Added Successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
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

    <h3 class="text-center mb-4">📚 Add New Book</h3>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Book Name</label>
            <input type="text" name="book_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text" name="author" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-custom">
                Add Book
            </button>
        </div>

        <div class="text-center mt-3">
            <a href="index.php">← Back to Dashboard</a>
        </div>

    </form>

</div>

</body>
</html>