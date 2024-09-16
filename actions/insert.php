<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dsn2 = 'mysql:host=localhost;dbname=parcours';

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $parcours = $_POST['parcours'];
    $sexe = $_POST['sexe'];

    try {
        // PDO connection to both databases
        $conn = new PDO($dsn, $loginMysql, $passwordMysql);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Find the id of the corresponding "parcours" in the 'parcours' database
        $stmt2 = $conn->prepare('SELECT id FROM parcours WHERE nom = ?');
        $stmt2->execute(array($parcours));
        
        // Fetch the ID of the parcours
        $parcours_row = $stmt2->fetch(PDO::FETCH_ASSOC);
        if ($parcours_row) {
            $parcours_id = $parcours_row['id'];
        } else {
            $addParcour = 'INSERT INTO parcours (nom) VALUES (:parcours)';
            $stmt3 = $conn->prepare($addParcour);
            $stmt3->bindParam(':parcours', $parcours);
        }

        // Insert the data into the 'etudiant' table
        $stmt = $conn->prepare("INSERT INTO etudiant (nom, prenom, date_naissance, adresse, parcours, sexe) 
                VALUES (?, ?, ?, ?, ?, ?)");
        

        // Execute the prepared statement
        if ($stmt->execute(array($nom, $prenom, $date_naissance, $adresse, $parcours_id, $sexe))) {
            echo 'New record created successfully';
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
