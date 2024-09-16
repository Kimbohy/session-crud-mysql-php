<?php
// editing the student record in the database
include '../config.php';

// Database connection
$connection = new PDO($dsn, $loginMysql, $passwordMysql);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $request = $connection->prepare('SELECT * FROM etudiant WHERE id = ?');
    $request->execute([$id]);
    $student = $request->fetch();

    if ($student) {
        $nom = $student['nom'];
        $prenom = $student['prenom'];
        $date_naissance = $student['date_naissance'];
        $adresse = $student['adresse'];
        $parcours = $student['parcours'];
        $sexe = $student['sexe'];
    } else {
        echo "Student record not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet">
    <title>Edit Student</title>
</head>
<body>
    <div class="flex flex-col items-center justify-center w-screen h-screen bg-green-200">
        <div class="flex items-center justify-between w-full px-5 bg-emerald-700">
            <h1 class="text-3xl text-white">Gestion des étudiants</h1>
            <form action="./session/logout.php" method="post" class="p-4 m-0 text-white bg-emerald-600">
                <input type="submit" value="Log out">
            </form>
        </div>    

        <?php if ($student): ?>
            <div class="flex items-center justify-center w-full h-full">
                <form action="./update.php" method="post" class="flex flex-col w-4/5 gap-3 p-10 rounded h-4/5 bg-emerald-600">
                    <h1 class="text-6xl text-white ">Edit</h1>
                    
                    <div class="flex flex-col items-start w-full">
                        <label for="nom" class="text-2xl text-white">Nom :</label>
                        <input type="text" name="nom" id="nom" class="flex-grow w-full h-10 p-1 rounded-md outline-none " value="<?= htmlspecialchars($nom); ?>" required>
                    </div>

                    <div class="flex flex-col items-start w-full">
                        <label for="prenom" class="text-2xl text-white">Prénom :</label>
                        <input type="text" name="prenom" id="prenom" class="flex-grow w-full h-10 p-1 rounded-md outline-none " value="<?= htmlspecialchars($prenom); ?>" required>
                    </div>

                    <div class="flex flex-col items-start w-full">
                        <label for="date_naissance" class="text-2xl text-white">Date de naissance :</label>
                        <input type="date" name="date_naissance" id="date_naissance" class="flex-grow w-full h-10 p-1 rounded-md outline-none " value="<?= htmlspecialchars($date_naissance); ?>" required>
                    </div>

                    <div class="flex flex-col items-start w-full">
                        <label for="adresse" class="text-2xl text-white">Adresse :</label>
                        <input type="text" name="adresse" id="adresse" class="flex-grow w-full h-10 p-1 rounded-md outline-none " value="<?= htmlspecialchars($adresse); ?>" required>
                    </div>

                    <div class="flex flex-col items-start w-full">
                        <label for="parcours" class="text-2xl text-white">Parcours :</label>
                        <select name="parcours" id="parcours" class="flex-grow w-full h-10 p-1 rounded-md outline-none " required>
                            <option value="Informatique" <?= $parcours == 'Informatique' ? 'selected' : ''; ?>>Informatique</option>
                            <option value="Mathematiques" <?= $parcours == 'Mathematiques' ? 'selected' : ''; ?>>Mathematiques</option>
                            <option value="Physique" <?= $parcours == 'Physique' ? 'selected' : ''; ?>>Physique</option>
                            <option value="Chimie" <?= $parcours == 'Chimie' ? 'selected' : ''; ?>>Chimie</option>
                            <option value="Biologie" <?= $parcours == 'Biologie' ? 'selected' : ''; ?>>Biologie</option>
                            <option value="Geologie" <?= $parcours == 'Geologie' ? 'selected' : ''; ?>>Geologie</option>
                            <option value="Geographie" <?= $parcours == 'Geographie' ? 'selected' : ''; ?>>Geographie</option>
                            <option value="Histoire" <?= $parcours == 'Histoire' ? 'selected' : ''; ?>>Histoire</option>
                        </select>
                    </div>

                    <div class="flex items-center w-full gap-3 text-white">
                        <label for="sexe" class="text-2xl text-white">Sexe :</label>
                        <span>Masculin</span>
                        <input type="radio" name="sexe" id="sexe_m" value="M" <?= $sexe == 'M' ? 'checked' : ''; ?> required>
                        <span>Féminin</span>
                        <input type="radio" name="sexe" id="sexe_f" value="F" <?= $sexe == 'F' ? 'checked' : ''; ?> required>
                    </div>

                    <input type="submit" value="Modifier" class="p-2 mt-4 text-2xl text-white rounded bg-emerald-700 hover:bg-emerald-800">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
