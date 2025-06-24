<?php
function connectDB() {
    $conn = new mysqli("localhost", "root", "", "transpro");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function executeQuery($query) {
    $conn = connectDB();
    $result = $conn->query($query);
    $conn->close();
    return $result;
}
?>
