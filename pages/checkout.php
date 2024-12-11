<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$stmt = $conn->prepare("
    SELECT c.product_id, c.quantity, b.title, b.price, b.image_url
    FROM cart c
    JOIN books b ON c.product_id = b.id
    WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

$total_price = 0;
while ($row = $cart_items->fetch_assoc()) {
    $total_price += $row['price'] * $row['quantity'];
}
?>

<h2>Checkout</h2>
<h3>Order Summary</h3>
<table>
    <tr>
        <th>Title</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Subtotal</th>
    </tr>
    <?php
    $cart_items->data_seek(0); // Reset the result set pointer
    while ($row = $cart_items->fetch_assoc()):
        $subtotal = $row['price'] * $row['quantity'];
    ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>$<?php echo $row['price']; ?></td>
            <td>$<?php echo $subtotal; ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<h3>Total: $<?php echo $total_price; ?></h3>

<form method="post" action="checkout.php">
    <label for="address">Shipping Address:</label>
    <textarea name="address" id="address" required></textarea>
    <button type="submit" name="checkout">Place Order</button>
</form>


<?php
if (isset($_POST['checkout'])) {
    $address = $_POST['address'];

    // Insert order into orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, address) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $user_id, $total_price, $address);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items into order_items table
    $cart_items->data_seek(0); // Reset result set pointer
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)");
    while ($row = $cart_items->fetch_assoc()) {
        $stmt->bind_param("iiid", $order_id, $row['product_id'], $row['quantity'], $row['price']);
        $stmt->execute();
    }

    // Update the inventory for each book in the cart
    $cart_items->data_seek(0); // Reset the result set pointer
    $update_stock_stmt = $conn->prepare("UPDATE books SET stock = stock - ? WHERE id = ?");

    while ($row = $cart_items->fetch_assoc()) {
        $quantity_purchased = $row['quantity'];
        $product_id = $row['product_id'];

        // Check if the stock is sufficient before updating (Optional but recommended)
        $check_stock_stmt = $conn->prepare("SELECT stock FROM books WHERE id = ?");
        $check_stock_stmt->bind_param("i", $product_id);
        $check_stock_stmt->execute();
        $stock_result = $check_stock_stmt->get_result();
        $stock = $stock_result->fetch_assoc()['stock'];

        if ($stock >= $quantity_purchased) {
            // Deduct the purchased quantity from the available stock
            $update_stock_stmt->bind_param("ii", $quantity_purchased, $product_id);
            $update_stock_stmt->execute();
        } else {
            // Handle cases where the stock is insufficient (Optional)
            echo "Error: Not enough stock for product ID " . $product_id;
            exit;
        }
    }

    // Clear the user's cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Redirect to a success page
    header('Location: order_success.php');
    exit;
}
?>