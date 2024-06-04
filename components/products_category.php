<?php
require_once 'connect.php';

if(isset($_GET['category'])) {
    $category = $_GET['category'];
    $response = [];

    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        while($fetch_products = $result->fetch_assoc()){
            $response[] = $fetch_products;
        }
    } else {
        $response['empty'] = 'non ci sono prodotti per questa categoria!';
    }
    $conn->close();
    echo json_encode($response);
}
?>