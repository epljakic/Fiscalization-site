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

        <!-- ODABIR PREDUZECA U KOJEM CE SE DALJE TRAZITI ARTIKLI -->
        <div id="right_menu">
            <?php
            $result1 = mysqli_query($con, "SELECT * FROM preduzece");
            ?>

            <p id="center">Izaberite preduzece:</p>
            <table id="tabela_1">
                <tr>
                    <th>Naziv preduzeca</th>
                    <th>Odaberi</th>
                </tr>

                <?php
                $poruka2 = "";
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_array($result1)) {
                        $result2 = mysqli_query($con, "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $row1['korisnicko_ime'] . "'");
                        $row2 = mysqli_fetch_array($result2);
                        if ($row2['status'] == "aktivan") {
                ?>
                            <form name="preduzeca" method="POST">
                                <tr>
                                    <td>
                                        <?php echo $row1['naziv']; ?>
                                        <input type="hidden" value="<?php echo $row1['id_preduzeca'] ?>" name="id_preduzeca">
                                    </td>
                                    <td><input type="submit" id="dugme_1" name="odaberi" value="ODABERI"></td>
                                </tr>
                            </form>
                <?php
                        }
                    }
                } else {
                    $poruka2 = "<span style='color:red'> Ne postoje registrovana preduzeca! </span>";
                }
                ?>
            </table>

            <!--PHP ISPIS PORUKE NAKON IZBORA PREDUZECA-->
            <div id="center">
                <?php
                echo $poruka2;
                if (!empty($_POST['odaberi'])) {
                    $_SESSION['id_preduzeca'] = $_POST['id_preduzeca'];
                    header('Location:kupac_pregled_artikala_nastavak.php');
                    exit();
                }
                ?>
            </div>

        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>