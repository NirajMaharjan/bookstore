<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}
?>

<h2>Thank You!</h2>
<p>Your order has been placed successfully.</p>
<a href="/bookstore/index.php">Go back to Home</a>
