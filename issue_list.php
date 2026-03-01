<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issued Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Issued Books List</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Book Name</th>
                        <th>Student Name</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $query = "SELECT issue_books.id,
                                 books.book_name,
                                 students.name,
                                 issue_books.issue_date,
                                 issue_books.return_date
                          FROM issue_books
                          JOIN books ON issue_books.book_id = books.id
                          JOIN students ON issue_books.student_id = students.id";

                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result)){
                ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['book_name']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['issue_date']; ?></td>
                        <td><?php echo $row['return_date']; ?></td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>

            <a href="issue_book.php" class="btn btn-primary">Issue New Book</a>

        </div>
    </div>

</div>

</body>
</html>