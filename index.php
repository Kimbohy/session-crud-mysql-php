<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <script src="./script.js" defer></script>
    <title>Student Management</title>
</head>
<body>
    <div class="items-center justify-center w-screen h-screen bg-green-200 ">
    <div class="flex items-center justify-between w-full px-5 bg-emerald-700">
        
        <h1 class="text-3xl text-white ">Gestion des etudiants</h1>
        <form action="./session/logout.php" class="p-4 text-white bg-emerald-600 hover:bg-emerald-500">
            <input type="submit" value="Log out">
        </form>
    </div>    
    <div id="form">
        <button onclick="add()" class="w-20 h-10 p-2 text-white bg-emerald-600 hover:bg-emerald-700" >Add</button>
        <!-- form section -->
    </div>
        <div class="p-5">
            <table >
                <thead>
                    <tr class="text-white bg-emerald-700">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Adresse</th>
                        <th>Parcours</th>
                        <th>Sexe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'config.php';
                        // Database connection
                        $conn = new PDO($dsn, $loginMysql, $passwordMysql);

                        // Set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        try
                        {                

                        $sql = 'SELECT * FROM etudiant';
                        $result = $conn->query($sql);

                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch()) {
                                echo '<tr>';
                                echo '<td class="px-10 py-3">' . ($row['id']) .'</td>';
                                echo '<td class="px-10 py-3">' . ($row['nom']) . '</td>';
                                echo '<td class="px-10 py-3">' . ($row['prenom']) . '</td>';
                                echo '<td class="px-10 py-3">' . ($row['date_naissance']) . '</td>';
                                echo '<td class="px-10 py-3">' . ($row['adresse']) . '</td>';
                                echo '<td class="px-10 py-3">' . (getParcour($row['parcours'],$conn)) . '</td>';
                                echo '<td class="px-10 py-3">' . ($row['sexe']) . '</td>';
                                echo '<td class="flex items-center justify-between gap-6 px-10 py-3">';
                                echo '<a href="./actions/edit.php?id=' . $row['id'] . '"><img src="./assets/icons/edit.svg" alt="edit"  class="w-8" ></a>';
                                echo '<a href="./actions/delete.php?id=' . $row['id'] . '"><img src="./assets/icons/delet.svg" alt="delet" class="w-5" /></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            $result->closeCursor();
                        } else {
                            echo '<tr><td colspan="6">0 results</td></tr>';
                        }
                    }
                    catch(PDOException $e)
                    {
                        echo 'Error: ' . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>

<?php
// function to trasform the parcour id to the parcour name
function getParcour($id, $conn) {
    $sql = 'SELECT nom FROM parcours WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    $parcour = $stmt->fetch();
    return $parcour['nom'];
}
?>