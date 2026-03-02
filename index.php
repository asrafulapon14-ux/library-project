<?php
include "db.php";

// ডাটাবেজ ডাটা
$books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"));
$students = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM students"));
$issued = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM issue_books"));
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MPI Library | Digital Portal</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { --primary: #1a5276; --accent: #ffc107; --light-bg: #f4f7f6; }
        body { font-family: 'Hind Siliguri', sans-serif; background-color: var(--light-bg); }
        
        /* Language Toggle */
        .lang-switcher {
            position: fixed; top: 15px; right: 20px; z-index: 1001;
            background: white; padding: 5px 15px; border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 1px solid var(--primary);
        }
        .lang-btn { cursor: pointer; font-weight: bold; color: var(--primary); font-size: 14px; text-decoration: none; }
        .lang-btn.active { color: #cc0000; text-decoration: underline; }

        /* Header */
        .hero-section { 
            background: linear-gradient(rgba(26, 82, 118, 0.9), rgba(26, 82, 118, 0.8)), url('library-bg.jpg') center/cover; 
            color: white; padding: 50px 0; text-align: center;
        }
        .logo-img { width: 90px; background: white; padding: 5px; border-radius: 50%; box-shadow: 0 5px 15px rgba(0,0,0,0.3); margin-bottom: 15px; }

        /* Search */
        .search-container { max-width: 600px; margin: 20px auto 0; }
        .search-input { border-radius: 30px 0 0 30px; padding: 12px 25px; border: none; }
        .search-btn { border-radius: 0 30px 30px 0; padding: 0 25px; background: var(--accent); border: none; }

        /* Stats & Menu */
        .stat-box { background: white; border-radius: 12px; padding: 15px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .menu-link {
            text-decoration: none; background: white; padding: 20px 10px; border-radius: 10px;
            display: flex; flex-direction: column; align-items: center; transition: 0.3s;
            border: 1px solid #eee; color: var(--primary);
        }
        .menu-link:hover { background: var(--primary); color: white; transform: translateY(-3px); }
        .menu-link i { font-size: 2rem; margin-bottom: 10px; }

        /* Rules Section - Centered List */
        .rules-card { background: #fff; border-radius: 15px; padding: 30px; margin-top: 40px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .rules-list-container { max-width: 700px; margin: 0 auto; text-align: left; }
        .rule-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f1f1f1; }
        .rule-item:last-child { border-bottom: none; }
        .rule-item i { color: #d32f2f; }

        /* Footer & Contact Icons Clickable */
        .footer { background: #0f2e44; color: #cbd5e1; padding: 40px 0 20px; margin-top: 60px; }
        .contact-box { text-decoration: none; color: inherit; display: block; transition: 0.3s; }
        .contact-box:hover { color: var(--accent); }
        .contact-icon { 
            width: 50px; height: 50px; background: rgba(255,255,255,0.1); 
            border-radius: 50%; display: inline-flex; align-items: center; 
            justify-content: center; margin-bottom: 10px; font-size: 20px;
        }
        .contact-box:hover .contact-icon { background: var(--accent); color: #000; }
    </style>
</head>
<body>

<div class="lang-switcher">
    <span id="btn-bn" class="lang-btn active" onclick="changeLang('bn')">বাংলা</span> | 
    <span id="btn-en" class="lang-btn" onclick="changeLang('en')">English</span>
</div>

<header class="hero-section">
    <div class="container">
        <img src="logo.png" alt="MPI Logo" class="logo-img">
        <h2 class="fw-bold translate" data-bn="ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট" data-en="Mymensingh Polytechnic Institute">ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট</h2>
        <p class="translate m-0" data-bn="লাইব্রেরী ম্যানেজমেন্ট পোর্টাল" data-en="Library Management Portal">লাইব্রেরী ম্যানেজমেন্ট পোর্টাল</p>
        
        <div class="search-container">
            <form action="search.php" method="GET" class="input-group">
                <input type="text" name="query" class="form-control search-input" id="search-ph" placeholder="বই বা লেখকের নাম দিয়ে খুঁজুন...">
                <button class="btn search-btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</header>

<main class="container">
    <div class="row g-4 justify-content-center" style="margin-top: -25px;">
        <div class="col-6 col-md-3">
            <div class="stat-box">
                <h3 class="fw-bold m-0"><?php echo $books['total'] ?? 0; ?></h3>
                <span class="small translate" data-bn="মোট বই" data-en="Total Books">মোট বই</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-box">
                <h3 class="fw-bold m-0"><?php echo $students['total'] ?? 0; ?></h3>
                <span class="small translate" data-bn="শিক্ষার্থী" data-en="Students">শিক্ষার্থী</span>
            </div>
        </div>
    </div>

    <div class="row g-3 text-center mt-4">
        <div class="col-6 col-md-4 col-lg-2">
            <a href="add_book.php" class="menu-link">
                <i class="fas fa-plus-square"></i>
                <span class="fw-bold translate" data-bn="নতুন বই" data-en="Add Book">নতুন বই</span>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="book_list.php" class="menu-link">
                <i class="fas fa-book"></i>
                <span class="fw-bold translate" data-bn="বই তালিকা" data-en="Book List">বই তালিকা</span>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="add_student.php" class="menu-link">
                <i class="fas fa-user-plus"></i>
                <span class="fw-bold translate" data-bn="ছাত্র যোগ" data-en="Add Student">ছাত্র যোগ</span>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="issue_book.php" class="menu-link">
                <i class="fas fa-address-book"></i>
                <span class="fw-bold translate" data-bn="বই ইস্যু" data-en="Issue Book">বই ইস্যু</span>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="issue_list.php" class="menu-link">
                <i class="fas fa-history"></i>
                <span class="fw-bold translate" data-bn="রেকর্ড" data-en="Records">রেকর্ড</span>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="student_list.php" class="menu-link">
                <i class="fas fa-users"></i>
                <span class="fw-bold translate" data-bn="শিক্ষার্থী" data-en="Students">শিক্ষার্থী</span>
            </a>
        </div>
    </div>

    <div class="rules-card shadow-sm">
        <h4 class="text-center mb-4 text-primary fw-bold translate" data-bn="লাইব্রেরী নীতিমালা" data-en="Library Rules">
            <i class="fas fa-gavel me-2"></i> লাইব্রেরী নীতিমালা
        </h4>
        <div class="rules-list-container">
            <div class="rule-item">
                <i class="fas fa-id-card"></i>
                <span class="translate" data-bn="আইডি কার্ড ছাড়া প্রবেশ সম্পূর্ণ নিষিদ্ধ।" data-en="Entry without ID card is strictly prohibited.">আইডি কার্ড ছাড়া প্রবেশ সম্পূর্ণ নিষিদ্ধ।</span>
            </div>
            <div class="rule-item">
                <i class="fas fa-volume-mute"></i>
                <span class="translate" data-bn="লাইব্রেরীর ভেতরে কথা বলা এবং মোবাইল ব্যবহার নিষেধ।" data-en="Talking and mobile use are prohibited inside.">লাইব্রেরীর ভেতরে কথা বলা এবং মোবাইল ব্যবহার নিষেধ।</span>
            </div>
            <div class="rule-item">
                <i class="fas fa-calendar-alt"></i>
                <span class="translate" data-bn="বই ইস্যুর মেয়াদ সর্বোচ্চ ১৫ দিন।" data-en="Maximum issue duration is 15 days.">বই ইস্যুর মেয়াদ সর্বোচ্চ ১৫ দিন।</span>
            </div>
            <div class="rule-item">
                <i class="fas fa-exclamation-triangle"></i>
                <span class="translate" data-bn="বইয়ের পাতায় দাগ দেওয়া বা ছেঁড়া দণ্ডনীয় অপরাধ।" data-en="Marking or tearing pages is a punishable offense.">বইয়ের পাতায় দাগ দেওয়া বা ছেঁড়া দণ্ডনীয় অপরাধ।</span>
            </div>
            <div class="rule-item">
                <i class="fas fa-money-bill-wave"></i>
                <span class="translate" data-bn="বই জমা দিতে বিলম্ব হলে প্রতিদিন জরিমানা প্রযোজ্য।" data-en="Daily fine applies for late book returns.">বই জমা দিতে বিলম্ব হলে প্রতিদিন জরিমানা প্রযোজ্য।</span>
            </div>
        </div>
    </div>
</main>

<footer class="footer text-center">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <a href="tel:01687156342" class="contact-box">
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <p class="small m-0 translate" data-bn="কল করুন" data-en="Call Now">কল করুন</p>
                    <span class="fw-bold">01687-156342</span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="mailto:principal.mpi@gmail.com" class="contact-box">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <p class="small m-0 translate" data-bn="ইমেইল" data-en="Email Us">ইমেইল</p>
                    <span class="fw-bold">principal.mpi@gmail.com</span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="https://facebook.com/mpimymen" target="_blank" class="contact-box">
                    <div class="contact-icon"><i class="fab fa-facebook-f"></i></div>
                    <p class="small m-0 translate" data-bn="ফেসবুক" data-en="Facebook">ফেসবুক</p>
                    <span class="fw-bold">mpimymen</span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="https://www.google.com/maps/search/Mymensingh+Polytechnic+Institute" target="_blank" class="contact-box">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <p class="small m-0 translate" data-bn="লোকেশন" data-en="Location">লোকেশন</p>
                    <span class="small">Maskanda, Mymensingh</span>
                </a>
            </div>
        </div>
        <div class="mt-4 pt-3 border-top border-secondary opacity-50">
            <p class="small">&copy; 2026 ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট | <a href="http://mpi.polytech.gov.bd" target="_blank" class="text-warning">mpi.polytech.gov.bd</a></p>
        </div>
    </div>
</footer>

<script>
    function changeLang(lang) {
        document.querySelectorAll('.translate').forEach(el => {
            el.innerText = el.getAttribute('data-' + lang);
        });
        const searchInput = document.getElementById('search-ph');
        if(lang === 'en') {
            searchInput.placeholder = "Search books or authors...";
            document.getElementById('btn-en').classList.add('active');
            document.getElementById('btn-bn').classList.remove('active');
        } else {
            searchInput.placeholder = "বই বা লেখকের নাম দিয়ে খুঁজুন...";
            document.getElementById('btn-bn').classList.add('active');
            document.getElementById('btn-en').classList.remove('active');
        }
    }
</script>
</body>
</html>