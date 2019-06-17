<?php

    @$id = $_POST['id'];
    @$name = $_POST['name'];
    @$_maximumCost = $_POST['_maximumCost'];

    if($id == '' || $id == null || $name == '' || $name == null || $_maximumCost == '' || $_maximumCost == null){
        header("HTTP/1.1 400 Bad Request");   
    } else {
        $insertSQL = "INSERT INTO MATERIAL_STANDARDS(ID_MATERIAL, NAME, MAXIMUM_COST) VALUES('$id', '$name', '$_maximumCost')";
        
        $arr = array('id' => $id, 'name' => $name, '_maximumCost' => $_maximumCost);
        $res = json_encode($arr);
        
        include_once 'db/conn.php';
        include_once 'db/closeInsert.php';
    }