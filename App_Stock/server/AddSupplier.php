<?php

    $id = $_POST['id'];
    $name = $_POST['name'];

    if($id == '' || $id == null || $name == '' || $name == null){
        header("HTTP/1.1 400 Bad Request");   
    } else {
        $insertSQL = "INSERT INTO SUPPLIER(ID_SUPPLIER, NAME) VALUES('$id', '$name')";
        
        $arr = array('id' => $id, 'name' => $name);
        $res = json_encode($arr);
        
        include_once 'db/conn.php';
        include_once 'db/closeInsert.php';
    }