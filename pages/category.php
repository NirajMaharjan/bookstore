<?php
session_start();
include '../config/db.php'; // Include your database connection

// Check if a category ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php'); // Redirect to home if no category ID is provided
    exit;
}

$categoryId = (int) $_GET['id']; // Sanitize the category ID

// Fetch the category details
$categoryQuery = "SELECT * FROM categories WHERE id = $categoryId";
$categoryResult = $conn->query($categoryQuery);

if ($categoryResult->num_rows == 0) {
    // Redirect if the category doesn't exist
    header('Location: index.php');
    exit;
}

$category = $categoryResult->fetch_assoc();

// Fetch books in the selected category
$booksQuery = "SELECT * FROM books WHERE category_id = $categoryId";
$booksResult = $conn->query($booksQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category['name']); ?> Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container my-5">
        <h1><?php echo htmlspecialchars($category['name']); ?></h1>
       

        <?php if ($booksResult->num_rows > 0): ?>
            <div class="row">
                <?php while ($book = $booksResult->fetch_assoc()): ?>
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <img src="/bookstore/<?php echo htmlspecialchars($book['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($book['author']); ?></p>
                                <a href="book.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No books found in this category.</p>
        <?php endif; ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
