<?php
include 'includes/db.php'; // Pastikan koneksi db sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $food = $_POST['food_item'];

    $query = "INSERT INTO orders (customer_name, phone, address, food_item) VALUES ('$name', '$phone', '$address', '$food')";
    
    if (mysqli_query($conn, $query)) {
        // Ambil ID pesanan terakhir untuk ditampilkan di halaman sukses
        $last_id = mysqli_insert_id($conn);
        header("Location: success.php?order_id=" . $last_id);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
