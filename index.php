<?php
include 'db.php';
$menu_sql = "SELECT * FROM food_items";
$menu_result=$conn->query($menu_sql);

$cart_sql = "SELECT cart.order_id, food_items.food_id, food_items.name, food_items.price, cart.quantity, cart.subtotal FROM cart JOIN food_items ON cart.food_id = food_items.food_id";
$cart_result=$conn->query($cart_sql);

$total_sql = "SELECT SUM(cart.subtotal) AS grand_total FROM cart";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$grand_total = $total_row['grand_total'] ?? 0;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurent Ordering System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu-section">
        <h2>🍴 Menu</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <?php while($row = $menu_result->fetch_assoc()): ?>
            <tr>
                <form action="add.php" method="POST">
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['category']?></td>
                    <td><?php echo $row['price']?></td>
                    <input type="hidden" name="food_id" value="<?php echo $row['food_id']; ?>">
                    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                    <td><input type="number" name="quantity" value="1" min="1"></td>
                    <td><button type="submit" name="add_to_cart" class="btn_add">Add</botton></td>
                </form>
            </tr>
            <?php endwhile; ?>
        </table>
        </div>
    <div class="cart-section">
        <h2>🛒 Your Cart</h2>
        <table >
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>subtotal</th>
                <th>Action</th>
            </tr>
            <?php while($row = $cart_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']?></td>
                <td><input type="number" name="quantity" value="<?php echo $row['quantity']; ?>"></td>
                <td><?php echo $row['subtotal']?></td>
                <td><a href="delete.php?id=<?php echo $row['order_id']; ?>" style="background-color: #ff4757; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 12px;" onclick="return confirm('Remove this item?');">Remove</a></td>
            <?php endwhile; ?>
            <tr class="total-row">
                <td colspan="2"><strong>Grand Total</strong></td>
                <td class="total-price">Rs. <?php echo number_format($grand_total, 2); ?></td>
                <td></td>
            </tr>
        </table>
        <button class="btn-checkout" onclick="alert('Proceeding to checkout!')">
            ✓ Checkout
        </button>
    </div>  
</body>
</html>
