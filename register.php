<?php
    require_once 'components/connect.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id='';
    }

    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = $_POST['cpass'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
     
        if (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass) || !preg_match('/[^a-zA-Z\d]/', $pass)) {
           $message[] = 'La password deve contenere almeno una lettera maiuscola, un numero, un carattere speciale e deve essere di almeno 8 caratteri.';
        } else if($pass != $cpass){
           $message[] = 'La password non corrisponde!';
        } else {
           $pass = sha1($pass);
           $cpass = sha1($cpass);
     
           $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? OR number = ?");
           $select_user->bind_param("ss", $email, $number);
           $select_user->execute();
           $result = $select_user->get_result();
     
           if($result->num_rows > 0){
              $message[] = 'Email o il numero inserito esiste già!';
           } else {
              $insert_user = $conn->prepare("INSERT INTO users(name, email, number, password) VALUES (?, ?, ?, ?)");
              $insert_user->bind_param("ssss", $name, $email, $number, $pass);
              $insert_user->execute();
     
              $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
              $select_user->bind_param("ss", $email, $pass);
              $select_user->execute();
              $result = $select_user->get_result();
              $row = $result->fetch_assoc();
     
              if($result->num_rows > 0){
                 $_SESSION['user_id'] = $row['id'];
                 header('location:index.php');
              }
           }
        }
     }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png" >
    <title>registrati</title>
    <!-- FONT IMPORT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

<?php require_once 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post" id="registerForm">
      <h3>Registrati</h3>
      <input type="text" name="name"  placeholder="inserisci il tuo nome" class="box" maxlength="50">
      <div class="error" id="nameError"></div>
      <input type="email" name="email"  placeholder="inserisci la tua email" class="box" maxlength="50">
      <div class="error" id="emailError"></div>
      <input type="number" name="number"  placeholder="inserisci il tuo numero" class="box" min="0" max="9999999999" maxlength="10">
      <div class="error" id="numberError"></div>
      <input type="password" name="pass"  placeholder="inserisci la tua password" class="box" maxlength="50">
      <div class="error" id="passError"></div>
      <input type="password" name="cpass"  placeholder="conferma password" class="box" maxlength="50">
      <div class="error" id="cpassError"></div>
      <input type="submit" value="registrati" name="submit" class="btn">
      <p>hai già un account? <a href="login.php">login</a></p>
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
<script src="js/register.js" defer></script>
<script>
    const userId = "<?= htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8') ?>";
</script>
</body>
</html>