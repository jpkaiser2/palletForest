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

    <?php 
    require('menu.php'); 
    $user = strval($_SESSION["username"]);
    $userGrammar = "";

    if(substr($user, -1) == "s" || substr($user, -1) == "S"){
        $userGrammar = $user."'";
    }
    else{
        $userGrammar = $user."'s";
    }
    echo"<h1>".$userGrammar." Messages"."</h1>"
    ?>
</head>
<body>
<form method="post" action="deleteMsgAction.php">      
<button  class="deleteBtn" type="submit" ><i class="fa-solid fa-trash-can"></i></button>
<table>
<tr class="noHover">
    <td></td>
    <td><b>Listing</b></td>
    <td><b>Most Recent Message</b></td>
</tr>

<?php
    $currMessage;
    $currMessage2;

    function getMessages()
    {
        global $user;
        global $currMessage;

                    
        $servername = "50.87.221.65";
        $username = "skrappap_access";
        $password = "eG+3!CQ853JCmaz@!^M2Zqy7Wj_+%P^Agbp?MpVkXu2ax&3TmeYpmMqp%suNJ8vyP8XQ3AeC!G%bHh#C3#%-Z4d";
        $conn = new mysqli($servername, $username, $password);

        if ($conn->connect_error) {

            //die("Connection failed: " . $conn->connect_error);
        }
        else{
            $retval = mysqli_select_db( $conn, 'skrappap_palletforest' );
            // echo "hi";
            if(! $retval ) {
              //die('Could not select database: ' . mysqli_error($conn));
            }
             // echo "hi";
            }

        $sql = "SELECT * FROM messages WHERE to_usr='$user' || from_usr='$user' AND reply=0";
        $result = mysqli_query($conn, $sql);
        if ($conn->query($sql) == TRUE) {
          while($row = mysqli_fetch_assoc($result)) {
                $listing = $row["listing"];
                $sql = "SELECT * FROM listings WHERE id='$listing'";
                $result2 = mysqli_query($conn, $sql);
                if ($conn->query($sql) == TRUE) {
                    while($row2 = mysqli_fetch_assoc($result2)) {
                        $listing = $row2["title"];
                        $currMessage = $currMessage . '
                        <tr>
                        <td><input type="checkbox" name="checked[]"  value="'.$row["id"].'" id="'.$row["id"].'"></td>
                        <td onclick="openMsg('.$row["id"].')">'.$listing.'</td>
                        <td onclick="openMsg('.$row["id"].')">'."".'</td>
                        </tr>
                        ';
                    }
                }
                
                
                
                
              }
        
        
        } 
        else{
            echo "You have no messages";
          //echo "Error creating database: " . $conn->error;
        }
        
        $conn->close();
        echo($currMessage);
        
    }


    getMessages();





?>
</table>
</form>
</body>
</html>

<script>

    function openMsg(id){
        var url = "messageViewer.php?m=" + id;
        window.open(url, "_self");
    }


</script>

<style>
body{
    font-family: 'Nunito', sans-serif;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  border: 1px solid #f7f7f7;
  background-color: #f7f7f7;
}
.deleteBtn{
    border: none;
    background-color: transparent;
}
.deleteBtn:hover{
    border: none;
    color: red;
    background-color: transparent;
}
tr:hover{
    background-color: #e3e3e3;
}
tr:nth-child(even):hover{
    border: 1px solid #e3e3e3;
    background-color: #e3e3e3;
}
.noHover:hover{
    background-color:white;
}
</style>