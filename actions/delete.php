<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];

    try {
        // PDO connection to the database
        $conn = new PDO($dsn, $loginMysql, $passwordMysql);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Delete the data from the 'etudiant' table
        $stmt = $conn->prepare("DELETE FROM etudiant WHERE id = ?");
        // Execute the prepared statement
        if ($stmt->execute(array($id))) {
            echo 'Record deleted successfully';
            // Redirect to the index page
            header('Location: ../index.php');
        } else {
            echo 'Error: ' . $stmt->errorInfo()[2];
        }

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    // Close the connections
    $conn = null;
}
?>