<?php
include 'db.php';
$id = $_GET['id'];

$sql = "DELETE FROM cart WHERE order_id=$id";
if($conn->query($sql)){
    header("Location: index.php");
    exit();
}else{
    echo "Error: " .$conn->error;
}
?>