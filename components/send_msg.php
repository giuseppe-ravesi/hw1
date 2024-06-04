<?php

include 'connect.php';
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id='';
    $_SESSION['message'][] = "Devi effettuare il login";
    header('location:index.php');
}

if (isset($_POST['invio'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

    // Verifica se i campi sono vuoti
    if (empty($name) || empty($email) || empty($number) || empty($msg)) {
        $_SESSION['message'][] = 'Tutti i campi sono richiesti!';
    } else {       
        // Preparazione della query di inserimento
        $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
        $insert_message->bind_param("issss", $user_id, $name, $email, $number, $msg);
        if ($insert_message->execute()) {
            $_SESSION['message'][] = 'Messaggio inviato!';
        } else {
            $_SESSION['message'][] = 'Invio Fallito!';
        }
    }

    header('location: ../contatta.php');
}
?>
