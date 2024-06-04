<?php
    require_once 'components/connect.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id='';
        $_SESSION['message'][] = "Devi effettuare il login";
        header('Location:index.php');
        exit();
    }

    $select_user= $conn->prepare("SELECT * FROM users WHERE id= ?");
    $select_user->bind_param('i', $user_id);
    $select_user->execute();
    $result= $select_user->get_result();

    if($result->num_rows > 0){
        $fetch_profile = $result->fetch_assoc();
    }

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png" >
    <title>profilo</title>
    <!-- FONT IMPORT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

<?php require_once "components/user_header.php"?>


<section class="user-details">

<div class="user">

      <img src="images/user-icon.png" alt="">
      <p><i class="fas fa-user"></i><span><span><?php echo $fetch_profile['name']?></span></span></p>
      <p><i class="fas fa-phone"></i><span><?php echo $fetch_profile['number']?></span></p>
      <p><i class="fas fa-envelope"></i><span><?php echo $fetch_profile['email']?></span></p>
      <p class="address"><i class="fas fa-map-marker-alt"></i>
      <span>
        <?php 
             if($fetch_profile['address'] == ''){
                echo 'inserisci il tuo indirizzo';
                }else{
                    echo $fetch_profile['address'];
                    } ?></span></p>
      <a href="update_address.php" class="btn">modifica indirizzo</a>
   </div>

    </form>
</section>


<footer class="footer">

    <section class="grid">

        <div class="box">
            <img src="images/email-icon.png">
            <h3>La nostra Email</h3>
            <a href="mailto:giuseppe.ravesi@studium.unict.it">giuseppe.ravesi@studium.unict.it</a>
            <a href="mailto:giuseppe.ravesi@outlook.it">giuseppe.ravesi@outlook.it</a>
        </div>

        <div class="box">
            <img src="images/clock-icon.png">
            <h3>Orario di apertura</h3>
            <p>19:30 - 01:00</p>
        </div>

        <div class="box">
            <img src="images/map-icon.png">
            <h3>Indirizzo</h3>
            <a href="#"> Via S. Sofia, 64, 95125 Catania CT</a>
        </div>

        <div class="box">
            <img src="images/phone-icon.png">
            <h3>Telefono</h3>
            <a href="tel:1234567890"> 123-456-7890</a>
            <a href="tel:1111222200"> 111-112-2200</a>
        </div>
    </section>

    <div class="credit">© 2024 - Tutti i diritti riservati | creato da <span>Giuseppe Ravesi</span></div>
</footer>
<script>
    const userId = "<?= htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') ?>";
</script>
<script src="js/index.js" defer></script>
</body>
</html>