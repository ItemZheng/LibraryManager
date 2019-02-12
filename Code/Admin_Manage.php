<?php
    //Check login state
    include 'CheckLogin.php';
    CheckLogin();
?>

<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Manage</title>  
    <link rel="stylesheet" type="text/css" href="Manage.css"/>
</head>  
  
<body>
    <!-- id is for css file to recognize -->
    <div id="Pic_Top_Frame">  
        <p id = "TipLabel">
            <!--Log out lable and will turn to logout.php -->
            <a href="LogOut.php" id = "LogOutLabel">
                <img id = "LogOut_Img" src = "Logo_Login.png">
                Log Out
                </img>
            </a>
            <label id = "LableDisply">
                <!-- Welcome information -->
                Hello, <?php echo $_SESSION['username'] ?>
            </label>
        </p>
    </div>  

    <!--Class is for css and several elements is with this style-->
    <div id = "Function_Frame">
        <div class = "SubFun_Frame">
            <div class = "Fun_Back">
                <!-- a means turn to  if be clicked-->
                <a href="Book_Entry.php">
                    <img src = "Book_Entry.png" class = "Fun_Image_Part"></img>
                </a>
            </div>
            <p class = "Fun_Describe">Book Entry</p>
            <p class = "Fun_Detail">add book into library</p>
        </div>
        
        <div class = "SubFun_Frame">
            <div class = "Fun_Back">
                <a href="Book_Select.php">
                    <img src = "Book_Select.png" class = "Fun_Image_Part"></img>
                </a>
            </div>
            <p class = "Fun_Describe">Search</p>
            <p class = "Fun_Detail">search book you want</p>
        </div>

        <div class = "SubFun_Frame">
            <div class = "Fun_Back">
                <a href="Book_Borrow.php">
                    <img src = "Book_Borrow.png" class = "Fun_Image_Part"></img>
                </a>
            </div>                     
            <p class = "Fun_Describe">Borrow</p>
            <p class = "Fun_Detail">borrow book</p>
        </div>

        <div class = "SubFun_Frame">
            <div class = "Fun_Back">
                <a href="Book_Return.php">
                    <img src = "Book_Return.png" class = "Fun_Image_Part"></img>
                </a>
            </div>
            <p class = "Fun_Describe">Return</p>
            <p class = "Fun_Detail">return book</p>
        </div>

        <div class = "SubFun_Frame">
            <div class = "Fun_Back">
                <a href="Card_Delete.php">
                    <img src = "Card_Delete.png" class = "Fun_Image_Part"></img>
                </a>
            </div>
            <p class = "Fun_Describe">Card Manage</p>
            <p class = "Fun_Detail">add or delete a card</p>
        </div>

    </div>
</body> 
</html> 
