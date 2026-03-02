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
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বই যোগ করুন | MPI Library</title>
    
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

        .form-card {
            background: white; border-radius: 15px; padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: -50px; border-top: 5px solid var(--accent);
        }

        .form-label { font-weight: 600; color: var(--primary); }
        .form-control { border-radius: 8px; padding: 12px; border: 1px solid #ddd; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 0.25 row rgba(26, 82, 118, 0.1); }

        .btn-submit { 
            background: var(--primary); color: white; font-weight: bold; 
            padding: 12px 30px; border-radius: 30px; border: none; transition: 0.3s;
        }
        .btn-submit:hover { background: #143d59; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }

        .lang-switcher {
            position: fixed; top: 15px; right: 20px; z-index: 1001;
            background: white; padding: 5px 15px; border-radius: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 1px solid var(--primary);
        }
        .lang-btn { cursor: pointer; font-weight: bold; color: var(--primary); font-size: 14px; }
        .lang-btn.active { color: #cc0000; text-decoration: underline; }

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
        <h2 class="fw-bold translate" data-bn="নতুন বই সংগ্রহে যোগ করুন" data-en="Add New Book to Collection">নতুন বই সংগ্রহে যোগ করুন</h2>
        <p class="translate" data-bn="ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট লাইব্রেরী" data-en="Mymensingh Polytechnic Institute Library">ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট লাইব্রেরী</p>
    </div>
</header>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-card">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label translate" data-bn="বইয়ের নাম" data-en="Book Name">বইয়ের নাম</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-book text-primary"></i></span>
                            <input type="text" name="book_name" class="form-control" id="ph-name" placeholder="বইয়ের পুরো নাম লিখুন" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label translate" data-bn="লেখকের নাম" data-en="Author Name">লেখকের নাম</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-pen-nib text-primary"></i></span>
                            <input type="text" name="author" class="form-control" id="ph-author" placeholder="লেখকের নাম লিখুন" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label translate" data-bn="ক্যাটাগরি/বিভাগ" data-en="Category/Department">ক্যাটাগরি/বিভাগ</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-tags text-primary"></i></span>
                            <input type="text" name="category" class="form-control" id="ph-cat" placeholder="উদা: কম্পিউটার, ইলেকট্রিক্যাল" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn-submit translate" data-bn="বইটি নিবন্ধন করুন" data-en="Register Book">বইটি নিবন্ধন করুন</button>
                        <a href="index.php" class="btn btn-link text-decoration-none text-muted translate" data-bn="ফিরে যান" data-en="Go Back">ফিরে যান</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<footer class="footer text-center">
    <div class="container">
        <p class="small mb-0">© 2026 ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট | <a href="http://mpi.polytech.gov.bd" target="_blank" class="text-warning">mpi.polytech.gov.bd</a></p>
    </div>
</footer>

<script>
    function changeLang(lang) {
        document.querySelectorAll('.translate').forEach(el => {
            el.innerText = el.getAttribute('data-' + lang);
        });
        
        const phName = document.getElementById('ph-name');
        const phAuthor = document.getElementById('ph-author');
        const phCat = document.getElementById('ph-cat');

        if(lang === 'en') {
            phName.placeholder = "Enter full book title";
            phAuthor.placeholder = "Enter author's name";
            phCat.placeholder = "e.g. Computer, Electrical";
            document.getElementById('btn-en').classList.add('active');
            document.getElementById('btn-bn').classList.remove('active');
        } else {
            phName.placeholder = "বইয়ের পুরো নাম লিখুন";
            phAuthor.placeholder = "লেখকের নাম লিখুন";
            phCat.placeholder = "উদা: কম্পিউটার, ইলেকট্রিক্যাল";
            document.getElementById('btn-bn').classList.add('active');
            document.getElementById('btn-en').classList.remove('active');
        }
    }
</script>
</body>
</html>