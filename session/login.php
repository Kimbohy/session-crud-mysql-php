<?php
session_start();
// get the username and password from the form using the POST method and store them in variables
$username = $_POST['username'];
$password = $_POST['password'];

// check if the username and password are empty
if (empty($username) || empty($password)) {
    // send to the log.php page that the username or password is empty
    header('Location: ../log.php?error=Username%20or%20password%20is%20empty');
}

$loginMysql = 'admin';
$passwordMysql = 'Teny123!';

// open a connection to the database
$connection = new PDO('mysql:host=localhost;dbname=login', $loginMysql, $passwordMysql);
$request = $connection->prepare('SELECT * FROM accounts WHERE username = ? AND password = ?');
$request->execute([$username, $password]);
$result= $request->fetch();
// check if the user exists in the database
if ($request->rowCount() > 0) {
    $_SESSION['id'] = $result['id'];
    header('Location: ../index.php');
} else {
    // send to the log.php page that the user does not exist
    header('Location: ../log.php?error=Username%20or%20password%20is%20incorrect');
}
?>