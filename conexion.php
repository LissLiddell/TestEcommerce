<?php
    function conexion()
    {
        $servername = "localhost";
        $database = "emp";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database);
         if($conn->connect_error)
         {
             die("Error: No se puede conectar al servidor: ". $conn->connect_error);
         }
    }

?>