<?php

session_start();
include_once 'dbh.inc.php';
$id = $_SESSION["userId"];

if (isset($_POST['passwordSubmit'])) {

    $introducedCurrentPassword = $_POST['currentpassword'];
    $newPassword1 = $_POST['newpassword'];
    $newPassword2 = $_POST['repeatpassword'];

    $sql003 = "SELECT * FROM users WHERE idUsers='$id'";
    $result003 = mysqli_query($conn, $sql003);
    $row003 = mysqli_fetch_assoc($result003);
    $actualPassword = $row003['pwdUsers'];

    if (empty($introducedCurrentPassword) || empty($newPassword1) || empty($newPassword2)) { /*Checking if the user left empty fields*/
        header("Location: ../changePassword.php?error=emptyfieldsPassword");
        exit();
    } else if ($introducedCurrentPassword != $actualPassword) {
        header("Location: ../changePassword.php?wrongcurrentpasswordintroduced");
        exit();
    } else if ($newPassword1 != $newPassword2) {
        header("Location: ../changePassword.php?newpasswordsdontmatch");
        exit();
    } else {
        $sql021 = "UPDATE users SET pwdUsers='$newPassword1' WHERE idUsers='$id'";
        mysqli_query($conn, $sql021);
        header("Location: ../changePassword.php?newpasswordsuccess");
        exit();
    }
} else {
    header("Location: ../changePassword.php");
    exit();
}
