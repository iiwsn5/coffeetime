<?php
session_start();

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "coffee_project"; 


$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating DATABASE: " . $conn->error ;
}
$conn->select_db($dbname);


$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating users table: " . $conn->error;
}


$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED,
    coffee_type VARCHAR(30),
    quantity INT,
    payment_method VARCHAR(50),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating orders table: " . $conn->error;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

   $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $selectedUserId = $conn->insert_id;
        $_SESSION["user_id"] = $selectedUserId;

        header("Location: coffee_selection.php");
        exit;
    } else {
        echo "Error inserting user: " . $conn->error;
    }


} else {
    echo "Invalid request.";
}


$conn->close();
?>