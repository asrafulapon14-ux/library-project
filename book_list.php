<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book List | Mymensingh Polytechnic Institute</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --accent-color: #ffd700;
            --glass-bg: rgba(255, 255, 255, 0.07);
            --glass-border: rgba(255, 255, 255, 0.15);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top left, #1e293b, #0f172a);
            color: #ffffff;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
        }

        /* Premium Table Card */
        .table-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            backdrop-filter: blur(15px);
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            margin-top: 30px;
        }

        .header-title {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--accent-color);
        }

        /* Table Styling */
        .table {
            color: #ffffff !important;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {
            background-color: transparent;
            border: none;
            color: var(--accent-color);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding-bottom: 20px;
        }

        .table tbody tr {
            background: rgba(255, 255, 255, 0.05);
            transition: 0.3s;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: scale(1.01);
        }

        .table td {
            padding: 15px !important;
            vertical-align: middle;
            border: none;
        }

        .table td:first-child { border-radius: 12px 0 0 12px; }
        .table td:last-child { border-radius: 0 12px 12px 0; }

        /* Custom Buttons */
        .btn-add {
            background: var(--accent-color);
            color: #000;
            font-weight: 700;
            border-radius: 12px;
            padding: 10px 25px;
            border: none;
            transition: 0.3s;
        }

        .btn-add:hover {
            background: #fff;
            transform: translateY(-2px);
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 10px 25px;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #fff;
            color: #000;
        }

        /* Badge for Category */
        .cat-badge {
            background: rgba(255, 215, 0, 0.15);
            color: var(--accent-color);
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container py-5">
    
    <div class="text-center mb-4">
        <h5 class="text-uppercase opacity-50 mb-1" style="letter-spacing: 3px;">Mymensingh Polytechnic Institute</h5>
        <h2 class="header-title">📚 Modern Book Archive</h2>
    </div>

    <div class="table-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="m-0 fw-bold">Available Collection</h4>
            <a href="add_book.php" class="btn btn-add">
                <i class="bi bi-plus-lg me-2"></i>Add New Book
            </a>
        </div>

        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Title</th>
                        <th>Author Name</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM books";
                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td class="fw-bold text-white-50">#<?php echo $row['id']; ?></td>
                        <td class="text-start ps-4 fw-semibold"><?php echo $row['book_name']; ?></td>
                        <td><i class="bi bi-person me-2 opacity-50"></i><?php echo $row['author']; ?></td>
                        <td><span class="cat-badge"><?php echo $row['category']; ?></span></td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='4' class='py-5 opacity-50'>No books found in the library.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-5">
            <a href="index.php" class="btn btn-back">
                <i class="bi bi-arrow-left me-2"></i>Return to Dashboard
            </a>
        </div>
    </div>
</div>

</body>
</html>