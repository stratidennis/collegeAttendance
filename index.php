<?php
require "header.php";
include_once "includes/dbh.inc.php";
include_once "includes/estePrezent.inc.php";
?>

<main>

    <head>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="tabelTeacher.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acasă</title>
    </head>

    <body>
        <?php
        if (!isset($_SESSION["userId"])) {
            echo "
            <p class='grey'>Nu folosiți parole pe care le folosiți pe alte webiste-uri. Acest website nu este perfect securizat.</p>
            ";
        }
        /*Displaying errors if necessary*/
        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (strpos($fullUrl, "error=emptyfields") == true) {
            echo "<p class='error'>Nu au fost completate toate câmpurile!</p>";
        } elseif (strpos($fullUrl, "error=invalidemail") == true) {
            echo "<p class='error'>Adresa de email introdusă nu este una validă!</p>";
        } elseif (strpos($fullUrl, "error=wrongpassword") == true) {
            echo "<p class='error'>Parolă greșită!</p>";
        } elseif (strpos($fullUrl, "error=sqlerror") == true) {
            echo "<p class='error'>Something went wrong! Please try again.</p>";
        } elseif (strpos($fullUrl, "error=nonexistentemail") == true) {
            echo "<p class='error'>Email-ul introdus ne este înregistrat in baza de date!</p>";
        }
        
        $today = getdate();
        $todayDate = $today["mday"] . $today["mon"] . $today["year"];
        if (isset($_SESSION["userId"])) {

            $id = $_SESSION["userId"];

            $sql = "SELECT * FROM users WHERE idUsers='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row["rankUsers"] == "nimic") {
                echo "
                <div class='presences'>
                    <div class='curs'>
                        <div class='variantText'>Curs</div>
                        <div class='cursPresence'>
                            
                ";
                if ($today["wday"] == 4) {
                    if (($today["hours"] >= 8) && ($today["hours"] < 10)) {
                        $sql01 = "SELECT * FROM presences WHERE userId='$id'";
                        $result01 = mysqli_query($conn, $sql01);
                        $row01 = mysqli_fetch_assoc($result01);
                        $state01 = $row01["prezent"];
                        if (estePrezent($state01)) {
                            echo "<div class='confirm'>Prezență confirmată.</div>";
                        } else {
                            echo "
                            <form action='includes/prezentCurs.inc.php' method='post'>
                                <button type='submit' name='cursPrezent'>Prezent/ă</button>
                            </form>
                            ";
                        }
                    } else {
                        echo "
                        <div class='notNow'>Cursul se desfășoară doar joi între 8 și 10. Poți reveni atunci pentru a-ți marca prezența.</div>
                        ";
                    }
                } else {
                    echo "
                    <div class='notNow'>Cursul se desfășoară doar joi între 8 și 10. Poți reveni atunci pentru a-ți marca prezența.</div>
                    ";
                }
                echo "
                    </div> <!--CLOSING CURSPRESENCE DIV FROM ROW 32 -->
                </div> <!--CLOSING CURS DIV FROM ROW 30 -->
                ";
                echo "
                <div class='seminar'>
                    <div class='variantText'>Seminar</div>
                    <div class='seminarPresence'>
                ";
                if ($today["wday"] == 4) {
                    if (($today["hours"] >= 10) && ($today["hours"] < 12)) {
                        $sql02 = "SELECT * FROM presencesSeminar WHERE userId='$id'";
                        $result02 = mysqli_query($conn, $sql02);
                        $row02 = mysqli_fetch_assoc($result02);
                        $state02 = $row02["prezent"];
                        if (estePrezent($state02)) {
                            echo "<div class='confirm'>Prezență confirmată.</div>";
                        } else {
                            echo "
                            <form action='includes/prezentSeminar.inc.php' method='post'>
                                <button type='submit' name='seminarPrezent'>Prezent/ă</button>
                            </form>
                            ";
                        }
                    } else {
                        echo "
                        <div class='notNow'>Seminarul se desfășoară doar joi între 10 și 12. Poți reveni atunci pentru a-ți marca prezența.</div>
                        ";
                    }
                } else {
                    echo "
                    <div class='notNow'>Seminarul se desfășoară doar joi între 10 și 12. Poți reveni atunci pentru a-ți marca prezența.</div>
                    ";
                }
                echo "
                        </div> <!-- CLOSING SEMINARPRESENCE DIV FROM ROW 56-->
                    </div> <!-- CLOSING SEMINAR DIV FROM ROW 54-->
                </div> <!-- CLOSING PRESENCES DIV FROM ROW 29-->
                ";
            }
        }
        ?>
        <?php
        if (isset($_SESSION["userId"])) {
            $id = $_SESSION["userId"];

            $sql = "SELECT * FROM users WHERE idUsers='$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row["rankUsers"] == "teacher") {
                echo "
                <h2>Prezențe Curs</h2>
                <div style='overflow-x:auto;'>
                <table id='presence'>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>2.4.2020</th>
                        <th>9.4.2020</th>
                        <th>16.4.2020</th>
                        <th>23.4.2020</th>
                        <th>30.4.2020</th>
                        <th>7.5.2020</th>
                        <th>14.5.2020</th>
                        <th>21.5.2020</th>
                        <th>28.5.20202</th>
                        <th>4.6.2020</th>
                        <th>11.6.2020</th>
                        <th>18.6.2020</th>
                        <th>25.6.2020</th>
                        <th>2.7.2020</th>
                        <th>Total prezențe</th>
                    </tr>
                ";
                for ($k = 1; $k < 27; $k++) {
                    $sql708 = "SELECT * FROM users WHERE idUsers='$k'";
                    $result708 = mysqli_query($conn, $sql708);
                    $row708 = mysqli_fetch_assoc($result708);

                    echo "<tr>";
                    echo "<td>" . $row708["usernameUsers"] . "</td>";
                    echo "<td>" . $row708["secondnameUsers"] . "</td>";
                    $todayDate1 = date("Y-m-d");
                    $joi1 = array("2020-04-02", "2020-04-09", "2020-04-16", "2020-04-23", "2020-04-30", "2020-05-07", "2020-05-14", "2020-05-21", "2020-05-28", "2020-06-04", "2020-06-11", "2020-06-18", "2020-06-25", "2020-07-02");
                    $joi2 = array("242020", "942020", "1642020", "2342020", "3042020", "752020", "1452020", "2152020", "2852020", "462020", "1162020", "1862020", "2562020", "272020");
                    $contorCurs = 0;
                    for ($i = 0; $i < 14; $i++) {
                        if ($todayDate1 >= $joi1[$i]) {
                            $sql77 = "SELECT prezent FROM presences WHERE userId='$k'";
                            $result77 = mysqli_query($conn, $sql77);
                            $row77 = mysqli_fetch_assoc($result77);
                            $state77 = $row77["prezent"];
                            if (strstr($state77, $joi2[$i]) == true) {
                                echo "
                                <td class='green'>prezent</td>
                                ";
                                $contorCurs++;
                            } else {
                                if ($i >= 3 && $i <= 6) {
                                    echo "
                                    <td class='yellow'>vacanță</td>
                                    ";
                                } else {
                                echo "
                                <td class='red'>absent</td>
                                ";
                                }
                            }
                        } else {
                            echo "<td>-</td>";
                        }
                    }
                    echo "<td>" . $contorCurs . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
                echo "
                <h2>Prezențe Seminar</h2>
                <div style='overflow-x:auto;'>
                <table id='presence'>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>2.4.2020</th>
                        <th>9.4.2020</th>
                        <th>16.4.2020</th>
                        <th>23.4.2020</th>
                        <th>30.4.2020</th>
                        <th>7.5.2020</th>
                        <th>14.5.2020</th>
                        <th>21.5.2020</th>
                        <th>28.5.20202</th>
                        <th>4.6.2020</th>
                        <th>11.6.2020</th>
                        <th>18.6.2020</th>
                        <th>25.6.2020</th>
                        <th>2.7.2020</th>
                        <th>Total prezențe</th>
                    </tr>
                ";
                for ($k = 1; $k < 27; $k++) {
                    $sql708 = "SELECT * FROM users WHERE idUsers='$k'";
                    $result708 = mysqli_query($conn, $sql708);
                    $row708 = mysqli_fetch_assoc($result708);

                    echo "<tr>";
                    echo "<td>" . $row708["usernameUsers"] . "</td>";
                    echo "<td>" . $row708["secondnameUsers"] . "</td>";
                    $todayDate1 = date("Y-m-d");
                    $joi1 = array("2020-04-02", "2020-04-09", "2020-04-16", "2020-04-23", "2020-04-30", "2020-05-07", "2020-05-14", "2020-05-21", "2020-05-28", "2020-06-04", "2020-06-11", "2020-06-18", "2020-06-25", "2020-07-02");
                    $joi2 = array("242020", "942020", "1642020", "2342020", "3042020", "752020", "1452020", "2152020", "2852020", "462020", "1162020", "1862020", "2562020", "272020");
                    $contorSeminar = 0;
                    for ($i = 0; $i < 14; $i++) {
                        if ($todayDate1 >= $joi1[$i]) {
                            $sql77 = "SELECT prezent FROM presencesSeminar WHERE userId='$k'";
                            $result77 = mysqli_query($conn, $sql77);
                            $row77 = mysqli_fetch_assoc($result77);
                            $state77 = $row77["prezent"];
                            if (strstr($state77, $joi2[$i]) == true) {
                                echo "
                                <td class='green'>prezent</td>
                                ";
                                $contorSeminar++;
                            } else {
                                if ($i >= 3 && $i <= 6) {
                                    echo "
                                    <td class='yellow'>vacanță</td>
                                    ";
                                } else {
                                echo "
                                <td class='red'>absent</td>
                                ";
                                }
                            }
                        } else {
                            echo "<td>-</td>";
                        }
                    }
                    echo "<td>" . $contorSeminar . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
        }
        ?>
    </body>

</main>