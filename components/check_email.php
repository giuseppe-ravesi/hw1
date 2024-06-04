<?php
header('Content-Type: application/json');

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    require_once 'connect.php';

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Email parameter missing']);
}
?>