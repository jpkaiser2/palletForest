
<?php
ob_start();
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>
<?php
// Include config file
require "menu.php";
$servername = "50.87.221.65";
    $username = "skrappap_access";
    $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
    $dbname = "skrappap_palletforest";
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 } 
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
//$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['username']) != null) {
    //echo "rdfghjk\n";
  // receive all input values from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure a user does not already exist with the same username and/or email
  //echo "fgh\n";
$sql = "SELECT * FROM `users` WHERE username='$username' OR email='$email' LIMIT 1 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row["username"] === $username){
        array_push($errors, "Username already exists");
    }
    if($row["email"] === $email){
        array_push($errors, "Email already exists");
    }
  }
}
else{
    //echo "no duplicates";
}
//echo "fd\n";
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database
//echo "onion\n";
    $sql = "INSERT INTO `users`(`username`, `password`, `email`) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
    echo '"'.$username.'"'.' was registered successfully. ';
    echo "Please <a href='login.php'>Login</a>";
    } else {
    echo "error";
    }
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: account.php');
  }
}
ob_end_flush();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | PalletForest</title>
    <style>
        body{ 
            font-family: 'Nunito', sans-serif;
        }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form method="post" action="register.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
            </div>
            <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
            </div>
            <div class="input-group">
            <button type="submit" class="btn">Register</button>
            </div>
            <p>
                Already a member? <a href="login.php">Sign in</a>
            </p>
            <p>
                By registering, you agree to the <a href="terms.php">Terms of Use</a>
            </p>
    </form>
    </div>    
</body>
</html>