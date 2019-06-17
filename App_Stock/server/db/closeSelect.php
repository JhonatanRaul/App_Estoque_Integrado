<?php

    if(isset($errConn)){
        // Problemas na conexão com o banco de dados
        header("HTTP/1.1 503 Service Unavailable");
        echo $errConn;
    } else {
        $result = mysqli_query($connection, $selectSQL);

        if ($result) {
            $json = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_close($connection);

            header("HTTP/1.1 200 OK");
            header('Content-Type: application/json');
            echo json_encode($json); 
        } else {
            $errNo = mysqli_errno($connection);

            // Erro inesperado no banco de dados
            mysqli_close($connection);
            header("HTTP/1.1 500 Internal Server Error");
            echo $errNo . ' - The search could not be performed.\n';
        }
    }