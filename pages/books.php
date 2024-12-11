<?php
session_start();
include '../config/db.php';

// Set up pagination variables
$limit = 8; // Number of books per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;




//for search function

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);


    $booksQuery = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' LIMIT $limit OFFSET $offset";
    $books = $conn->query($booksQuery)->fetch_all(MYSQLI_ASSOC);


    // Fetch total number of books

    $totalBooks = count($books);
    $totalPages = ceil($totalBooks / $limit);

} else {
    // Fetch total number of books
    $totalBooksQuery = "SELECT COUNT(*) AS total FROM books";
    $totalBooksResult = $conn->query($totalBooksQuery);
    $totalBooks = $totalBooksResult->fetch_assoc()['total'];

    // Fetch books for the current page
    $booksQuery = "SELECT * FROM books LIMIT $limit OFFSET $offset";
    $books = $conn->query($booksQuery)->fetch_all(MYSQLI_ASSOC);

    // Calculate total pages
    $totalPages = ceil($totalBooks / $limit);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
 
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Book Catalog</h1>
        <div class="row gx-2">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="../<?php echo $book['image_url']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">

                            <div class="card-body">
                                <div class="details">
                                    <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                                    <p class="text-muted"><?php echo htmlspecialchars($book['author']); ?></p>
                                    <p class="card-text">Rs <?php echo number_format($book['price'], 2); ?></p>

                                </div>
                                
                                    <a href="book.php?id=<?php echo $book['id']; ?>" class="btn btn-cta">View Details</a>

                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No books available at the moment.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav>
            <?php if ($totalBooks>0): ?>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="books.php?page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="books.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="books.php?page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
        </nav>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>