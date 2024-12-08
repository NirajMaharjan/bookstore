<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $action = $_POST['action'];

    if ($action === 'add') {
        // Add item to cart
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity)
            VALUES (?, ?, 1) 
            ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    } elseif ($action === 'update') {
        // Update item quantity
        $quantity = intval($_POST['quantity']);
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);
        $stmt->execute();
    } elseif ($action === 'remove') {
        // Remove item from cart
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    }
    header('Location: cart.php'); // Refresh the cart page
    exit;
}




$stmt = $conn->prepare("
    SELECT c.product_id, c.quantity, b.title, b.price, b.image_url
    FROM cart c
    JOIN books b ON c.product_id = b.id
    WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Your Cart</h2>
<table>
    <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Actions</th>
    </tr>
    <?php
    $total = 0;
    while ($row = $result->fetch_assoc()):
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
    ?>
    <tr>
        <td><img src="../<?php echo $row['image_url']; ?>" width="50"></td>
        <td><?php echo $row['title']; ?></td>
        <td>Rs <?php echo $row['price']; ?></td>
        <td>
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="action" value="update">
                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                <button type="submit">Update</button>
            </form>
        </td>
        <td>Rs <?php echo $subtotal; ?></td>
        <td>
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="action" value="remove">
                <button type="submit">Remove</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<h3>Total: Rs <?php echo $total; ?></h3>
