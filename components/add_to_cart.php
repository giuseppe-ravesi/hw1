<?php
require_once 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id='';
    $_SESSION['message'] = "Devi loggarti prima!";
    header("location: ../login.php");
    exit();
}


if(isset($_POST['add_to_cart'])){

    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $image = $_POST['image'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->bind_param('si', $name, $user_id);
    $check_cart_numbers->execute();
    $result = $check_cart_numbers->get_result();


    if($result->num_rows > 0){
        $_SESSION['message'][] = 'elemento già nel carrello';
    }else{
        $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
        $insert_cart->bind_param('iissis', $user_id, $pid, $name, $price, $qty, $image);
        $insert_cart->execute();
        $_SESSION['message'][] = 'Aggiunto al carrello!';
    }

    $check_cart_numbers->close();
    $insert_cart->close();
    header("location: ../cart.php");

   }

?>