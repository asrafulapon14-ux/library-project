<?php
include "db.php";

$books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"));
$students = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM students"));
$issued = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM issue_books"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management | MPI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --accent-color: #ffd700; /* Gold for MPI Branding */
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top left, #1a1a2e, #16213e); /* Deep Dark Theme */
            background-attachment: fixed;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .college-title {
            font-weight: 800;
            font-size: 2.5rem;
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0;
        }

        .sub-title {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 400;
        }

        /* Stats Card Styling */
        .stat-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            padding: 25px;
            transition: 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stat-icon {
            font-size: 2.2rem;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        /* Menu Card Styling */
        .menu-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            transition: 0.3s;
            height: 100%;
        }

        .menu-card:hover {
            background: var(--accent-color);
            transform: scale(1.03);
        }

        .menu-card h5 { font-weight: 600; margin-bottom: 15px; }
        .menu-card:hover h5, .menu-card:hover i { color: #000; }

        .btn-open {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            padding: 8px 20px;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-block;
            transition: 0.3s;
        }

        .menu-card:hover .btn-open {
            background: #000;
            border-color: #000;
        }

        /* Footer Styling */
        footer {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            padding: 30px 0;
            border-top: 1px solid var(--glass-border);
            margin-top: 50px;
        }

        .footer-link {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .footer-link:hover {
            color: var(--accent-color);
        }

        .contact-info {
            font-size: 0.9rem;
            opacity: 0.7;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container main-content">
    <div class="text-center mb-5">
        <h1 class="college-title">Mymensingh Polytechnic Institute</h1>
        <p class="sub-title">Library Management System</p>
        <div style="width: 100px; height: 4px; background: var(--accent-color); margin: 10px auto; border-radius: 2px;"></div>
    </div>

    <div class="row g-4 mb-5 text-center">
        <div class="col-md-4">
            <div class="stat-card">
                <i class="bi bi-bookshelf stat-icon"></i>
                <h3><?php echo $books['total']; ?></h3>
                <p class="mb-0 opacity-75">Total Books</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <i class="bi bi-people-fill stat-icon"></i>
                <h3><?php echo $students['total']; ?></h3>
                <p class="mb-0 opacity-75">Total Students</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <i class="bi bi-journal-check stat-icon"></i>
                <h3><?php echo $issued['total']; ?></h3>
                <p class="mb-0 opacity-75">Issued Books</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php
        $actions = [
            ['title' => 'Add New Book', 'link' => 'add_book.php', 'icon' => 'bi-plus-square'],
            ['title' => 'Book Inventory', 'link' => 'book_list.php', 'icon' => 'bi-table'],
            ['title' => 'Add Student', 'link' => 'add_student.php', 'icon' => 'bi-person-plus-fill'],
            ['title' => 'Student List', 'link' => 'student_list.php', 'icon' => 'bi-person-lines-fill'],
            ['title' => 'Issue Book', 'link' => 'issue_book.php', 'icon' => 'bi-arrow-right-circle'],
            ['title' => 'Issued History', 'link' => 'issue_list.php', 'icon' => 'bi-history'],
        ];

        foreach ($actions as $act) {
            echo "
            <div class='col-md-4'>
                <div class='menu-card'>
                    <i class='{$act['icon']} mb-2 d-block' style='font-size: 1.8rem;'></i>
                    <h5>{$act['title']}</h5>
                    <a href='{$act['link']}' class='btn-open'>Open Module</a>
                </div>
            </div>";
        }
        ?>
    </div>
</div>

<footer>
    <div class="container text-center">
        <div class="mb-3">
            <a href="https://mympoly.gov.bd" target="_blank" class="footer-link"><i class="bi bi-globe"></i> Website</a>
            <a href="https://facebook.com/mympoly" target="_blank" class="footer-link"><i class="bi bi-facebook"></i> Facebook</a>
            <a href="mailto:info@mympoly.gov.bd" class="footer-link"><i class="bi bi-envelope-fill"></i> Email</a>
        </div>
        <p class="mb-0">© <?php echo date('Y'); ?> Mymensingh Polytechnic Institute. All Rights Reserved.</p>
        <p class="contact-info">Mymensingh, Bangladesh | Developed for Academic Project</p>
    </div>
</footer>

</body>
</html>