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

            $category = iconv('UTF-8', 'GBK', $category);
            $bookName = iconv('UTF-8', 'GBK', $bookName);
            $press = iconv('UTF-8', 'GBK', $press);
            $author = iconv('UTF-8', 'GBK', $author);

            //Connet the database
            $serverName = "localhost";
            $uid = "Sa";
            $pwd = "0926";
            $connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"library");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);

            if($conn == false)    //Data base connet failed
            {
                echo "<script language=\"JavaScript\">alert(\"Database connection failed! Try later!\");</script>";
            }
            //link successful
            else
            {
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
                            ((?) = '' or category = (?)) and 
                            ((?) = '' or title = (?)) and
                            ((?) = '' or press = (?)) and
                            (year >= (?) and year <= (?)) and
                            ( (?) = '' or author = (?) ) and
                            (price >= (?) and price <= (?))";
                    $param = array($category, $category, $bookName,$bookName, $press, $press,$yearlower, $yearupper, $author, $author,$pricelower, $priceupper );
                    $query = sqlsrv_query($conn, $sql, $param);
                    if($query == true)
                    {
                        $count = 0;
                        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC) && $count < 50)
                        {
                            $count++;
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
                            echo $year;

                            $newBook = $bno." ".$category." ".$title." ".$press." ".$year." ".$author." ".$price." "
                                           .$total." ".$stock."<br>"; 
                            
                            echo $newBook;
                        }
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