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
    <title>home</title>
    <link rel="shortcut icon" href="images/favicon.png" >
    <!--swiper import-->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- FONT IMPORT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php require_once 'components/user_header.php'; ?>

<section class="hero">

    <div class="swiper hero-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="content">
                    <span>ordina online</span>
                    <h3>la nostra pizza</h3>
                    <a href="menu.php" class="btn">vedi menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-1.png" alt="pizza">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>ordina online</span>
                    <h3>double hamburgher</h3>
                    <a href="menu.php" class="btn">vedi menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-2.png" alt="hamburgher">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>ordina online</span>
                    <h3>pollo grigliato</h3>
                    <a href="menu.php" class="btn">vedi menu</a>
                </div>
                <div class="image">
                    <img src="images/home-img-3.png" alt="pollo">
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<section class="category">

    <h1 class="title">articoli per categoria</h1>

    <div class="box-container">

        <a href="category.php?category=fast food" class="box">
            <img src="images/cat-1.png">
            <h3>fast food</h3>
        </a> 
        <a href="category.php?category=primo" class="box">
            <img src="images/cat-2.png">
            <h3>primi piatti</h3>
        </a>

        <a href="category.php?category=bevanda" class="box">
            <img src="images/cat-3.png">
            <h3>bevande</h3>
        </a>

        <a href="category.php?category=dolce" class="box">
            <img src="images/cat-4.png">
            <h3>dolci</h3>
        </a>

    </div>

</section>


<section class="products">
    <h1 class="title">ultimi piatti</h1>

    <div class="box-container" id="products-container">
    </div>

    <div class="more-btn">
        <a href="menu.php" class="btn">vedi tutto</a>
    </div>
    
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

<script src="js/index.js" defer></script>
<script src="js/last_products.js" defer></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
    const userId = "<?= htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') ?>";
</script>
</body>
</html>