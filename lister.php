<!DOCTYPE html>
<html>
<title>Create a Listing | PalletForest</title>
<body>
  <script src="https://kit.fontawesome.com/b514bb7a57.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php require('menu.php');?>

    <div class="topBox">
        <h1 class="xxl">Create a Listing</h1>
    </div>
    <br>
    <div class="centerDiv">
      <form class="formDiv" action="listAction.php" method="post" enctype="multipart/form-data">
      
          <label for="title">Title</label>
          <input type="text" id="title" name="title" placeholder="Pallet">

          <label for="description">Description</label>
          <input type="text" id="description" name="description" placeholder="Large pallet in good condition">

          <label for="zip">Zip Code</label>
          <input type="text" id="zip" name="location" placeholder="60601">
         

            Select an image to upload:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" class="submitBtn" value="Submit" name="submit">
          
      </form>

</body>
</html>


<style>
  .fileBtn{
    border: none;
  }
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
      background-image: linear-gradient(to right, #145a32  0%,  #27ae60   51%,  #145a32   100%);
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
        width: 100%;
        height: 10%;
        text-decoration: none;
        cursor: pointer;
    }
    .submitBtn:hover{
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }
    body{
        padding: 0; 
        margin: 0;
        font-family: 'Nunito', sans-serif;
        background-color: #f7f7f7;
    }
    
    .formDiv {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
      width: 33.4%;
    }
    
    .topBox{
        color: #243E36;
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
      font-size: x-large;
      width: 100%;
      background: #F1F1F1;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);

    }
    
    li {
      float: left;
    }
    
    li a {
      display: block;
      color: #243E36;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    
    li a:hover {
      background-color: white;
      color:#243E36;
    }
    
    </style>


