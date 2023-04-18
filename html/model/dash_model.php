<?php

class dash_model
{
    public function find_in_sql_login($user_, $pass_): bool
    {
        // Create connection
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare a statement
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? AND pass = ?");

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $user_, $pass_);

        // Execute statement
        mysqli_stmt_execute($stmt);

        // Get result
        $result = mysqli_stmt_get_result($stmt);

        // Check if user exists
        if ($result->num_rows > 0) {
            // User exists
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return true;
        } else {
            // User does not exist
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return false;
        }
    }

    public function find_in_sql_login2($user_): bool
    {
        // Create connection
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if (!$conn) {
            die("Connection failed.: " . mysqli_connect_error());
        }

        // Prepare a statement
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? ");

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $user_);

        // Execute statement
        mysqli_stmt_execute($stmt);

        // Get result
        $result = mysqli_stmt_get_result($stmt);

        // Check if user exists
        if ($result->num_rows > 0) {
            // User exists
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return true;
        } else {
            // User does not exist
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return false;
        }
    }

    public function delete_from_sql_dash_adm($user_): bool
    {
        // Create connection
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare a statement
        $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE username = ? ");

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $user_);

        // Execute statement
        mysqli_stmt_execute($stmt);

        // Get result
        $result = mysqli_stmt_get_result($stmt);

        // Check if user exists
        if ($result->num_rows > 0) {
            // User exists
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return true;
        } else {
            // User does not exist
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return false;
        }
    }

    public function insert_in_sql_login($user_, $pass_)
    {
        // Create connection
        $conn = mysqli_connect("localhost", "am1", "A@mir881401", "vpn_am1ral1");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare a statement
        $username = $user_;
        $us = "user";

        $stmt = $conn->prepare("INSERT INTO users (username, pass,acs) VALUES (?, ?,?)");
        $stmt->bind_param("sss", $username, $pass_, $us);

// Execute statement
        $stmt->execute();
        $stmt->close();
        $conn->close();
// Check for errors


// Close statement and connection


    }
    public function insert_in_sql($user_, $pass_,$acs)
    {
        // Create connection
        $conn = mysqli_connect("localhost", "am1", "A@mir881401", "vpn_am1ral1");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare a statement
        $username = $user_;
        $us = "user";

        $stmt = $conn->prepare("INSERT INTO users (username, pass,acs) VALUES (?, ?,?)");
        $stmt->bind_param("sss", $username, $pass_, $us);

// Execute statement
        $stmt->execute();
        $stmt->close();
        $conn->close();
// Check for errors


// Close statement and connection


    }

    function get_user_ac($usr_name): string
    {

//        $us=;
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $usr_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        $_query__r = mysqli_fetch_assoc($result);
        return $_query__r['acs'];
    }

    public function update_pass($username_, $pass, $newusername_, $newpass)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("UPDATE users SET username = ?, pass= ? WHERE username = ? AND pass= ?;");
        $stmt->bind_param("ssss", $newusername_, $newpass, $username_, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
    }

    public function update_profile($username_, $pass, $img_addr)
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("UPDATE users SET profile_image= ? WHERE username = ? AND pass= ?;");
        $stmt->bind_param("sss", $img_addr, $username_, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
    }


public function get_img($usr_name):string{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $usr_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
    $_query__r = mysqli_fetch_assoc($result);
    return $_query__r['profile_img_path'];

}
}