<?php
include "header.php";
include_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="presences.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prezențe</title>
</head>

<body>
    <h2>Prezențe Curs</h2>
    <div style="overflow-x:auto;">
        <table id="presence">
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
            <tr>
                <?php
                $id = $_SESSION["userId"];

                $sqlTD = "SELECT * FROM users WHERE idUsers='$id'";
                $resultTD = mysqli_query($conn, $sqlTD);
                $rowTD = mysqli_fetch_assoc($resultTD);

                echo "
                <td>" . $rowTD["usernameUsers"] . "</td>
                <td>" . $rowTD["secondnameUsers"] . "</td>
                ";
                $todayDate1 = date("Y-m-d");
                $joi1 = array("2020-04-02", "2020-04-09", "2020-04-16", "2020-04-23", "2020-04-30", "2020-05-07", "2020-05-14", "2020-05-21", "2020-05-28", "2020-06-04", "2020-06-11", "2020-06-18", "2020-06-25", "2020-07-02");
                $joi2 = array("242020", "942020", "1642020", "2342020", "3042020", "752020", "1452020", "2152020", "2852020", "462020", "1162020", "1862020", "2562020", "272020");
                $contorCurs = 0;
                for ($i = 0; $i < 14; $i++) {
                    if ($todayDate1 >= $joi1[$i]) {
                        $sql95 = "SELECT prezent FROM presences WHERE userId='$id'";
                        $result95 = mysqli_query($conn, $sql95);
                        $row95 = mysqli_fetch_assoc($result95);
                        $state95 = $row95["prezent"];
                        if (strstr($state95, $joi2[$i]) == true) {
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
                ?>
            </tr>
        </table>
    </div>
    <h2>Prezențe Seminar</h2>
    <div style="overflow-x:auto;">
        <table id="presence">
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
            <tr>
                <?php
                $id = $_SESSION["userId"];

                $sqlTD = "SELECT * FROM users WHERE idUsers='$id'";
                $resultTD = mysqli_query($conn, $sqlTD);
                $rowTD = mysqli_fetch_assoc($resultTD);

                echo "
                <td>" . $rowTD["usernameUsers"] . "</td>
                <td>" . $rowTD["secondnameUsers"] . "</td>
                ";
                $todayDate3 = date("Y-m-d");
                $joi1 = array("2020-04-02", "2020-04-09", "2020-04-16", "2020-04-23", "2020-04-30", "2020-05-07", "2020-05-14", "2020-05-21", "2020-05-28", "2020-06-04", "2020-06-11", "2020-06-18", "2020-06-25", "2020-07-02");
                $joi2 = array("242020", "942020", "1642020", "2342020", "3042020", "752020", "1452020", "2152020", "2852020", "462020", "1162020", "1862020", "2562020", "272020");
                $contorSeminar = 0;
                for ($i = 0; $i < 14; $i++) {
                    if ($todayDate3 >= $joi1[$i]) {
                        $sql96 = "SELECT prezent FROM presencesSeminar WHERE userId='$id'";
                        $result96 = mysqli_query($conn, $sql96);
                        $row96 = mysqli_fetch_assoc($result96);
                        $state96 = $row96["prezent"];
                        if (strstr($state96, $joi2[$i]) == true) {
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
                ?>
            </tr>
        </table>
    </div>
</body>

</html>