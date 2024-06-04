<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
   header('Location: index.php');
   exit();
}

if(isset($_POST['submit'])){

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
  $select_user->execute([$email, $pass]);
  $result = $select_user->get_result();

  if($result->num_rows > 0){
     $row = $result->fetch_assoc();
     $_SESSION['user_id'] = $row['id'];
     header('Location: index.php');
     exit();
  } else {
     $message[] = 'Email o password sbagliata!';
  }

}

?>

<!DOCTYPE html>
<html lang="it">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="shortcut icon" href="images/favicon.png" >
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/register.css">

</head>
<body>
   

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post" id="loginForm">
      <h3>login</h3>
      <input type="email" name="email" required placeholder="inserisci la tua email" class="box" maxlength="50">
      <input type="password" name="pass" required placeholder="inserisci la tua password" class="box" maxlength="50">
      <input type="submit" value="login" name="submit" class="btn">
      <p>Non hai un account? <a href="register.php">registrati</a></p>
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

<script src="js/index.js" defer></script>
<script src="js/login.js" defer></script>
<script>
    const userId = "<?= htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') ?>";
</script>
</body>
</html>