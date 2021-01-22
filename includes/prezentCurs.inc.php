<?php

session_start();
include_once 'dbh.inc.php';

if (isset($_POST["cursPrezent"])) {

    $id = $_SESSION["userId"];
    $today = getdate();
    $todayDate = $today["mday"] . $today["mon"] . $today["year"] . " ";

    $sql01 = "SELECT * FROM presences WHERE userId='$id'";
    $result01 = mysqli_query($conn, $sql01);
    $row01 = mysqli_fetch_assoc($result01);

    $todayDateActual = $row01["prezent"] . $todayDate;

    $sql = "UPDATE presences SET prezent='$todayDateActual' WHERE userId='$id'";
    mysqli_query($conn, $sql);

    header("Location: ../index.php?prezent=succes");
    exit();
}