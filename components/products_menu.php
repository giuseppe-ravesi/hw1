<?php
require_once 'connect.php';

$response = [];

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    while($fetch_products = $result->fetch_assoc()){
        $response[] = $fetch_products;
    }
} else {
    $response['empty'] = 'non ci sono prodotti nel database!';
}
$conn->close();
echo json_encode($response);

?>