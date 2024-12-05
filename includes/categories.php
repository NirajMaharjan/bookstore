<?php
include 'config/db.php';

// Fetch categories
$categoriesQuery = "SELECT * FROM categories";
$categories = $conn->query($categoriesQuery)->fetch_all(MYSQLI_ASSOC);
?>

<section class="container my-5">
    <h2 class="text-center mb-4">Browse by Category</h2>
    <div class="row">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <div class="col-md-2">
                    <div class="category text-center p-3 border rounded">
                        <h5><?php echo htmlspecialchars($category['name']); ?></h5>
                        <a href="/bookstore/pages/category.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-outline-primary">Browse</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No categories found.</p>
        <?php endif; ?>
    </div>
</section>
