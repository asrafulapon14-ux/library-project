<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>শিক্ষার্থী তালিকা | MPI Library</title>
    
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

        /* Student Card/Table Design */
        .list-card {
            background: white; border-radius: 15px; overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid #eee;
        }
        .table thead { background: var(--primary); color: white; }
        .table th { padding: 15px; font-weight: 600; border: none; }
        .table td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #f1f1f1; }
        
        .sem-badge {
            background: rgba(255, 193, 7, 0.15); color: #856404;
            padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .lang-switcher {
            position: fixed; top: 15px; right: 20px; z-index: 1001;
            background: white; padding: 5px 15px; border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 1px solid var(--primary);
        }
        .lang-btn { cursor: pointer; font-weight: bold; color: var(--primary); font-size: 14px; }
        .lang-btn.active { color: #cc0000; text-decoration: underline; }

        .btn-add {
            background: var(--accent); color: #000; font-weight: 600; border-radius: 30px;
            padding: 8px 20px; text-decoration: none; transition: 0.3s;
        }
        .btn-add:hover { background: #e5ac00; transform: translateY(-2px); color: #000; }

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
        <h2 class="fw-bold translate" data-bn="নিবন্ধিত শিক্ষার্থীর তালিকা" data-en="Registered Student List">নিবন্ধিত শিক্ষার্থীর তালিকা</h2>
        <div class="d-flex justify-content-center gap-3 mt-2">
            <a href="index.php" class="text-white text-decoration-none small translate" data-bn="← ড্যাশবোর্ড" data-en="← Dashboard">← ড্যাশবোর্ড</a>
            <span class="text-white-50">|</span>
            <a href="add_student.php" class="btn-add translate" data-bn="+ শিক্ষার্থী যোগ" data-en="+ Add Student">+ শিক্ষার্থী যোগ</a>
        </div>
    </div>
</header>

<main class="container mb-5">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="studentSearch" class="translate-ph" placeholder="নাম, বিভাগ বা সেমিস্টার দিয়ে খুঁজুন..." data-bn-ph="নাম, বিভাগ বা সেমিস্টার দিয়ে খুঁজুন..." data-en-ph="Search by name, dept or semester...">
    </div>

    <div class="list-card">
        <div class="table-responsive">
            <table class="table table-hover m-0" id="studentTable">
                <thead>
                    <tr>
                        <th class="translate" data-bn="শিক্ষার্থীর নাম" data-en="Student Name">শিক্ষার্থীর নাম</th>
                        <th class="translate" data-bn="বিভাগ" data-en="Department">বিভাগ</th>
                        <th class="translate" data-bn="সেমিস্টার" data-en="Semester">সেমিস্টার</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM students ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);

                    if(mysqli_num_rows($result) > 0):
                        while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="student-row">
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-graduate text-primary me-3 opacity-50"></i>
                                    <span class="fw-bold text-dark"><?php echo $row['name']; ?></span>
                                </div>
                            </td>
                            <td class="text-secondary"><?php echo $row['department']; ?></td>
                            <td><span class="sem-badge"><?php echo $row['semester']; ?> Semester</span></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted translate" data-bn="কোনো রেকর্ড পাওয়া যায়নি।" data-en="No student records found.">কোনো রেকর্ড পাওয়া যায়নি।</td>
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
    document.getElementById('studentSearch').addEventListener('input', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('.student-row');
        
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
        
        const filterInput = document.getElementById('studentSearch');
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