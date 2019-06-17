<?php

    if(isset($errConn)){
        // Problemas na conexão com o banco de dados
        header("HTTP/1.1 503 Service Unavailable");
        echo $errConn;
    } else {
        if (mysqli_query($connection, $insertSQL)) {
            mysqli_close($connection);

            header("HTTP/1.1 201 Created");
            header('Content-Type: application/json');
            echo $res; 
        } else {
            $errNo = mysqli_errno($connection);
            $errMsg = mysqli_error($connection);

            if($errNo == 1062){
                // Já existe elemento com esse id
                header("HTTP/1.1 409 Conflict");
                mysqli_close($connection);
                echo $err;
            } else {
                // Erro inesperado no banco de dados
                mysqli_close($connection);
                header("HTTP/1.1 500 Internal Server Error");
                echo $errNo;
            }
        }
    }