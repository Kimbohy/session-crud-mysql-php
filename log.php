<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="flex w-screen h-screen items-center justify-center bg-green-200">
        <form action="./session/login.php" method="post" class="flex flex-col gap-10 bg-emerald-600 px-10 py-12 rounded-xl">
            <h1 class="text-white text-3xl">Login</h1>
            <input type="text" name="username" placeholder="Username" class=" w-96 rounded-lg h-10 p-2">
            <input type="password" name="password" placeholder="Password" class="w-96 rounded-lg h-10 p-2" >
            <a href="./session/forgotPassword.php" class="text-white hover:text-stone-50 px-2 w-full text-end "> Forgot Password </a>
            <button type="submit" class="bg-emerald-700 text-white h-10 rounded-lg hover:bg-emerald-800">Login</button>
            <?php
            $error = $_GET['error'];
            if (isset($error)) {
                echo "$error";
            }
            ?>
        </form>
    </div>
</body>
</html>

<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location: index.html');
}

?>