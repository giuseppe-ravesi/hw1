<?php
require_once 'connect.php';

if (isset($_POST['search_box'])) {
    $search_box = strtolower($_POST['search_box']);
    $search_terms = explode(' ', $search_box);
    $query = "SELECT * FROM `products` WHERE ";

    $conditions = [];
    foreach ($search_terms as $term) {
        $conditions[] = "name LIKE '%" . $conn->real_escape_string($term) . "%'";
    }
    $query .= implode(' AND ', $conditions);

    $result = $conn->query($query);

    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    echo json_encode($products);
}
?>
