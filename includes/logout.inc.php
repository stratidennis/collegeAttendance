<?php

if (isset($_POST["submitLogout"])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}