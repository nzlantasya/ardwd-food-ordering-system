<?php 
include 'includes/db.php';
$order_id = $_GET['order_id'];
?>
<html>
<body style="background-color: #FFFDD0; text-align: center; font-family: sans-serif;">
    <h1 style="color: #8B0000;">Order Confirmed!</h1>
    <p>Your order ID is: #<?php echo $order_id; ?></p>
    <p>Status: <span style="color: green;">Processing...</span></p>
    
    <div style="border: 2px dashed #8B0000; display: inline-block; padding: 20px;">
        <h3>Wrong Address?</h3>
        <a href="edit_order.php?id=<?php echo $order_id; ?>" style="color: blue;">Edit My Delivery Details</a>
    </div>
</body>
</html>
