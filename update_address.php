<?php
    require_once 'components/connect.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id='';
        header('Location:index.php');
    }

    if(isset($_POST['submit'])){

        $address = $_POST['indirizzo'] .', '.$_POST['num_civico'] .', '.$_POST['citta'].', '.$_POST['comune'].', '.$_POST['stato'] .', '. $_POST['codice_postale'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
     
        $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
        $update_address->bind_param("si", $address, $user_id);
        $update_address->execute();

        $_SESSION['message'][] = 'Indirizzo salvato';
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png" >
    <title>categoria</title>
    <!-- FONT IMPORT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

<?php require_once 'components/user_header.php'; ?>


<section class="form-container">

   <form action="" method="post">
      <h3>il tuo indirizzo</h3>
      <input type="text" class="box" placeholder="indirizzo" required maxlength="50" name="indirizzo">
      <input type="text" class="box" placeholder="numero civico" required maxlength="50" name="num_civico">
      <input type="text" class="box" placeholder="nome città" required maxlength="50" name="citta">
      <input type="text" class="box" placeholder="provincia" required maxlength="2" name="comune">
      <input type="text" class="box" placeholder="stato" required maxlength="50" name="stato">
      <input type="number" class="box" placeholder="codice postale" required max="999999" min="0" maxlength="6" name="codice_postale">
      <input type="submit" value="salva indirizzo" name="submit" class="btn">
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