<?php
session_start();
ob_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
<?php

$usrName = strval($_SESSION['username']);
//echo $_SESSION["username"];
//echo $_GET["name"];
//echo($usrName);
$img = "";


function deleteListing(){
$servername = "50.87.221.65";
$username = "skrappap_access";
$password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
$dbname = "skrappap_palletforest";
global $usrName;

$id = $_POST["id"];
$img = "";
echo $id;
$conn = new mysqli($servername, $username, $password, $dbname);
$sql="SELECT * FROM listings WHERE id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $img = $row["img"];
  }
} 
else {
  echo "0 results";
}
unlink($img);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql="DELETE FROM listings
WHERE id = '$id'
AND author = '$usrName'";
echo $sql;
$result = $conn->query($sql);
if ($result == TRUE) {
  echo "Listing deleted successfully";
} else {
  echo "Error deleting listing: " . $result->error;
}

$conn->close();
header("Location: /account.php");
ob_end_flush();
};



deleteListing();

?>
<html>
<title>Deleting Listing...</title>
<h1>Deleting Listing...</h1>



<style>
    input[type=text], select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    
    .submitBtn {
      width: 100%;
      background-color: #243E36;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: larger;
    }
    body{
        padding: 0; 
        margin: 0;
    }
    
    .formDiv {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
      width: 33.4%;
    }
    
    .topBox{
        background-color: #243E36;
        color: white;
        padding: 10px;
        text-align: center;
    }
    .xxl{
        font-size: 80px;
    }
    .centerDiv{
        display: flex;
      justify-content: center;
      align-items: center;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #243E36;
      font-size: x-large;
    }
    
    li {
      float: left;
    }
    
    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    
    li a:hover {
      background-color: white;
      color:#243E36;
    }
    
    </style>