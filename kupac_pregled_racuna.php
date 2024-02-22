<?php
ob_start();
?>
<!DOCTYPE html>

<html>

<!--HEAD-->

<head>
    <title>Fiskalizacija - Srbija</title>
    <meta charset="UTF-8">
    <meta name="author" content="Esmir Pljakic">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, Fiskalizacija">

    <link rel="stylesheet" type="text/css" href="stilovi.css" />
    <script src="jsfajl.js"></script>
</head>

<body>

    <!--PHP-->
    <?php
    ob_start();
    session_start();

    // Ukoliko korisnik nije kupac unisti sesiju i vrati ga na index stranu
    if ($_SESSION['tip_korisnika'] != 'K') {
        unset($_SESSION['ime']);
        unset($_SESSION['korisnicko_ime']);
        unset($_SESSION['tip_korisnika']);
        unset($_SESSION['prva_prijava']);
        session_destroy();
        header('Location:index.php');
    }
    $korisnicko_ime = $_SESSION['korisnicko_ime'];
    require_once('dbconnection.php');
    ?>

    <!--HEADER-->
    <?php
    require_once('header_div.php');
    ?>

    <!--LOG-OUT-->
    <?php
    require_once('logout.php');
    ?>

    <!--SADRZAJ leva strana i desna strana-->
    <div id="content">

        <div id="left_menu">
            <a href="kupac.php" target="">Pocetna strana</a> <br /><br />
            <a href="kupac_pregled_artikala.php" target="">Pregled artikala</a> <br /><br />
            <a href="kupac_pregled_racuna.php" target="">Pregled racuna</a> <br /><br />
            <a href="kupac_potrosnja.php" target="">Potrosnja</a> <br /><br />
        </div>

        <!-- PRIKAZ SVIH RACUNA U KOJIMA SE NALAZI BROJ LICNE KARTE PRIJAVLJENOG KUPCA -->
        <div id="right_menu">
            <p id="center">Racuni u svim preduzecima:</p>
            <?php
            $result1 = mysqli_query($con, "SELECT * FROM kupac WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
            $row1 = mysqli_fetch_array($result1);

            $result2 = mysqli_query($con, "SELECT * FROM racun WHERE licna_karta = '" . $row1['licna_karta'] . "'");
            ?>

            <table id="tabela_1">
                <tr>
                    <th>Naziv preduzeca &nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Naziv objekta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Iznos racuna &nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Nacin placanja &nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Dodatne informacije</th>
                </tr>

                <?php
                $poruka2 = "";
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_array($result2)) {
                        $placanje = "";

                        $result3 = mysqli_query($con, "SELECT * FROM preduzece WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "'");
                        $row3 = mysqli_fetch_array($result3);

                        $result4 = mysqli_query($con, "SELECT * FROM roba_sa_racuna WHERE id_racuna = '" . $row2['id_racuna'] . "'");
                        if (mysqli_num_rows($result4) > 0) {
                            while ($row4 = mysqli_fetch_array($result4)) {
                                $id_artikla = $row4['id_artikla'];
                                break;
                            }
                        }

                        $result5 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $id_artikla . "'");
                        $row5 = mysqli_fetch_array($result5);

                        $result6 = mysqli_query($con, "SELECT * FROM objekat WHERE id_objekta = '" . $row5['id_objekta'] . "'");
                        $row6 = mysqli_fetch_array($result6);

                        if ($row2['ime'] != "") {
                            $placanje = "Cek";
                        } else {
                            $placanje = "Kartica";
                        }
                ?>
                        <form name="kupac" method="POST" action="">
                            <tr>
                                <td>
                                    <?php echo $row3['naziv']; ?>
                                    <input type="hidden" value="<?php echo $row2['id_racuna']; ?>" name="id_racuna">
                                </td>
                                <td><?php echo $row6['naziv']; ?></td>
                                <td><?php echo $row2['iznos_racuna']; ?>din.</td>
                                <td><?php echo $placanje; ?></td>
                                <td><input type="submit" id="dugme_1" name="odaberi" value="ODABERI"></td>
                            </tr>
                        </form>

                <?php
                    }
                } else {
                    $poruka2 = "<span style='color:red'> Niste nista kupovali! </span>";
                }
                ?>

                <!--PHP ISPIS PORUKE NAKON IZBORA RACUNA-->
                <div id="center">
                    <?php
                    echo $poruka2;
                    if (!empty($_POST['odaberi'])) {
                        $_SESSION['id_rac'] = $_POST['id_racuna'];
                        header('Location:kupac_pregled_racuna_detalji.php');
                        exit();
                    }
                    ?>
                </div>

            </table>
        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>