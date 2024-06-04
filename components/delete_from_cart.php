<?php
include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:../login.php');
};

if(isset($_POST['delete'])){
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->bind_param('i', $cart_id);
    $delete_cart_item->execute();
    $_SESSION['message'][] = 'Elemento eliminato dal carrello!';
 }

 if(isset($_POST['delete_all'])){
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->bind_param('i', $user_id);
    $delete_cart_item->execute();
    $_SESSION['message'][] = 'Carrello svuotato!';
 }

 if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $qty_n = intval($qty);
    if($qty > 0){
        $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
        $update_qty->bind_param('ii', $qty, $cart_id);
        $update_qty->execute();
        $_SESSION['message'][] = 'quantità aggiornata!';
    }else{
        $_SESSION['message'][] = 'la quantità non può essere inferiore di 1';
    }
 }

 $conn->close();
 header("location:../cart.php");

?>