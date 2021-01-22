<?php

function checkPassword($password,$checkPassword) {
    if ($password==$checkPassword)
        return true;
    else
        return false;
}

if (isset($_POST["submitButton"])) {

    require "dbh.inc.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) { /*Checking if the user left empty fields*/
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidemail");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = checkPassword($password, $row["pwdUsers"]);
                if ($pwdCheck == false) { /*Checking if the password is correct*/
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                } else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION["userId"] = $row["idUsers"];
                    $_SESSION["userUid"] = $row["emailUsers"];

                    header("Location: ../index.php?login=succes");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nonexistentemail");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}