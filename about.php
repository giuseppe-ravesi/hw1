<?php
    require_once 'components/connect.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id='';
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chi siamo</title>
    <link rel="shortcut icon" href="images/favicon.png" >
    <!-- FONT IMPORT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/about.css">
</head>
<body>

<?php require_once 'components/user_header.php'?>


<div class="heading">
    <h3>chi siamo</h3>
    <p><a href="index.php">home</a><span> / chi siamo</span></p>
</div>

<section class="about">

    <div class="row">

        <div class="image">
            <img src="images/about-img.svg">
        </div>

        <div class="content">
            <h3>perché sceglierci?</h3>
            <p>
                Siamo un team di professionisti dedicati con anni di esperienza nel settore della ristorazione. La
                nostra
                passione per
                il cibo di alta qualità e il servizio eccellente ci spinge a migliorare costantemente per soddisfare le
                aspettative dei
                nostri clienti.
            </p>
            <a href="menu.php" class="btn">il nostro menu</a>
        </div>
</section>

<section class="steps">

    <h1 class="title">semplici passaggi</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/step-1.png">
            <h3>scegli un ordine</h3>
            <p>
                Ordina online in pochi semplici passi e ricevi i tuoi piatti 
                preferiti direttamente a casa tua, freschi e pronti da gustare.
            </p>
        </div>

        <div class="box">
            <img src="images/step-2.png">
            <h3>consegna rapida</h3>
            <p>
                Approfitta della spedizione rapida per ordini freschi e di qualità fino a casa tua in tempi record.
            </p>
        </div>

        <div class="box">
            <img src="images/step-3.png">
            <h3>buon appetito</h3>
            <p>Buon appetito! Goditi i nostri piatti deliziosi, preparati con ingredienti freschi e tanta passione.</p>
        </div>
    </div>

</section>

<section class="reviews">
    
    <h1 class="title">codice sconto</h1>
    <p class="subtitle">ottenibile dopo aver effettuato il tuo primo ordine e usufruibile sui seguenti articoli</p>

    <div class="swiper reviews-slider">

        <div class="swiper-wrapper" id="reviews-container">

        </div>
        <div class="swiper-pagination"></div>
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
<script src="js/about.js" defer></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
    const userId = "<?= htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') ?>";
</script>
</body>
</html>