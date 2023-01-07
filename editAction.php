
<?php
ob_start();
    session_start();
    //echo $_GET["name"];

    //echo($usrName);
    
    $servername = "50.87.221.65";
    $username = "skrappap_access";
    $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
    $dbname = "skrappap_palletforest";
   
    $usrName = $_SESSION["username"];
    $id = $_POST["id"];
    $title = $_POST["title"];
    $loc = $_POST["zip"];
    $description = $_POST["description"];

    //echo $description;
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
 
    $sql = "UPDATE `listings` SET `title`='$title', `loc`='$loc', `descr`='$description' WHERE `id`=$id";
    if ($conn->query($sql) === TRUE) {
      echo "Listing updated successfully";
    } else {
       echo "Error updating listing: " . $conn->error;
    }

    $conn->close();
    header("Location: /account.php");
    ob_end_flush();
?>

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