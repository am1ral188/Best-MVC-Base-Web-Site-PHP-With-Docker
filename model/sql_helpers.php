<?php

function find_in_sql_login($user_, $pass_) {
  // Create connection
  $conn = mysqli_connect("localhost", "am1", "A@mir881401", "vpn_am1ral1");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare a statement
  $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ? AND password = ?");

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
function insert_in_sql_login($user_, $pass_):bool {
  // Create connection
  $conn = mysqli_connect("localhost", "am1", "A@mir881401", "vpn_am1ral1");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare a statement
    $username =$user_;
    $password = password_hash($pass_, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

// Execute statement
    $stmt->execute();

// Check for errors
    if ($stmt->errno) {
return false;

    } else {
       return true;
    }

// Close statement and connection
    $stmt->close();
    $mysqli->close();

}

function get_user_ac($usr_name):string{
    $servername = "localhost";
    $username = "am1";
    $password = "A@mir881401";
    $db_name = "vpn_am1ral1";
//        $us=;
    $conn = new mysqli($servername, $username, $password,$db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $usr_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $_query__r=mysqli_fetch_assoc($result);
    return $_query__r['acs'];
}

?>
