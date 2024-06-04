<?php
//errore derivante dall'autenticazione
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
//errore di sessione se si accede a una pagina senza essersi loggato
if(isset($_SESSION['message'])){
    foreach($_SESSION['message'] as $msg){
       echo '
       <div class="message">
          <span>'.$msg.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
       </div>
       ';
    }
    unset($_SESSION['message']);
 }
?>

<header class="header">

    <section class="flex">

        <a href="index.php" class="logo">
            <img src="images/favicon.png" alt="Logo" class="logo-img">
            SAPORIAMO
        </a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="about.php">chi siamo</a>
            <a href="menu.php">menu</a>
            <a href="ordini.php">ordini</a>
            <a href="contatta.php">contattaci</a>
        </nav>

        <div class="icons">
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"><span>(0)</span></i></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <div class="profile">
            <p class="name">effettua il login</p>
            <a href="login.php" class="btn">login</a>
            <p class="account">
                <a href="register.php">registrati</a>
            </p>
        </div>

    </section>

</header>