<?php
include "db.php";

// ড্রপডাউনের জন্য বই এবং স্টুডেন্ট ডাটা আনা
$books = mysqli_query($conn, "SELECT id, book_name FROM books ORDER BY book_name ASC");
$students = mysqli_query($conn, "SELECT id, name FROM students ORDER BY name ASC");

if(isset($_POST['submit'])){
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];

    $query = "INSERT INTO issue_books (book_id, student_id, issue_date, return_date)
              VALUES ('$book_id', '$student_id', '$issue_date', '$return_date')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('বই সফলভাবে ইস্যু করা হয়েছে!'); window.location.href='index.php';</script>";
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
    <title>বই ইস্যু | MPI Library</title>
    
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
        .form-control, .form-select { border-radius: 8px; padding: 12px; border: 1px solid #ddd; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 0.25rem rgba(26, 82, 118, 0.1); }

        .btn-submit { 
            background: var(--primary); color: white; font-weight: bold; 
            padding: 12px 30px; border-radius: 30px; border: none; transition: 0.3s;
        }
        .btn-submit:hover { background: #143d59; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); color: white; }

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
        <h2 class="fw-bold translate" data-bn="শিক্ষার্থীকে বই ইস্যু করুন" data-en="Issue Book to Student">শিক্ষার্থীকে বই ইস্যু করুন</h2>
        <p class="translate" data-bn="ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট লাইব্রেরী" data-en="Mymensingh Polytechnic Institute Library">ময়মনসিংহ পলিটেকনিক ইনস্টিটিউট লাইব্রেরী</p>
    </div>
</header>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="form-card">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label translate" data-bn="বই নির্বাচন করুন" data-en="Select Book">বই নির্বাচন করুন</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-book text-primary"></i></span>
                            <select name="book_id" class="form-select" required>
                                <option value="" selected disabled class="translate" data-bn="তালিকা থেকে বই বেছে নিন..." data-en="Choose from inventory...">তালিকা থেকে বই বেছে নিন...</option>
                                <?php while($book = mysqli_fetch_assoc($books)){ ?>
                                    <option value="<?php echo $book['id']; ?>"><?php echo $book['book_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label translate" data-bn="শিক্ষার্থী নির্বাচন করুন" data-en="Select Student">শিক্ষার্থী নির্বাচন করুন</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user-graduate text-primary"></i></span>
                            <select name="student_id" class="form-select" required>
                                <option value="" selected disabled class="translate" data-bn="নাম অনুযায়ী শিক্ষার্থী বেছে নিন..." data-en="Select student by name...">নাম অনুযায়ী শিক্ষার্থী বেছে নিন...</option>
                                <?php while($student = mysqli_fetch_assoc($students)){ ?>
                                    <option value="<?php echo $student['id']; ?>"><?php echo $student['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label translate" data-bn="ইস্যু করার তারিখ" data-en="Issue Date">ইস্যু করার তারিখ</label>
                            <input type="date" name="issue_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label translate" data-bn="ফেরত দেওয়ার তারিখ" data-en="Return Date">ফেরত দেওয়ার তারিখ</label>
                            <input type="date" name="return_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn-submit translate" data-bn="বই ইস্যু নিশ্চিত করুন" data-en="Confirm Book Issue">বই ইস্যু নিশ্চিত করুন</button>
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