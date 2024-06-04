<?php
require_once 'connect.php';

$response = [];

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'get_cart_count') {
        $user_id = $_POST['user_id'];
        $stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
        $total_cart_items = $stmt->num_rows;
        $stmt->close();

        $response['cart_count'] = $total_cart_items;
    }else{
        $response['cart_count'] = 0;
    }

    if ($action === 'get_user_profile') {
        $user_id = $_POST['user_id'];
        $stmt = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        $stmt->close();

        $response['user_profile'] = $user_data;
    }else{
         $response['user_profile'] = null;
    }
}
$conn->close();
echo json_encode($response);
?>