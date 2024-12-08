<?php
// Fetch categories
include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/config/db.php';

$categoriesQuery = "SELECT * FROM categories";
$categoriesResult = $conn->query($categoriesQuery);

if (isset($_GET['search'])) {
  $search = $conn->real_escape_string($_GET['search']);
  $booksQuery = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' LIMIT $limit OFFSET $offset";
}

?>


<header style="background-color:#2C3E50" class="text-white p-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1>Online Bookstore</h1>
        <nav>
            <a href="/bookstore/index.php" class="text-white mx-2">Home</a>
            <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown button
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </div>
            <a href="cart.php" class="text-white mx-2">Cart</a>
            <a href=" pages/login.php" class="text-white mx-2">Login</a>
        </nav>
    </div>
</header>


<nav class="navbar navbar-expand-lg bg-body-tertiary container d-flex justify-content-between align-items-center">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Online Book Store</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/bookstore/index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form method="GET" action="pages/books.php" class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
  <!-- Categories Filter -->
<div class="container my-4">
    <form action="category.php" method="GET" class="d-flex">
        <select name="category" class="form-select me-2">
            <option value="">All Categories</option>
            <?php while ($category = $categoriesResult->fetch_assoc()): ?>
                <option value="<?php echo $category['id']; ?>">
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
   
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/bookstore/pages/logout.php" class="btn btn-danger">Logout</a>
    <?php else: ?>
        <a href="/bookstore/pages/login.php" class="btn btn-primary">Login</a>
    <?php endif; ?>

</div>
</nav>