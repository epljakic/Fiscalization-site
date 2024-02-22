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
    $id_artikla = $_SESSION['id_artikla'];

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

        <!-- NAKON ODABIRA ARTIKLA OVDE SE PRONALAZI KOJA JE MIN. CENA TOG ARTIKLA I U KOM OBJEKTU SE NALAZI -->
        <div id="right_menu">
            <?php
            $result1 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $id_artikla . "'");
            $row1 = mysqli_fetch_array($result1);

            $result2 = mysqli_query($con, "SELECT * FROM preduzece WHERE id_preduzeca = '" . $row1['id_preduzeca'] . "'");
            $row2 = mysqli_fetch_array($result2);

            $result3 = mysqli_query($con, "SELECT * FROM objekat WHERE id_objekta = '" . $row1['id_objekta'] . "'");
            $row3 = mysqli_fetch_array($result3);

            $poruka1 = "Trenutno posmatrani artikal se nalazi u preduzecu <b>" . $row2['naziv'] . "</b>. U objektu <b>" . $row3['naziv'] . "</b>";
            ?>

            <div id="center">
                <?php echo $poruka1; ?>
                <br /><br />
            </div>

            <?php
            $minimalna_cena = (float)$row1['prodajna_cena'];
            $id_pred_min = $row1['id_preduzeca'];
            $id_obj_min = $row1['id_objekta'];

            $result4 = mysqli_query($con, "SELECT * FROM artikal WHERE naziv LIKE '%" . $row1['naziv'] . "%'");
            if (mysqli_num_rows($result4) > 0) {
                while ($row4 = mysqli_fetch_array($result4)) {
                    if ((float)$row4['prodajna_cena'] < $minimalna_cena) {
                        $minimalna_cena = (float)$row4['prodajna_cena'];
                        $id_pred_min = $row4['id_preduzeca'];
                        $id_obj_min = $row4['id_objekta'];
                    }
                }
            }

            $result5 = mysqli_query($con, "SELECT * FROM preduzece WHERE id_preduzeca = '" . $id_pred_min . "'");
            $row5 = mysqli_fetch_array($result5);

            $result6 = mysqli_query($con, "SELECT * FROM objekat WHERE id_objekta = '" . $id_obj_min . "'");
            $row6 = mysqli_fetch_array($result6);

            $poruka2 = "Minimalna prodajna cena ovog artikla je: <b>" . $minimalna_cena . "din.</b> <br />" .
                "Ovaj artikal se nalazi u preduzecu <b>" . $row5['naziv'] . "</b>. U objektu <b>" . $row6['naziv'] . "</b>";
            ?>

            <div id="center">
                <?php echo $poruka2; ?>
                <br /><br />
            </div>

        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>