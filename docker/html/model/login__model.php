<?php

class login__model
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

}