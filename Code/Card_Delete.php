<?php
    //Check login state
    include 'CheckLogin.php';
    CheckLogin();
?>

<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Card Manage</title>  
    <link rel="stylesheet" type="text/css" href="Card_Delete.css"/>
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
        <div id = "Frame">
            <label id = "Text_Display">
            Please enter Borrow Card No.(CNO):
            ______________________________________________________
                
            </label>
            <form method="post"  id = "FormFrame">
                <div class = "Input_Block">
                    <label class = "Input_Tip">Borrow Card Number(CNO)</label><input name = "cno" class = "text_input" type = "text"></input>
                </div>
                <div class = "Input_Block">
                    <label class = "Input_Tip">Name</label><input name = "name" class = "text_input" type = "text"></input>
                </div>
                <div class = "Input_Block">
                    <label class = "Input_Tip">Department</label><input name = "department" class = "text_input" type = "text"></input>
                </div>
                <div class = "Input_Block">
                    <label class = "Input_Tip">Type</label><input name = "type" class = "text_input" type = "text"></input>
                </div>
                <input type="submit" id="add_cno"  name = "add_cno" value="add" />  
                <input type="submit" id="delete_cno"  name = "delete_cno" value="delete"/>  
            </form>
        </div>

<?php
    if(!empty($_POST['add_cno']) && $_POST['add_cno'] == "add")
    {
        $cno = trim($_POST['cno']);
        $name = trim($_POST['name']);
        $department = trim($_POST['department']);
        $type = trim($_POST['type']);

        if($cno == "" || $name == "" || $department == "" || $type == "")
        {
            echo "<script language=\"JavaScript\">alert(\"Please input the entire infomation!\");</script>";
        }
        else
        {
            if( $type != 'U' && $type != 'T' && $type != 'G' && $type != 'O')
            {
                echo "<script language=\"JavaScript\">alert(\"Invalid type!\");</script>";
            }
            else
            {
                if(strstr($cno,"'") || strstr($cno,"\"") || strstr($cno,"=")|| strstr($cno," "))
                {
                    echo "<script language=\"JavaScript\">alert(\"Invaild Card No.!\");</script>";
                }
                else
                {
                    $serverName = "localhost";
                    $uid = "Sa";
                    $pwd = "0926";
                    $connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"library");
                    $conn = sqlsrv_connect( $serverName, $connectionInfo);

                    $sql = "select * from card where cno = (?)";
                    $param = array($cno);
                    $stmt = sqlsrv_query($conn, $sql, $param);

                    if($stmt)
                    {
                        if($result = sqlsrv_fetch_array($stmt))
                        {
                            echo "<script language=\"JavaScript\">alert(\"The card is in the database!\");</script>";
                        }
                        else
                        {
                            $sql2 = "insert into card values(?,?,?,?)";
                            $param2 = array($cno, $name, $department, $type);
                            $stmt2 = sqlsrv_query($conn, $sql2, $param2);
                            if($stmt2 == true)
                            {
                                echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
                            }
                            else
                            {
                                echo "<script language=\"JavaScript\">alert(\"Add error, check your input!\");</script>";
                            }
                        }
                    }
                    else
                    {
                        echo "<script language=\"JavaScript\">alert(\"Add error, check your input!\");</script>";
                    }
                }
            }
        }
    }
    if(!empty($_POST['delete_cno']) && $_POST['delete_cno'] == "delete")
    {
        $cno = trim($_POST['cno']);

        if($cno == "")
        {
            echo "<script language=\"JavaScript\">alert(\"Please input the cno!\");</script>";
        }
        else
        {
            if(strstr($cno,"'") || strstr($cno,"\"") || strstr($cno,"=")|| strstr($cno," "))
            {
                echo "<script language=\"JavaScript\">alert(\"Invaild Card No.!\");</script>";
            }
            else
            {
                $serverName = "localhost";
                $uid = "Sa";
                $pwd = "0926";
                $connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"library");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);

                $sql = "select * from card where cno = (?)";
                $param = array($cno);
                $stmt = sqlsrv_query($conn, $sql, $param);

                if($stmt)
                {
                    if(!($result = sqlsrv_fetch_array($stmt)))
                    {
                        echo "<script language=\"JavaScript\">alert(\"The card is not in the database!\");</script>";
                    }
                    else
                    {
                        $sql2 = "delete from card where cno = (?)";
                        $param2 = array($cno);
                        $stmt2 = sqlsrv_query($conn, $sql2, $param2);
                        if($stmt2 == true)
                        {
                            echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
                        }
                        else
                        {
                            echo "<script language=\"JavaScript\">alert(\"Database error!\");</script>";
                        }
                    }
                }
                else
                {
                    echo "<script language=\"JavaScript\">alert(\"Add error, check your input!\");</script>";
                }
            }
        }
    }
?>



</body> 
</html> 
