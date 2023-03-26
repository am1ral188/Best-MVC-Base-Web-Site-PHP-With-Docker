<?php
class log_user{
public function find_in_sql_login($user_, $pass_) {
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
public function find_in_sql_login2($user_) {
    // Create connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
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
    public function insert_in_sql_login($user_, $pass_){
    // Create connection
    $conn = mysqli_connect("localhost", "am1", "A@mir881401", "vpn_am1ral1");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare a statement
    $username =$user_;
    $us="user";
    $password = password_hash($pass_, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, pass,acs) VALUES (?, ?,?)");
    $stmt->bind_param("sss", $username, $password,$us);

// Execute statement
    $stmt->execute();
        $stmt->close();
        $conn->close();
// Check for errors


// Close statement and connection


}

function get_user_ac($usr_name):string{

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
    $_query__r=mysqli_fetch_assoc($result);
    return $_query__r['acs'];
   }
}

?>
