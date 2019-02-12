<?php
    //Check login state
    include 'CheckLogin.php';
    CheckLogin();
?>


<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Search</title>  
    <link rel="stylesheet" type="text/css" href="Book_Select.css"/>
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
        Please enter the information for searching:
        ______________________________________________________
             
        </label>    
        <form method="post"  id = "FormFrame">
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
                <label class = "Input_Tip">Year Upper Bound</label><input name = "yearupper" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Year lower Bound</label><input name = "yearlower" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Author</label><input name = "author" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Price Upper Bound</label><input name = "priceupper" class = "text_input" type = "text"></input>
            </div>
            <div class = "Input_Block">
                <label class = "Input_Tip">Price lower Bound</label><input name = "pricelower" class = "text_input" type = "text"></input>
            </div>
            <input type="submit" id="submit_info"  name = "submit_info" value="search" />  
        </form>
    </div>
    <div id = "Frame2">
        <label id = "Result_Display"> 
        The searching result:
        ______________________________________________________
        </label>
        <label id ="Result"><br><br><br><br><br>><br>
        </label>
     
    </div>
    <?php 
        if(!empty($_POST['submit_info']) && $_POST['submit_info'] == "search")
        {
            $category = trim($_POST['category']);
            $bookName = trim($_POST['bookName']);
            $press = trim($_POST['press']);
            $yearupper = trim($_POST['yearupper']);
            $yearlower = trim($_POST['yearlower']);
            $author = trim($_POST['author']);
            $priceupper = trim($_POST['priceupper']);
            $pricelower = trim($_POST['pricelower']);

            //Connet the database
            $serverName = "localhost:3306";
            $uid = "root";
            $pwd = "";
            $conn = @mysql_connect($serverName, $uid, $pwd);

            if($conn == false)    //Data base connet failed
            {
                echo "<script language=\"JavaScript\">alert(\"Database connection failed! Try later!\");</script>";
            }
            //link successful
            else
            {
                mysql_select_db("library", $conn);
                if($yearlower == NULL)
                {
                    $yearlower = 0;
                }
                if($yearupper == NULL)
                {
                    $yearupper = 1000000;
                }
                if($pricelower == NULL)
                {
                    $pricelower = 0;
                }
                if($priceupper == NULL)
                {
                    $priceupper = 1000000;
                }
                if(!is_numeric($yearlower) || !is_numeric($yearupper) || !is_numeric($pricelower) || !is_numeric($priceupper))
                {
                    echo "<script language=\"JavaScript\">alert(\"Invaild year or price!\");</script>";
                }
                else
                {
                    $sql = "select * from book where 
                            ('{$category}' = '' or '{$category}') and 
                            ('{$bookName}' = '' or title = '{$bookName}') and
                            ('{$press}' = '' or press = ('{$press}')) and
                            (year >= {$yearlower} and year <= {$yearupper} ) and
                            ( '{$author}' = '' or author = '{$author}' ) and
                            (price >= {$pricelower} and price <= {$priceupper})  order by title";
                    $stmt = mysql_query($sql, $conn);
                    if($stmt != false)
                    {
                        $count = 0;
                        $newBook = "<table border=1><tr><td>Book NO</td><td>Catagory</td><td>Title</td><td>Press</td><td>Year</td><td>Author</td><td>Price</td><td>Total</td><td>Stock</td> </tr>";
                        while(($result =  mysql_fetch_assoc($stmt)) && $count < 50)
                        {   
                            $bno =  $result['bno'];
                            $category = $result['category'];
                            $title = $result['title'];
                            $press = $result['press'];
                            $year = $result['year'];
                            $author = $result['author'];
                            $price = $result['price'];
                            $total = $result['total'];
                            $stock = $result['stock'];

                            

                            $newBook = $newBook."<tr><td>".$bno."</td><td>".$category."</td><td>".$title."</td><td>".$press."</td><td>".$year."</td><td>".$author."</td><td>".$price."</td><td>"
                                           .$total."</td><td>".$stock."</td></tr>"; 
                        }
                        $newBook = $newBook."</table><Br>"."<Br>";
                        echo "<script language=\"JavaScript\">
                                var result = document.getElementById(\"Result\");
                                var newRecord = \"".$newBook."\";
                                result.innerHTML = newRecord;
                            </script>";
                    }
                    else
                    {
                        echo "<script language=\"JavaScript\">alert(\"Search fail! Check your input please!\");</script>";
                    }
                }
                
            }
            unset($_POST['submit_info']);
        }
?>

    
</body> 
</html> 
