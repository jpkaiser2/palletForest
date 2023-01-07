<html>
<title>Edit Listing | PalletForest</title>
<body>
    <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>

    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="listings.php">Listings</a></li>
        <li style="float:right"><a href="account.html"><i class="fa-solid fa-user"></i></i></a></li>
    </ul>

    <div class="topBox">
        <h1 class="xxl">Edit Listing</h1>
    </div>
    <br>
    <form action="deleteListing.php" method="post">
      <input readonly type="hidden" name="id" class="" value="<?php echo htmlspecialchars($_POST["id"]);?>">
      <div class="centerDiv"><button class="button2" onclick="deleteListing()">Delete Listing</button></div>
    </form>
    <br>
    <div class="centerDiv">
      <form class="formDiv" action="editAction.php" method="post">
          <input readonly type="hidden" name="id" class="" value="<?php echo htmlspecialchars($_POST["id"]);?>">
          <label for="title">Title</label>
          <input type="text" name="title" value="<?php echo htmlspecialchars($_POST["title"]);?>">

          <label for="description">Description</label>
          <input type="text" name="description" value="<?php echo htmlspecialchars($_POST["description"]);?>">

          <label for="zip">Zip Code</label>
          <input type="text" name="zip" value="<?php echo htmlspecialchars($_POST["zip"]);?>">
          <input type="submit" class="submitBtn" value="Update Listing">
      </form>

</body>
</html>

<?php
    session_start();
    $id = $_GET["id"];
    $title = $_GET["title"];
    $description = $_GET["description"];
    $zip = $_GET["zip"];
    $usrName = $_SESSION["username"];

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
    textarea, select {
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
      align-items:center;
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
    .button2 {
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
    
    </style>