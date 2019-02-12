<?php
    //Check login state
    include 'CheckLogin.php';
    CheckLogin();
?>

<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Borrow Book</title>  
    <link rel="stylesheet" type="text/css" href="Book_Borrow.css"/>
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
                Hello,<?php echo $_SESSION['username'] ?> 
            </label>
        </div>
        <div id = "Frame">
            <label id = "Text_Display">
            Please enter the Borrow Card No.(CNO):
            ______________________________________________________
                
            </label>

            <form method="post"  id = "FormFrame">
                <div class = "Input_Block">
                    <label class = "Input_Tip">Borrow Card No.(CNO)</label><input name = "cno" class = "text_input" type = "text"></input>
                </div>
                <input type="submit" id="submit_info"  name = "submit_cno" value="submit" />  
               
            </form>
        </div>

        <div id = "Frame2">
            <label id = "Result_Display"> 
            All books borrowed:
            ______________________________________________________
            </label>
            <label id ="Result"> <br><br><br><br><br>
            </label>
           
        </div>

        <div id = "Frame3">
            <label id = "Text_Display">
            Please enter the Book No.(BNO):
            ______________________________________________________
                
            </label>

            <form method="post"  id = "FormFrame">
                <div class = "Input_Block">
                    <label class = "Input_Tip">Book No.(BNO)</label><input name = "bno" class = "text_input" type = "text"></input>
                </div>
                <input type="submit" id="submit_info"  name = "submit_bno" value="submit" />  
            </form>
        </div>

        <div id = "Frame4">
            <label id = "Result_Display"> 
            The excuting result:           
            ______________________________________________________
            </label>
            <label id ="Result1"> <br><br><br><br><br>
            </label>
        
        </div>
    
        <?php 
        if(!empty($_POST['submit_cno']) && $_POST['submit_cno'] == "submit")
        {
            $cno = trim($_POST['cno']);
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
                if(strstr($cno,"'") || strstr($cno,"\"") || strstr($cno,"=")|| strstr($cno," "))
                {
                    echo "<script language=\"JavaScript\">alert(\"Invaild Card No.!\");</script>";
                }
                else
                {
                    mysql_select_db("library", $conn);
                    $sql = "select * from card where cno = '{$cno}'";
                    $stmt = mysql_query($sql, $conn);
                    if($stmt == true)
                    {
                        $card = mysql_fetch_assoc($stmt);
                        if($card)
                        {
                            $_SESSION['cno'] = $cno;
                            $sql = "select book.* from book,borrow where borrow.cno = '{$cno}' and borrow.return_date is null and borrow.bno = book.bno";
                            $stmt = mysql_query($sql, $conn);
                            if($stmt != false)
                            {
                                $count = 0;
                                $newBook = $cno."<table border=1><tr><td>Book NO</td><td>Catagory</td><td>Title</td><td>Press</td><td>Year</td><td>Author</td><td>Price</td><td>Total</td><td>Stock</td> </tr>";
                                while(($result = mysql_fetch_assoc($stmt)) && $count < 50)
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

                                    $bno = iconv( 'GBK','UTF-8', $bno);
                                    $category = iconv('GBK','UTF-8', $category);
                                    $title = iconv('GBK','UTF-8', $title);
                                    $press = iconv('GBK','UTF-8',  $press);
                                    $author = iconv('GBK','UTF-8', $author);

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
                        else
                        {
                            echo "<script language=\"JavaScript\">alert(\"Not have this card!\");</script>";
                        }
                    }
                    else
                    {
                        echo "<script language=\"JavaScript\">alert(\"Search fail! Check your input please!\");</script>";
                    }
                }
            }
        }
        if(!empty($_POST['submit_bno']) && $_POST['submit_bno'] == "submit")
        {
            $bno = trim($_POST['bno']);

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
                if(strstr($bno,"'") || strstr($bno,"\"") || strstr($bno,"=")|| strstr($bno," "))
                {
                    echo "<script language=\"JavaScript\">alert(\"Invaild Book No.!\");</script>";
                }
                else
                {
                    mysql_select_db("library", $conn);
                    $sql = "select stock from book where bno = '{$bno}'";
                    $stmt = mysql_query($sql, $conn);
                    if($stmt != false)
                    {
                        if($result = mysql_fetch_assoc($stmt))
                        {   
                            $stock = $result['stock'];
                            if($stock == 0)
                            {
                                $sql1 = "select return_date from borrow where bno = '{$bno}' and return_date <> null order by return_date desc";
                                $stmt1 = mysql_query($sql1, $conn);

                                if($stmt1 != false)
                                {
                                    if($row = mysql_fetch_assoc($stmt1))
                                    {
                                        $return_date = $row['return_date'];
                                        echo    "<script language=\"JavaScript\">
                                        var result = document.getElementById(\"Result1\");
                                        result.innerHTML = \"The latest return time :".$return_date." <Br><Br>\";
                                        </script>";
                                    }
                                    else
                                    {
                                        echo    "<script language=\"JavaScript\">
                                        var result = document.getElementById(\"Result1\");
                                        result.innerHTML = \"No this book or never returned!\";
                                        </script>";
                                    }
                                }
                                else
                                {
                                    echo    "<script language=\"JavaScript\">
                                        var result = document.getElementById(\"Result1\");
                                        result.innerHTML = \"Stock is zero but unknow error!\";
                                        </script>";
                                }
                            }
                            else
                            {
                                $cno = NULL;
                                if(isset($_SESSION['cno'])) $cno = $_SESSION['cno'];

                                if($cno != NULL)
                                {
                                    $sql1 = "update book set stock = stock-1 where bno = '{$bno}'";
                                    $stmt1 = mysql_query($sql1, $conn);
                                    if($stmt1 == true)
                                    {
                                        $datatime = date("Y-m-d h:i:s", time());
                                        $sql2 = "insert into borrow values('{$cno}','{$bno}','{$_SESSION['username']}','{$datatime}', null)";
                                        $stmt2 = mysql_query($sql2, $conn);
                                        if($stmt2 == false)
                                        {
                                            $sql3 = "update book set stock = stock+1 where bno = '{$bno}'";
                                            $stmt3 = mysql_query($sql3, $conn);
                                        }
                                    }
                                    if($stmt1 == true && $stmt2 == true)
                                    {
                                        echo    "<script language=\"JavaScript\">
                                            var result = document.getElementById(\"Result1\");
                                            result.innerHTML = \"Successful! <Br><Br>\";
                                            </script>";
                                    }
                                    else
                                    {
                                        echo    "<script language=\"JavaScript\">
                                            var result = document.getElementById(\"Result1\");
                                            result.innerHTML = \"Stock is not zero but borrow failed!\";
                                            </script>";
                                    }
                                }
                                else
                                {
                                    echo "<script language=\"JavaScript\">alert(\"No cno input!\");</script>";
                                }
                            }
                        }
                        else
                        {
                            echo "<script language=\"JavaScript\">
                                var result = document.getElementById(\"Result1\");
                                result.innerHTML = \"No this book!\";
                            </script>";
                        }
                        
                    }
                    else
                    {
                        echo "<script language=\"JavaScript\">alert(\"Search fail! Check your input please!\");</script>";
                    }
                }
                
            }
        }

        if(isset($_SESSION['cno']))
        {
            $cno = $_SESSION['cno'];
            //Connet the database
            $serverName = "localhost:3306";
            $uid = "root";
            $pwd = "";
            $conn = @mysql_connect($serverName, $uid, $pwd);

            if($conn == false)    //Data base connet failed
            {
            }
            //link successful
            else
            {
                mysql_select_db("library", $conn);
                $sql = "select * from card where cno = '{$cno}'";
                $stmt = mysql_query($sql, $conn);
                $card = mysql_fetch_assoc($stmt);
                if($card != true)
                {
                    unset($_SESSION['cno']);
                }
                else
                {
                    $sql = "select book.* from book,borrow where borrow.cno = '{$cno}' and borrow.return_date is null and borrow.bno = book.bno";
                    $stmt = mysql_query($sql, $conn);
                    if($stmt != false)
                    {
                        $count = 0;
                        $newBook = $cno."<table border=1><tr><td>Book NO</td><td>Catagory</td><td>Title</td><td>Press</td><td>Year</td><td>Author</td><td>Price</td><td>Total</td><td>Stock</td> </tr>";
                        while(($result = mysql_fetch_assoc($stmt)) && $count < 50)
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

                            $bno = iconv( 'GBK','UTF-8', $bno);
                            $category = iconv('GBK','UTF-8', $category);
                            $title = iconv('GBK','UTF-8', $title);
                            $press = iconv('GBK','UTF-8',  $press);
                            $author = iconv('GBK','UTF-8', $author);

                            $newBook = $newBook."<tr><td>".$bno."</td><td>".$category."</td><td>".$title."</td><td>".$press."</td><td>".$year."</td><td>".$author."</td><td>".$price."</td><td>"
                                           .$total."</td><td>".$stock."</td></tr>"; 
                        }
                        $newBook = $newBook."</table><Br>"."<Br>";
                    }
                    else
                    {
                    }
                }
                
            }
        }
?>

    
</body> 
</html> 
