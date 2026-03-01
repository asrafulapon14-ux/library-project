<?php
include "db.php";

if(isset($_POST['submit'])){
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $query = "INSERT INTO books (book_name, author, category) 
              VALUES ('$book_name', '$author', '$category')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Book Added Successfully!'); window.location.href='book_list.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Book | MPI Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --accent-color: #ffd700;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(255, 255, 255, 0.05);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top left, #1e293b, #0f172a);
            color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .form-card {
            width: 100%;
            max-width: 450px;
            background: var(--glass-bg);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }

        .college-tag {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--accent-color);
            font-weight: 700;
            display: block;
            margin-bottom: 10px;
        }

        .form-control {
            background: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 12px 15px;
            color: white !important;
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--accent-color);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.2);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-left: 5px;
            opacity: 0.9;
        }

        .btn-submit {
            background: var(--accent-color);
            color: #000;
            font-weight: 700;
            border: none;
            padding: 14px;
            border-radius: 12px;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .back-link {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .back-link:hover {
            color: var(--accent-color);
        }

        i { margin-right: 8px; }
    </style>
</head>

<body>

<div class="form-card text-center">
    <span class="college-tag">Mymensingh Polytechnic Institute</span>
    <h2 class="fw-bold mb-4">📚 Add New Book</h2>

    <form method="POST">
        <div class="mb-3 text-start">
            <label class="form-label text-white"><i class="bi bi-book"></i> Book Name</label>
            <input type="text" name="book_name" class="form-control" placeholder="Enter book title" required>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label text-white"><i class="bi bi-person-circle"></i> Author Name</label>
            <input type="text" name="author" class="form-control" placeholder="Enter author name" required>
        </div>

        <div class="mb-4 text-start">
            <label class="form-label text-white"><i class="bi bi-tag"></i> Category</label>
            <input type="text" name="category" class="form-control" placeholder="e.g. Computer, Civil" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-submit">
                <i class="bi bi-check2-circle"></i> Save Book to Inventory
            </button>
        </div>

        <div class="mt-4">
            <a href="index.php" class="back-link">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </form>
</div>

</body>
</html>