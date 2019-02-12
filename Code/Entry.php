<?php
    header("Content-Type:text/html;charset=utf-8"); 

    if(isset($_POST['submit_book']) && $_POST['submit_book'] == "Entry")
    {
        $bno = trim($_POST['bno']);
        $category = trim($_POST['category']);
        $bookName = trim($_POST['bookName']);
        $press = trim($_POST['press']);
        $year = trim($_POST['year']);
        $author = trim($_POST['author']);
        $price = trim($_POST['price']);
        $number = trim($_POST['number']);

        $bno = iconv('UTF-8', 'GBK', $bno);
        $category = iconv('UTF-8', 'GBK', $category);
        $bookName = iconv('UTF-8', 'GBK', $bookName);
        $press = iconv('UTF-8', 'GBK', $press);
        $author = iconv('UTF-8', 'GBK', $author);

        $reslut = insert_into_book($bno, $category, $bookName, $press, $year, $author, $price, $number);
        if($reslut == 1)
        {
            echo "<script language=\"JavaScript\">alert(\"Book NO. is empty!\");</script>";
        }
        else if($reslut == 2)
        {
            echo "<script language=\"JavaScript\">alert(\"Number is not a number!\");</script>";
        }
        else if($reslut == 3)
        {
            echo "<script language=\"JavaScript\">alert(\"Book NO. invaild!\");</script>";
        }
        else if($reslut == 4)
        {
            echo "<script language=\"JavaScript\">alert(\"Database connection failed! Try later!\");</script>";
        }
        else if($reslut == 5)
        {
            echo "<script language=\"JavaScript\">alert(\"Check the category!\");</script>";
        }
        else if($reslut == 6)
        {
            echo "<script language=\"JavaScript\">alert(\"Check the title!\");</script>";
        }
        else if($reslut == 7)
        {
            echo "<script language=\"JavaScript\">alert(\"Check the press!\");</script>";
        }
        else if($reslut == 8)
        {
            echo "<script language=\"JavaScript\">alert(\"Check the year!\");</script>";
        }
        else if($reslut == 9)
        {
            echo "<script language=\"JavaScript\">alert(\"Check the author!\");</script>";
        }
        else if($reslut == 10)
        {
            echo "<script language=\"JavaScript\">alert(\"Check the price!\");</script>";
        }
        else if($reslut == 0)
        {
            echo "<script language=\"JavaScript\">alert(\"Entry Successfully!\");</script>";
        }
        else if($reslut == 11)
        {
            echo "<script language=\"JavaScript\">alert(\"Entry failed!Check and try again!\");</script>";
        }
        else if($reslut == 12)
        {
            echo "<script language=\"JavaScript\">alert(\"This is a new book, you must input all information!\");</script>";
        }
        else if($reslut == 13)
        {
            echo "<script language=\"JavaScript\">alert(\"Year and price must be number!\");</script>";
        }
        else{
            echo "<script language=\"JavaScript\">alert(\"Entry failed!Check and try again!\");</script>";
        }
        header('refresh:0; url=Book_Entry.php');
    }

    function insert_into_book($bno, $category, $bookName, $press, $year, $author, $price, $number)
    {
        if($bno == "")
        {
            return 1;
        }
        else if(is_numeric($number) == false)
        {
            return 2;
        }
        else
        {
            if(strstr($bno,"'") || strstr($bno,"\"") || strstr($bno,"=")|| strstr($bno," "))
            {
                //invalid username
                return 3;
            }
            else
            {
                //Connet the database
                $serverName = "localhost";
                $uid = "Sa";
                $pwd = "0926";
                $connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"library");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);

                if($conn == false)    //Data base connet failed
                {
                    return 4;
                }
                //link successful
                else
                {
                    $query = sqlsrv_query($conn, "select * from book where bno = '{$bno}'");
                    $result = sqlsrv_fetch_array($query);
                    if($result)     //the book has been in database
                    {
                        if($result['category'] != $category && $category != "")
                        {
                            return 5;
                        }
                        else if($result['title'] != $bookName && $bookName != "")
                        {
                            return 6;
                        }
                        else if($result['press'] != $press && $press != "")
                        {
                            return 7;
                        }
                        else if($result['year'] != $year && $year != "")
                        {
                            return 8;
                        }
                        else if($result['author'] != $author && $author != "")
                        {
                            return 9;
                        }
                        else if($result['price'] != $price && $price != "")
                        {
                            return 10;
                        }
                        else
                        {
                            $query = sqlsrv_query($conn,   "update book set total = total + {$number}, stock = stock + {$number} 
                                                            where bno = '{$bno}'");
                            if($query == true)
                            {
                                return 0;
                            }
                            else
                            {
                                return 11;
                            }
                        }
                    }
                    else
                    {
                        if($category == "" || $bookName == "" || $press == "" || $year == "" || $author == "" || $price == "")
                        {
                            return 12;
                        }
                        else if(is_numeric($price) == false || is_numeric($year) == false)
                        {
                            return 13;
                        }
                        else
                        {
                            $sql = "insert into book values(?,?,?,?,?,?,?,?,?)";
                            $param = array($bno, $category, $bookName, $press, $year, $author, $price, $number, $number);
                            $query = sqlsrv_query($conn, $sql, $param);
                            if($query == true)
                            {
                                return 0;
                            }
                            else
                            {
                                return 14;
                            }
                        }
                    }
                }
            }
        }
        return 14;
    }
?>
