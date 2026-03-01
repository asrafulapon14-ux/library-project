<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
        }

        .card {
            border-radius: 20px;
            border: none;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        }

        .table thead {
            background-color: #764ba2;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            transition: 0.2s;
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

<div class="container py-5">

    <div class="card p-4">

        <div class="d-flex justify-content-between mb-4">
            <h3 class="fw-bold">📚 Book List</h3>
            <a href="add_book.php" class="btn btn-custom">Add New Book</a>
        </div>

        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM books";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['book_name']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-custom">← Back to Dashboard</a>
        </div>

    </div>

</div>

</body>
</html>