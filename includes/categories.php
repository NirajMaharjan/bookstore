<?php
include 'config/db.php';

// Fetch categories
$categoriesQuery = "SELECT * FROM categories";
$categories = $conn->query($categoriesQuery)->fetch_all(MYSQLI_ASSOC);
?>

<section class="container" id="categories">
    <h2 class="text-center mb-4">Browse by Category</h2>
    <div class="browse-container">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                
                    <div class="category-card">
                        <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                        <a href="/bookstore/pages/category.php?id=<?php echo $category['id']; ?>" class="btn btn-cta">Browse</a>
                    </div>
                
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No categories found.</p>
        <?php endif; ?>
    </div>
</section>
