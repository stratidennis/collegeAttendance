<?php
require "header.php";
include_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="changePassword.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schimbare parolă</title>
</head>

<body>
    <div class='change'>Schimbare parolă</div>
    <div class='box'>
        <form action='includes/changePassword.inc.php' method='post'>
            <input class='inputsP' type='password' name='currentpassword' placeholder='Parola curentă'>
            <input class='inputsP' type='password' name='newpassword' placeholder='Parola nouă'>
            <input class='inputsP' type='password' name='repeatpassword' placeholder='Repetă parola nouă'>
            <button class='schimba' type='submit' name='passwordSubmit'>Schimbă</button>
        </form>
    </div>
    <?php
    /*Displaying errors if necessary*/
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (strpos($fullUrl, "error=emptyfieldsPassword") == true) {
        echo "<p class='error'>Nu au fost completate toate câmpurile!</p>";
    } elseif (strpos($fullUrl, "wrongcurrentpasswordintroduced") == true) {
        echo "<p class='error'>Parolă curentă greșită!</p>";
    } elseif (strpos($fullUrl, "newpasswordsdontmatch") == true) {
        echo "<p class='error'>Parolele noi nu se potrivesc!</p>";
    } elseif (strpos($fullUrl, "newpasswordsuccess") == true) {
        echo "<p class='success'>Parolă schimbată cu succes.</p>";
    }
    ?>
</body>

</html>