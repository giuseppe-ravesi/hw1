<?php
require_once 'connect.php';
$query = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
$result = $conn->query($query);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($products);
?>