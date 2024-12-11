<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .cart-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            object-fit: cover;
        }

        .cart-item .item-name {
            flex: 2;
            margin-left: 15px;
            font-size: 16px;
            color: #333;
        }

        .cart-item .item-price {
            flex: 1;
            text-align: center;
            font-size: 16px;
            color: #333;
        }

        .cart-item .cart-quantity {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-item .delete-icon {
            flex: 0.5;
            font-size: 20px;
            color: #E67E22;
            cursor: pointer;
            text-align: center;
        }

        .cart-item .delete-icon:hover {
            color: #cf681b;
        }

        .cart-quantity button {
            background-color: #E67E22;
            color: #fff;
            border: none;
            padding: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .cart-quantity button:hover {
            background-color: #cf681b;
        }

        .cart-quantity .quantity {
            width: 40px;
            text-align: center;
            border: none;
            font-size: 14px;
            outline: none;
        }

        .cart-quantity button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <div class="cart-item">
        <img src="https://via.placeholder.com/60" alt="Product Image">
        <div class="item-name">Product Name</div>
        <div class="item-price">$99.99</div>
        <div class="cart-quantity">
            <button onclick="changeQuantity(-1)">-</button>
            <input type="text" class="quantity" value="1" readonly>
            <button onclick="changeQuantity(1)">+</button>
        </div>
        <div class="delete-icon" onclick="removeItem(this)">&times;</div>
    </div>
</div>

<script>
    function changeQuantity(amount) {
        const quantityInput = event.target.parentNode.querySelector('.quantity');
        let currentQuantity = parseInt(quantityInput.value, 10);
        let newQuantity = currentQuantity + amount;
        if (newQuantity >= 1) {
            quantityInput.value = newQuantity;
        }
    }

    function removeItem(element) {
        const cartItem = element.closest('.cart-item');
        cartItem.remove();
    }
</script>

</body>
</html>
