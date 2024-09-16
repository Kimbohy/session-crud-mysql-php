<?php
session_start();
if (isset($_SESSION['id']))
{

    $loginMysql = 'admin';
    $passwordMysql = 'Teny123!';
    $dsn = 'mysql:host=localhost;dbname=ecole';
    echo '<link href="./output.css" rel="stylesheet">';
}
else {
    header('Location: log.php');
}
?>