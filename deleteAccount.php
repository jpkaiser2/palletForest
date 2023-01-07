<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #f7f7f7;
    }

    div.content {
      margin-left: 20px;
      padding: 1px 16px;
    }

    .plus {
      background: -webkit-linear-gradient(180deg, #35B890 0%, #243E36 100%);
      background-clip: border-box;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .plus2 {
      background: #EFEFEF;
      border-radius: 65px;
      text-decoration: none;
      color: #243E36;
      padding: 10px;
    }

    .welcomeMsg {
      color: #243E36;
    }

    .button {
      background-color: #e83e19;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 10px;
    }

    .editBtn {
      border: none;
      text-decoration: none;
      cursor: pointer;
      border-radius: 10px;
      padding: 2%;
      color: #243E36;
    }

    hr {
      color: #243E36;
      border: 1px solid #243E36;
      border-radius: 5px;
    }

    .color {
      color: #243E36;
    }

    .card {
      transition: 0.3s;
      width: 30%;
      padding: 2%;
      background: #F1F1F1;
      border-radius: 38px;
      color: #243E36;
    }

    .card:hover {
      background-color: white
    }

    .container {
      padding: 2px 16px;
      display: flex;
      gap: 5px;
    }

    @media (max-width: 800px) {
      .container {
        flex-direction: column;
      }
    }

    .btn-grad-green {
      background-image: linear-gradient(to right, #145a32 0%, #27ae60 51%, #145a32 100%);
      margin: 10px;
      padding: 10px 10px;
      text-align: center;
      transition: 0.5s;
      background-size: 200% auto;
      color: white;
      box-shadow: 0 0 20px #eee;
      border-radius: 10px;
      display: block;
      border: none;
      width: fit-content;
      text-decoration: none;
    }

    .btn-grad-green:hover {
      background-position: right center;
      color: #fff;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <?php require('menu.php'); 
  if($_POST['account'] != null){
    $toname = $_SESSION["username"];
    $emailfrom = 'account_deletion@palletforest.com';
    $fromname = 'Account Deletion Alerter';
    $subject = 'ACCOUNT TO DELETE';
    $emailto = 'support@palletforest.com';
    $messagebody = "
    <html>
    <body>
    <p>User: ".$toname."</p>
    <br>
    </body>
    </html>
    ";
    $headers = 
        'Return-Path: ' . $emailfrom . "\r\n" . 
        'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 
        'X-Priority: 3' . "\r\n" . 
        'X-Mailer: PHP ' . phpversion() .  "\r\n" . 
        'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" . 
        'Content-Transfer-Encoding: 8bit' . "\r\n" . 
        'Content-Type: text/html; charset=UTF-8' . "\r\n";
    $params = '-f ' . $emailfrom;
    $test = mail($emailto, $subject, $messagebody, $headers, $params);
    // $test should be TRUE if the mail function is called correctly
    if($test === true){
      echo "<div class='content' id='content'>
      <h2>Account Deletion Requested</h2>
      <p>Your account will be reviewed and deleted within 24 hours.</p>
      ";
    }
  }
  else{
    echo "<div class='content' id='content'>
    <form action='deleteAccount.php' method='post'>
      <input type='hidden' value='".$_SESSION['username']."' name='account'>
      <h2 class='color'>Are you sure that you want to delete your account?</h2>
      <p>Your account will be terminated within 24 hours and all data will be distroyed. This is unreversible.</p>
      <button class='button' type='submit'>Delete Account</button>
  </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </div>";
  }
  ?>


  
  <br>
  <?php require('footer.php'); ?>

</body>

</html>