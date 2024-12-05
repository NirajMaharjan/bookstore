<?php
include '../config/db.php';

// Get the book ID from the URL
$bookId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the book's details from the database
$bookQuery = "SELECT * FROM books WHERE id = $bookId";
$bookResult = $conn->query($bookQuery);

// Check if the book exists
if ($bookResult && $bookResult->num_rows > 0) {
    $book = $bookResult->fetch_assoc();
} else {
    
    // Redirect to a 404 or show an error if the book is not found
    header('Location: 404.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> - Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-image {
            max-height: 400px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container my-5">
        <div class="row">
            <!-- Book Image -->
            <div class="col-md-5">
                <img src="/bookstore/<?php echo htmlspecialchars($book['image_url']); ?>" class="img-fluid book-image" alt="<?php echo htmlspecialchars($book['title']); ?>">
            </div>

            <!-- Book Details -->
            <div class="col-md-7">
                <h1><?php echo htmlspecialchars($book['title']); ?></h1>
                <h4 class="text-muted">by <?php echo htmlspecialchars($book['author']); ?></h4>
                <p class="text-secondary"><?php echo htmlspecialchars($book['description']); ?></p>
                <h3 class="text-success">$<?php echo number_format($book['price'], 2); ?></h3>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
