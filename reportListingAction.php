<script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	require('menu.php');
	$message = $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];

	$emailto = "support@palletforest.com";
    $emailfrom = 'internal_reports@palletforest.com';
    $fromname = 'PalletForest Reporting';
    $subject = 'New Listing Reported';
    $messagebody = "
    <html>
    <body>
    <p>Listing id: ".$message."</p>
    <br>
	<p>Reporter name: ".$name."</p>
	<br>
	<p>Reporter email: ".$email."</p>
	<br>
	<p> Message from reporter: ".$msg."</p>

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
?>
<div class="content">
	<h1>Your report has been sent.</h1>
	<p>You will recieve an email in the next 48 hours regarding your report.</p>
</div>

<style>
	body{
    	font-family: 'Nunito', sans-serif;
    }
	.content{
		padding: 10;
	}
</style>