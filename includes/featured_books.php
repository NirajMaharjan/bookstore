<?php
include 'config/db.php';

// Fetch featured books
$featuredQuery = "SELECT * FROM books ORDER BY created_at DESC LIMIT 5";
$featuredBooks = $conn->query($featuredQuery)->fetch_all(MYSQLI_ASSOC);
?>

<section class="container my-5">
    <h2 class="text-center mb-4">Featured Books</h2>
    <div class="row">
        <?php if (!empty($featuredBooks)): ?>
            <?php foreach ($featuredBooks as $book): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo $book['image_url']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                            <p class="card-text">$<?php echo number_format($book['price'], 2); ?></p>
                            <a href="/bookstore/pages/book.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No featured books available.</p>
        <?php endif; ?>
    </div>
</section>
