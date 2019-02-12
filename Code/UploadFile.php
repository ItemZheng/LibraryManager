<?php
    include'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
    include'Entry.php';

    if(!empty($_FILES['file']['name']))
    {
        $tmp_file = $_FILES['file']['tmp_name'];
        $file_types = explode ( ".", $_FILES ['file']['name'] );
        $file_type = $file_types [count ( $file_types ) - 1];
        if(strtolower($file_type) != "xls" && strtolower($file_type) != "xlsx")
        {
            echo "<script language=\"JavaScript\">alert(\"Not a EXCEL file!\");</script>";
            header('refresh:0; url=Book_Entry.php');
        }
        else
        {
            $savePath = 'upfile/';
            $str = date('Ymdhis');
            $file_name = $str.".".$file_type;
            if (!copy($tmp_file, $savePath.$file_name)) 
            {
                echo "<script language=\"JavaScript\">alert(\"Upload Failed!\");</script>";
                header('refresh:0; url=Book_Entry.php');
            }
            else
            {   
                $reader = PHPExcel_IOFactory::createReader('Excel2007'); 
                $PHPExcel = $reader->load($savePath.$file_name);
                $sheet = $PHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $count = 0;
                for ($row = 1; $row <= $highestRow; $row++) {
                    $bno = $sheet->getCellByColumnAndRow(0, $row)->getValue();
                    $category = $sheet->getCellByColumnAndRow(1, $row)->getValue();
                    $title = $sheet->getCellByColumnAndRow(2, $row)->getValue();
                    $press = $sheet->getCellByColumnAndRow(3, $row)->getValue();
                    $year = $sheet->getCellByColumnAndRow(4, $row)->getValue();
                    $author = $sheet->getCellByColumnAndRow(5, $row)->getValue();
                    $price = $sheet->getCellByColumnAndRow(6, $row)->getValue();
                    $number = $sheet->getCellByColumnAndRow(7, $row)->getValue();
                    
                    $bno = iconv('UTF-8', 'GBK', $bno);
                    $category = iconv('UTF-8', 'GBK', $category);
                    $bookName = iconv('UTF-8', 'GBK', $title);
                    $press = iconv('UTF-8', 'GBK', $press);
                    $author = iconv('UTF-8', 'GBK', $author);

                    $result = $reslut = insert_into_book($bno, $category, $bookName, $press, $year, $author, $price, $number);
                    if($reslut == 0)
                    {
                        $count++;
                    }
                }
                echo "<script language=\"JavaScript\">alert(\"There is ".$highestRow." records and ".$count." record success!!!!\");</script>";
            }
        }
    }
    header('refresh:0; url=Book_Entry.php');
?>