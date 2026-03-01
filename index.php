<?php
include 'db.php';
$menu_sql = "SELECT * FROM food_items";
$menu_result=$conn->query($menu_sql);

$cart_sql = "SELECT cart.order_id, food_items.food_id, food_items.name, food_items.price, cart.quantity, cart.subtotal FROM cart JOIN food_items ON cart.food_id = food_items.food_id";
$cart_result=$conn->query($cart_sql);



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
        <table border="1" cellpadding="10" cellspacing="0">
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
        <table border="1" cellpadding="10" cellspacing="0">
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
        </table>
        </div>  
</body>
</html>
