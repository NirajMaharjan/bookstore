<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">




    <style>

        .hero {
            height:650px;
            background: url('assets/images/hero-try.png') no-repeat center center/cover;
            color: #D9D9D9;
            text-align: right;
            padding: 50px 20px;
            display:flex;
            align-items:center;
            justify-content:flex-end;
            
            
        }

        .contents{
            width:40rem;
        }
        

        .hero h1{
            font-size: 72px;
            font-weight:bold;
        }

        .hero p{
            font-size: 18px;
            font-weight:500;
        }

        .contents .button{
            font-size: 20px;
            width:10rem;
            color:black;
            border: none;
            width: fit-content
            
        }
        

    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
        
    <!-- Hero Section -->
    <section class="hero">
        <!-- <img src="assets/images/hero.jpg" alt="hero"> -->
        <div class="contents">
            <h1>Books for Every Story Seeker</h1>
            <p>From timeless classics to today's bestsellers, find it all in one place</p>
            <a href="pages/books.php" class="button btn btn-primary">Explore Books</a>

        </div>
    </section>

    <!-- Featured Books -->
    <?php include 'includes/featured_books.php'; ?>

    <!-- Categories -->
    <?php include 'includes/categories.php'; ?>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
