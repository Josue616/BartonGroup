<?php
$servername = "localhost";
$username = "cotrina";
$password = "123";
$dbname = "prestamos_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
function getConnection()
{
    $servername = "localhost";
    $username = "cotrina";
    $password = "123";
    $dbname = "prestamos_db";

    try {
        $conn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
