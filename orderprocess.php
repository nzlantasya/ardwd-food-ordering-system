<?php
$conn = mysqli_connect("localhost", "root", "", "ardwd_db");
if (!$conn) { die("Connection Failed: " . mysqli_connect_error()); }

$name  = $_POST['customer_name'];
$phone = $_POST['phone_number'];
$food  = $_POST['food_item'];
$addr  = $_POST['address'];

$sql = "INSERT INTO orders (customer_name, phone_number, food_item, address) VALUES ('$name', '$phone', '$food', '$addr')";

if(mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo "<div style='background:#0a0a0a; color:#d4af37; padding:50px; text-align:center; min-height:100vh; font-family:sans-serif;'>";
    echo "<h1>Order Confirmed!</h1>";
    echo "<p>Thank you, $name. Your order #$last_id is being prepared.</p>";
    echo "<a href='index.php' style='color:white;'>Back to Menu</a></div>";
}
?>
