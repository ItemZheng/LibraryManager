<?php
    include 'CheckLogin.php';
    CheckLogin();
?>

<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Book Entry</title>  
    <link rel="stylesheet" type="text/css" href="Book_Entry.css"/>
</head>  
  
<body>
    <div id="Pic_Top_Frame">
        <div id = "TipLabel">

            <div class = "Sub_Fun_Frame">
                <a href="Admin_Manage.php">
                    <div class = "Fun_Back">
                        <img src = "Home.png" class = "Fun_Image_Part"></img>
                    </div>
                    <label class = "Fun_Des"> Home </label>
                </a>
            </div>

            <div class = "Sub_Fun_Frame">
                <a href="Book_Entry.php">
                    <div class = "Fun_Back">
                        <img src = "Book_Entry.png" class = "Fun_Image_Part"></img>
                    </div>
                    <label class = "Fun_Des"> Book Entry </label>
                </a>
            </div>

            <div class = "Sub_Fun_Frame">
                <a href="Book_Select.php">
                    <div class = "Fun_Back">
                        <img src = "Book_Select.png" class = "Fun_Image_Part"></img>
                    </div>
                    <label class = "Fun_Des">Search</label>
                </a>
            </div>

            <div class = "Sub_Fun_Frame">
                <a href="Book_Borrow.php">
                    <div class = "Fun_Back">
                        <img src = "Book_Borrow.png" class = "Fun_Image_Part"></img>
                    </div>  
                    <label class = "Fun_Des">Borrow</label>
                </a>                   
            </div>

            <div class = "Sub_Fun_Frame">
                <a href="Book_Return.php">
                    <div class = "Fun_Back">
                        <img src = "Book_Return.png" class = "Fun_Image_Part"></img>
                    </div>
                    <label class = "Fun_Des">Return</label>
                </a>
             </div>

            <div class = "Sub_Fun_Frame">
                <a href="Card_Delete.php">
                    <div class = "Fun_Back">
                        <img src = "Card_Delete.png" class = "Fun_Image_Part"></img>
                    </div>
                    <label class = "Fun_Des">Card Manage</label>
                </a>
            </div>

            <a href="LogOut.php" id = "LogOutLabel">
                <img id = "LogOut_Img" src = "Logo_Login.png">
                Log Out
                </img>
            </a>
            <label id = "LableDisply">
                Hello, <?php echo $_SESSION['username'] ?>
            </label>
        </div>
    </div> 
    <div id = "Frame">
        <label id = "Text_Display">
        Please enter the information of book
        ______________________________________________________
             
        </label>
        <form method="post" action = "Entry.php" id = "FormFrame">
            <div class = "Input_Block">
                <label class = "Input_Tip">Book No.</label><input name = "bno" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Category</label><input name = "category" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Title</label><input name = "bookName" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Press</label><input name = "press" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Year</label><input name = "year" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Author</label><input name = "author" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Price</label><input name = "price" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Number</label><input name = "number" class = "text_input" type = "text"></input>
            </div>
            <input type="submit" id="add_book"  name = "submit_book" value="Entry"></input>
        </form>
    </div>
    <div id = "Frame2">
        <label id = "File_UPload_Display"> 
            Please upload the excel file of books' information
            ______________________________________________________
        </label>
        <form method="post" action = "UploadFile.php" id = "Upload_Form" enctype = "multipart/form-data">
            <div class = "Input_Block">
                <label class = "Input_Tip">File: </label><input name = "file" class = "text_input" type = "file" value = "Choose File"></input>
            </div>
            <input type="submit" id="add_file"  name = "submit" value="Entry"></input>
        </form>
    </div>
</body> 

</html> 