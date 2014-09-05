<?php

class Error_message{
    public static function Error_number($number){
        $number = (int)$number;
        switch($number){
            case 1000:
                $result["error_description"] = "Амжилттай боллоо";
                $result["error_number"] = 1;
       
                break;
            case 1001:
                $result["error_description"] = "Одоогоор өгөгдөл байхгүй байна";
                $result["error_number"] = 2;
              
                break;
            case 2000:
                $result["error_description"] = "Амжилтгүй боллоо";
                $result["error_number"] = 0;

                break;
            case 2001:
                $result["error_description"] = "Query ажилах явцад алдаа гарлаа";
                $result["error_number"] = 2001;
                $result["error_isnumber"] = 3;
                $result["error_is"] = true;
                break;
            case 2002:
                $result["error_description"] = "Ийм өгөгдөл олдсонгүй";
                $result["error_number"] = 2002;
                $result["error_isnumber"] = 1;
                $result["error_is"] = true;
                break;
            case 2003:
                $result["error_description"] = "Хүсэлт дутуу байна";
                $result["error_number"] = 2003;
                $result["error_isnumber"] = 1;
                $result["error_is"] = true;
                break;
            case 2004:
                $result["error_description"] = "Та нэвтрээгүй байна";
                $result["error_number"] = 2004;
                $result["error_isnumber"] = 1;
                $result["error_is"] = true;
                break;
        
            default :
                $result["error_description"] = "Unknown Error";
                $result["error_number"] = 0;
                $result["error_isnumber"] = 1;
                $result["error_is"] = true;
                break;
        }
        return $result;
    }
}