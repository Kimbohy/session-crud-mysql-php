<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="flex items-center justify-center w-screen h-screen bg-green-200">
        <form action="./forgotPassword.php" method="get" class="flex flex-col gap-10 px-10 py-12 bg-emerald-600 rounded-xl">
            <h1 class="text-3xl text-white">Reset Password</h1>
            <input type="text" name="username" placeholder="Username" class="h-10 p-2 rounded-lg w-96" required>
            <a href="../index.php" class="w-full text-white underline text-end">go back</a>
            <button type="submit" class="h-10 text-white rounded-lg bg-emerald-700 hover:bg-emerald-800" >Reset</button>
            <?php
                // Check if the username is set in the GET request
                if (isset($_GET['username'])) {
                    // Get the username from the form
                    $username = $_GET['username'];

                    // open a connection to the database
                    $mysqlUser = 'admin';
                    $mysqlPassword = 'Teny123!';

                    try {
                        $connection = new PDO('mysql:host=localhost;dbname=login', $mysqlUser, $mysqlPassword);
                        // set the PDO error mode to exception
                        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Prepare the SQL statement
                        $request = $connection->prepare('SELECT * FROM accounts WHERE username = ?');
                        $request->execute([$username]);

                        // check if the user exists in the database
                        if ($request->rowCount() > 0) {
                            // get the user's email address
                            $user = $request->fetch(); 
                            $email = $user['email'];

                            // send an email to the user with a link to reset the password
                            if(mail($email, 'Reset Password', 'Your password is set to 123456.', 'From: kim@fito.com')) {
                                echo 'An email has been sent to ' . $email;
                                $changePassword = $connection->prepare('UPDATE accounts SET password = ? WHERE username = ?');
                                $changePassword->execute(['123456', $username]);
                            } else {
                                echo 'An error occurred while sending the email';
                            }
                        } else {
                            echo 'User does not exist';
                        }
                    } catch (PDOException $e) {
                        echo 'Connection failed: ' . $e->getMessage();
                    }
                }
                ?>
        </form>
    </div>
</body>
</html>
