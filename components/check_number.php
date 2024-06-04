<?php
header('Content-Type: application/json');

try {
    if (!isset($_GET['number'])) {
        throw new Exception('Number parameter missing');
    }

    $number = $_GET['number'];

    require_once 'connect.php';

    $stmt = $conn->prepare("SELECT id FROM users WHERE number = ?");
    if (!$stmt) {
        throw new Exception('Failed to prepare statement: ' . $conn->error);
    }

    $stmt->bind_param('s', $number);
    $stmt->execute();
    $stmt->store_result();

    $exists = $stmt->num_rows > 0;
    $stmt->close();
    $conn->close();

    echo json_encode(['exists' => $exists]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>