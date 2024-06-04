<?php
    require_once 'components/connect.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id='';
        $_SESSION['message'][] = "Devi effettuare il login";
        header('location:index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png" >
    <title>contattaci</title>
    <!-- FONT IMPORT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/contatta.css">
</head>
<body>

<?php require_once 'components/user_header.php' ?>

<div class="heading">
    <h3>contattaci</h3>
    <p><a href="index.html">home</a><span> / contattaci</span></p>
</div>


<section class="contact">

    <div class="row">

        <div class="image">
            <img src="images/contact-img.svg">
        </div>

        <form action="components/send_msg.php" method="post">
            <h3>parla con noi!</h3>
            <input type="text" name="name" maxlength="50" class="box" 
            placeholder="Inserisci il tuo nome" required>
            <input type="number" name="number" min="0" maxlength="9999999999" class="box" 
            placeholder="Inserisci il tuo telefono" required>
            <input type="email" name="email" maxlength="50" class="box" 
            placeholder="Inserisci la tua email" required>
            <textarea name="msg" class="box" required placeholder="Inserisci il tuo messaggio" 
            maxlength="500" cols="30" rows="10"></textarea>
            <input type="submit" value="invia" class="btn" name="invio">
        </form>
    </div>

</section>

<!--Footer inizio-->
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

<script src="js/index.js" defer></script>
<script>
    const userId = "<?= htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') ?>";
</script>
</body>
</html>