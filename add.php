<?php
include 'db.php';

if(isset($_POST['add_to_cart'])) {
    $food_id = isset($_POST['food_id']) ? $_POST['food_id'] : null;
    $qty = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
    $price = $_POST['price'];isset($_POST['price']) ? $_POST['price'] : 0;
    $subtotal = $price * $qty;

    $sql = "INSERT INTO cart (food_id, quantity, subtotal) VALUES ('$food_id', '$qty', '$subtotal')";
    if($conn->query($sql)){
        header("Location: index.php");
        exit();
    }else{
        echo "Error: " . $conn->error;
    }
}
?>

