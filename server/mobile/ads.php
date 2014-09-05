<?php

header("Content-type: application/json;charset=utf-8");
require_once $_SERVER["DOCUMENT_ROOT"] . "/mcar/server/lib/config.php";
require_once ROOT . '/server/functions/Query_data_func.php';

if (isset($_POST['index'])) {
    $index = (int) $_POST['index'];
    $result = Query::getAds($index);
} else
    if(isset ($_POST['delete'])){
        $delete=$_POST['delete'];
            $result = Query::getDeleteAds($delete);
    }
    else
    $result = Error_message::Error_number($number);

echo json_encode($result);

