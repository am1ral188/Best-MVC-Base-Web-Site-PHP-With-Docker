<?php

function find_in_sql_login($user_,$pass_):bool{
    $servername = "localhost";
    $username = "am1";
    $password = "A@mir881401";
    $db_name = "vpn_am1ral1";
//        $us=;
    $conn = new mysqli($servername, $username, $password,$db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?&pass=?");
    $stmt->bind_param("s", $user_,$pass_);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows>0){
        return true;
        mysqli_close($conn);

    }else{
        return false;
        mysqli_close($conn);

    }

}
?>