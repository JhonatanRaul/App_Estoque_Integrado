<?php

    $id = $_POST['id'];
    $name = $_POST['name'];
    $maximum_cost = $_POST['maximum_cost'];

    if($id == '' || $id == null || $name == '' || $name == null || $maximum_cost == '' || $maximum_cost == null){
        header("HTTP/1.1 400 Bad Request");   
    } else {
        $insertSQL = "INSERT INTO MATERIAL_STANDARDS(ID_MATERIAL, NAME, MAXIMUM_COST) VALUES('$id', '$name', '$maximum_cost')";
        
        $arr = array('id' => $id, 'name' => $name, 'maximum_cost' => $maximum_cost);
        $res = json_encode($arr);
        
        include_once 'db/conn.php';
        include_once 'db/closeInsert.php';
    }