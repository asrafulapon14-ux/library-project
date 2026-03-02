<?php
include "db.php";

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);

    $query = "INSERT INTO students (name, department, semester) 
              VALUES ('$name', '$department', '$semester')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Student Added Successfully!'); window.location.href='student_list.php';</script>";
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
    <title>শিক্ষার্থী নিবন্ধন | MPI Library</title>
    
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
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 0.25rem rgba(26, 82, 118, 0.1); }

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
        <h2 class="fw-bold translate" data-bn="নতুন শিক্ষার্থী নিবন্ধন করুন" data-en="Register New Student">নতুন শিক্ষার্থী নিবন্ধন করুন</h2>
        <p class="translate" data-bn="ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট লাইব্রেরী" data-en="Mymensingh Polytechnic Institute Library">ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট লাইব্রেরী</p>
    </div>
</header>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-card">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label translate" data-bn="শিক্ষার্থীর পূর্ণ নাম" data-en="Full Name">শিক্ষার্থীর পূর্ণ নাম</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user-tag text-primary"></i></span>
                            <input type="text" name="name" class="form-control" id="ph-name" placeholder="শিক্ষার্থীর নাম লিখুন" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label translate" data-bn="ডিপার্টমেন্ট/বিভাগ" data-en="Department">ডিপার্টমেন্ট/বিভাগ</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-building-columns text-primary"></i></span>
                            <input type="text" name="department" class="form-control" id="ph-dept" placeholder="উদা: কম্পিউটার সায়েন্স" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label translate" data-bn="বর্তমান সেমিস্টার" data-en="Current Semester">বর্তমান সেমিস্টার</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-graduation-cap text-primary"></i></span>
                            <input type="text" name="semester" class="form-control" id="ph-sem" placeholder="উদা: ৫ম" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn-submit translate" data-bn="শিক্ষার্থী যুক্ত করুন" data-en="Register Student">শিক্ষার্থী যুক্ত করুন</button>
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
        const phDept = document.getElementById('ph-dept');
        const phSem = document.getElementById('ph-sem');

        if(lang === 'en') {
            phName.placeholder = "Enter full student name";
            phDept.placeholder = "e.g. Computer Science";
            phSem.placeholder = "e.g. 5th";
            document.getElementById('btn-en').classList.add('active');
            document.getElementById('btn-bn').classList.remove('active');
        } else {
            phName.placeholder = "শিক্ষার্থীর নাম লিখুন";
            phDept.placeholder = "উদা: কম্পিউটার সায়েন্স";
            phSem.placeholder = "উদা: ৫ম";
            document.getElementById('btn-bn').classList.add('active');
            document.getElementById('btn-en').classList.remove('active');
        }
    }
</script>
</body>
</html>