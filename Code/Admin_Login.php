<?php  
    header("Content-Type:text/html;charset=utf-8"); 
    //record the global variables to keep the login state and username
    session_start();

    //to clear the login state
    unset($_SESSION['islogin']);
    unset($_SESSION['username']);

     //Judge if the information has been posted from Admin_Login.html
    if(isset($_POST['btn_login']) && $_POST['btn_login'] == "Login") 
    {  
        //Get the input username and password
        $username = trim($_POST['username']);
        $password = trim($_POST['password']); 
        //username or password is empty
        if(($username=='')||($password==''))
        {  
            //alarm
            echo "<script language=\"JavaScript\">alert(\"Username or password can not be empty! Please login!\");</script>";
            header('refresh:0; url=Admin_Login.html');
            exit;  
        }
        else if(strstr($username,"'") || strstr($username,"\"") || strstr($username,"=")|| strstr($username," "))
        {
            //invalid username
            echo "<script language=\"JavaScript\">alert(\"Username invaild!\");</script>";
            header('refresh:0; url=Admin_Login.html');
            exit;  
        }
        else
        {  
            //Connet the database
            $serverName = "localhost:3306";
            $uid = "root";
            $pwd = "";
            $conn = @mysql_connect($serverName, $uid, $pwd);

            if(!$conn)    //Data base connet failed
            {
                echo "<script language=\"JavaScript\">alert(\"Database connection failed! Try later!\");</script>";
                header('refresh:0; url=index.html');
                exit; 
            }
            else
            {
                mysql_select_db("library", $conn);
                //query for password
                $query = mysql_query("select password from admin where admin_id = '{$username}'", $conn);   
                $result = mysql_fetch_assoc($query);
                //password error   if there is more than 1 record means sql attack
                if($result[password] != $password )
                {
                    echo "<script language=\"JavaScript\">alert(\"Username or password error!\");</script>";
                    header('refresh:0; url=index.html');
                    exit; 
                }
                else  //successful
                {
                    //Record the login state
                  $_SESSION['username']=$username;  
                  $_SESSION['islogin']=1;
                  echo "<script language=\"JavaScript\">alert(\"Login Successfully!\");</script>";
                  echo "<script>location='Admin_Manage.php';</script>";
                  exit;
                }
            }
        }  
    }
    else
    {
      echo "<script language=\"JavaScript\">alert(\"Please Login!\");</script>";
      header('refresh:0; url=Admin_Login.html');
      exit; 
    }
?>  