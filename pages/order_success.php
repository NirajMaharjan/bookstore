<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}
?>



<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category['name']); ?> Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .success-section{
            background-color: #f0f0f0;
            padding: 20px;
            width: 30rem;
            display: flex;
            flex-direction: column;
            margin: auto;
        }
        a{
            
            align-self: flex-end;
            text-decoration: none;
            color: black;
            padding: 4px 8px;
            border-radius: 4px;

        }
    </style>
</head>

<body>

<div class="success-section">

    <h2>Thank You!</h2>
    <p>Your order has been placed successfully.</p>
    <a class="btn-primary" href="/bookstore/index.php">Go back to Home</a>
</div>
    

    </body>
</html>

<!-- Modal -->
