<?php
// Fetch categories
include $_SERVER['DOCUMENT_ROOT'] . '/bookstore/config/db.php';

?>


<header style="background-color:#2C3E50" class="text-white py-3 px-5">
  <div class="d-flex justify-content-between align-items-center">
    <h1>Online Bookstore</h1>
    <form method="GET" action="pages/books.php" class="d-flex" role="search">
        <input class="form-control me-2" name='search' type="search" placeholder="Search for books.." aria-label="Search">
       
      </form>
    <nav class="d-flex justify-content-between align-items-center gap-3">
      <a href="/bookstore/index.php" class="text-white text-decoration-none">Home</a>
      <a href="/bookstore/pages/aboutus.php" class="text-white text-decoration-none">About Us</a>
      <a href="/bookstore/index.php#categories" class="text-white text-decoration-none">Categories</a>
   
      <a href="/bookstore/pages/cart.php"><img src="/bookstore/assets/images/cart.png" alt="cart"></a>
      
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/bookstore/pages/logout.php" class="btn btn-danger">Log Out</a>
      <?php else: ?>
        <a href="/bookstore/pages/login.php" class="btn btn-primary">Log In</a>
      <?php endif; ?>

    </nav>
  </div>
</header>


