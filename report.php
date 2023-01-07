<script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	require('menu.php');
	$message = $_POST['id'];
?>

<div class="content">
	<h1>Report a Message</h1>
	<p>--info about reporting goes here--</p>
	<form action="reportAction.php" method="post">
		<input type="hidden" value="<?php echo $message;?>" name="id">
		<p>Your first and last name:</p>
		<input type="text" placeholder="Your Name" name="name" required>
		<br>
		<p>Your email:</p>
		<input type="text" placeholder="you@example.com" name="email" required>
		<br>
		<p>Describe the situation and why you are reporting</p>
		<input type="text" placeholder="text text text..." name="msg" required>
		<br>
		<button class="btn-grad-yellow" type="submit" alt="report">Submit</button>
	</form>
</div>



<style>
	body{
    	font-family: 'Nunito', sans-serif;
    }
	.content{
		padding: 10;
	}
</style>