<?php
session_start();
include_once "includes/dbh.inc.php";
date_default_timezone_set('Europe/Bucharest');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="header.css">
    <link href="https://fonts.googleapis.com/css2?family=Gotu&display=swap" rel="stylesheet">
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <nav>
            <?php
            if (isset($_SESSION["userId"])) {
                echo "<div class='logoutForm'>";

                $id = $_SESSION["userId"];
                $sql = "SELECT * FROM users WHERE idUsers='$id'";
                $result = mysqli_query($conn, $sql);
                $row =mysqli_fetch_assoc($result);

                echo "
                <p class='elements firstElement'><a href='index.php'>Acasă</a></p>
                ";
                if ($row["rankUsers"]=="nimic") {
                    echo "
                    <p class='elements'><a href='presence.php'>Prezențele mele</a></p>
                    ";
                }
                echo "
                <p class='elements'><a href='changePassword.php'>Schimbare parolă</a></p>
                ";
                echo "
                <form action='includes/logout.inc.php' method='post'>
                    <button type='submit' name='submitLogout' class='elements logoutButton'>Deconectare</button>
                </form>
                ";
                echo "</div>";
            } else {
                echo "
                <form action='includes/login.inc.php' method='post'>
                    <ul class='loginForm'>
                        <li><input type='text' placeholder='Email' name='email' class='inputs inputs2 firstInput'></li>
                        <li><input type='password' placeholder='Parola' name='password' class='inputs inputs2'></li>
                        <li><button type='submit' name='submitButton' class='inputs'>Conectare</button></li>
                    </ul>
                </form>
                ";
            }
            ?>
        </nav>
    </header>
</body>

</html>