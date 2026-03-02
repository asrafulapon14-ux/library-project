<?php
include "db.php";
// ডাটাবেজ থেকে বইয়ের তথ্য আনা
$query = "SELECT book_name, author, category FROM books ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বইয়ের তালিকা | MPI Library</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --primary: #1a5276; --accent: #ffc107; --light-bg: #f4f7f6; }
        body { font-family: 'Hind Siliguri', sans-serif; background-color: var(--light-bg); }
        
        .hero-section { 
            background: linear-gradient(rgba(26, 82, 118, 0.9), rgba(26, 82, 118, 0.8)), url('library-bg.jpg') center/cover; 
            color: white; padding: 40px 0; text-align: center;
        }

        /* Search Section */
        .search-box {
            max-width: 600px; margin: -25px auto 30px;
            background: white; padding: 10px; border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); display: flex; align-items: center;
        }
        .search-box input { border: none; padding: 10px 20px; width: 100%; border-radius: 50px; outline: none; }
        .search-box i { padding-left: 20px; color: var(--primary); }

        /* Table Card Design */
        .list-card {
            background: white; border-radius: 15px; overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid #eee;
        }
        .table thead { background: var(--primary); color: white; }
        .table th { padding: 15px; font-weight: 600; border: none; }
        .table td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #f1f1f1; }
        
        .cat-badge {
            background: rgba(26, 82, 118, 0.1); color: var(--primary);
            padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;
        }

        .lang-switcher {
            position: fixed; top: 15px; right: 20px; z-index: 1001;
            background: white; padding: 5px 15px; border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 1px solid var(--primary);
        }
        .lang-btn { cursor: pointer; font-weight: bold; color: var(--primary); font-size: 14px; }
        .lang-btn.active { color: #cc0000; text-decoration: underline; }

        .footer { background: #0f2e44; color: #cbd5e1; padding: 40px 0 20px; margin-top: 60px; }
        
        @media (max-width: 768px) {
            .table-responsive { border: 0; }
            .hero-section h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="lang-switcher">
    <span id="btn-bn" class="lang-btn active" onclick="changeLang('bn')">বাংলা</span> | 
    <span id="btn-en" class="lang-btn" onclick="changeLang('en')">English</span>
</div>

<header class="hero-section">
    <div class="container">
        <h2 class="fw-bold translate" data-bn="লাইব্রেরী বইয়ের ক্যাটালগ" data-en="Library Book Catalog">লাইব্রেরী বইয়ের ক্যাটালগ</h2>
        <a href="index.php" class="text-white text-decoration-none small translate" data-bn="← ড্যাশবোর্ডে ফিরে যান" data-en="← Back to Dashboard">← ড্যাশবোর্ডে ফিরে যান</a>
    </div>
</header>

<main class="container mb-5">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="filterInput" class="translate-ph" placeholder="বই, লেখক বা ক্যাটাগরি দিয়ে খুঁজুন..." data-bn-ph="বই, লেখক বা ক্যাটাগরি দিয়ে খুঁজুন..." data-en-ph="Search by name, author or category...">
    </div>

    <div class="list-card">
        <div class="table-responsive">
            <table class="table table-hover m-0" id="bookTable">
                <thead>
                    <tr>
                        <th class="translate" data-bn="বইয়ের নাম" data-en="Book Name">বইয়ের নাম</th>
                        <th class="translate" data-bn="লেখক" data-en="Author">লেখক</th>
                        <th class="translate" data-bn="বিভাগ/ক্যাটাগরি" data-en="Category">বিভাগ/ক্যাটাগরি</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="book-row">
                            <td class="fw-bold text-dark"><?php echo $row['book_name']; ?></td>
                            <td class="text-secondary"><?php echo $row['author']; ?></td>
                            <td><span class="cat-badge"><?php echo $row['category'] ?: 'General'; ?></span></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted translate" data-bn="কোনো বই পাওয়া যায়নি।" data-en="No books found.">কোনো বই পাওয়া যায়নি।</td>
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
    // Real-time Search Filter
    document.getElementById('filterInput').addEventListener('input', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('.book-row');
        
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });

    // Language Switcher
    function changeLang(lang) {
        document.querySelectorAll('.translate').forEach(el => {
            el.innerText = el.getAttribute('data-' + lang);
        });
        
        const filterInput = document.getElementById('filterInput');
        filterInput.placeholder = filterInput.getAttribute('data-' + lang + '-ph');

        if(lang === 'en') {
            document.getElementById('btn-en').classList.add('active');
            document.getElementById('btn-bn').classList.remove('active');
        } else {
            document.getElementById('btn-bn').classList.add('active');
            document.getElementById('btn-en').classList.remove('active');
        }
    }
</script>
</body>
</html>