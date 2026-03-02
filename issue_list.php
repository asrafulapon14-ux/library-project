<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ইস্যু করা বইয়ের তালিকা | MPI Library</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --primary: #1a5276; --accent: #ffc107; --light-bg: #f4f7f6; --danger: #e74c3c; }
        body { font-family: 'Hind Siliguri', sans-serif; background-color: var(--light-bg); }
        
        .hero-section { 
            background: linear-gradient(rgba(26, 82, 118, 0.9), rgba(26, 82, 118, 0.8)), url('library-bg.jpg') center/cover; 
            color: white; padding: 40px 0; text-align: center;
        }

        /* Search & Action Section */
        .search-box {
            max-width: 600px; margin: -25px auto 30px;
            background: white; padding: 10px; border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); display: flex; align-items: center;
        }
        .search-box input { border: none; padding: 10px 20px; width: 100%; border-radius: 50px; outline: none; }
        .search-box i { padding-left: 20px; color: var(--primary); }

        /* Table Card */
        .list-card {
            background: white; border-radius: 15px; overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid #eee;
        }
        .table thead { background: var(--primary); color: white; }
        .table th { padding: 15px; font-weight: 600; border: none; font-size: 0.9rem; }
        .table td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #f1f1f1; }
        
        .date-badge {
            display: inline-block; padding: 4px 10px; border-radius: 6px;
            font-size: 0.85rem; font-weight: 600;
        }
        .issue-date { background: #e8f4fd; color: #2980b9; }
        .return-date { background: #fff4e5; color: #d35400; }

        .lang-switcher {
            position: fixed; top: 15px; right: 20px; z-index: 1001;
            background: white; padding: 5px 15px; border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 1px solid var(--primary);
        }
        .lang-btn { cursor: pointer; font-weight: bold; color: var(--primary); font-size: 14px; }
        .lang-btn.active { color: #cc0000; text-decoration: underline; }

        .btn-issue {
            background: var(--accent); color: #000; font-weight: 600; border-radius: 30px;
            padding: 8px 20px; text-decoration: none; transition: 0.3s;
        }
        .btn-issue:hover { background: #e5ac00; transform: translateY(-2px); color: #000; }

        .footer { background: #0f2e44; color: #cbd5e1; padding: 40px 0 20px; margin-top: 60px; }
    </style>
</head>
<body>

<div class="lang-switcher">
    <span id="btn-bn" class="lang-btn active" onclick="changeLang('bn')">বাংলা</span> | 
    <span id="btn-en" class="lang-btn" onclick="changeLang('en')">English</span>
</div>

<header class="hero-section">
    <div class="container">
        <h2 class="fw-bold translate" data-bn="বই ইস্যু করার ইতিহাস" data-en="Book Issued History">বই ইস্যু করার ইতিহাস</h2>
        <div class="d-flex justify-content-center gap-3 mt-2">
            <a href="index.php" class="text-white text-decoration-none small translate" data-bn="← ড্যাশবোর্ড" data-en="← Dashboard">← ড্যাশবোর্ড</a>
            <span class="text-white-50">|</span>
            <a href="issue_book.php" class="btn-issue translate" data-bn="+ নতুন ইস্যু" data-en="+ Issue New">+ নতুন ইস্যু</a>
        </div>
    </div>
</header>

<main class="container mb-5">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="issueSearch" class="translate-ph" placeholder="বই বা শিক্ষার্থীর নাম দিয়ে খুঁজুন..." data-bn-ph="বই বা শিক্ষার্থীর নাম দিয়ে খুঁজুন..." data-en-ph="Search by book or student name...">
    </div>

    <div class="list-card">
        <div class="table-responsive">
            <table class="table table-hover m-0" id="issueTable">
                <thead>
                    <tr>
                        <th class="translate" data-bn="বইয়ের নাম" data-en="Book Name">বইয়ের নাম</th>
                        <th class="translate" data-bn="গ্রহীতার নাম" data-en="Issued To">গ্রহীতার নাম</th>
                        <th class="translate" data-bn="ইস্যু তারিখ" data-en="Issue Date">ইস্যু তারিখ</th>
                        <th class="translate" data-bn="ফেরত তারিখ" data-en="Due Date">ফেরত তারিখ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT issue_books.id, books.book_name, students.name, 
                                     issue_books.issue_date, issue_books.return_date
                              FROM issue_books
                              JOIN books ON issue_books.book_id = books.id
                              JOIN students ON issue_books.student_id = students.id
                              ORDER BY issue_books.id DESC";
                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0):
                        while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="issue-row">
                            <td>
                                <div class="fw-bold text-dark">
                                    <i class="fas fa-book-bookmark text-primary me-2 opacity-50"></i>
                                    <?php echo $row['book_name']; ?>
                                </div>
                            </td>
                            <td class="text-secondary">
                                <i class="fas fa-user-circle me-1 opacity-50"></i>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <span class="date-badge issue-date">
                                    <i class="far fa-calendar-check me-1"></i>
                                    <?php echo date('d M, Y', strtotime($row['issue_date'])); ?>
                                </span>
                            </td>
                            <td>
                                <span class="date-badge return-date">
                                    <i class="far fa-clock me-1"></i>
                                    <?php echo date('d M, Y', strtotime($row['return_date'])); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted translate" data-bn="কোনো তথ্য পাওয়া যায়নি।" data-en="No records found.">কোনো তথ্য পাওয়া যায়নি।</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<footer class="footer text-center">
    <div class="container">
        <p class="small mb-0">© 2026 ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট | <a href="http://mpi.polytech.gov.bd" target="_blank" class="text-warning">mpi.polytech.gov.bd</a></p>
    </div>
</footer>

<script>
    // Live Filter
    document.getElementById('issueSearch').addEventListener('input', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('.issue-row');
        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
        });
    });

    // Language Toggle
    function changeLang(lang) {
        document.querySelectorAll('.translate').forEach(el => {
            el.innerText = el.getAttribute('data-' + lang);
        });
        
        const filterInput = document.getElementById('issueSearch');
        filterInput.placeholder = filterInput.getAttribute('data-' + lang + '-ph');

        document.getElementById('btn-en').classList.toggle('active', lang === 'en');
        document.getElementById('btn-bn').classList.toggle('active', lang === 'bn');
    }
</script>
</body>
</html>