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
    $id_preduzeca = $_SESSION['id_preduzeca'];
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

        <!-- POLJE U KOJE SE UNOSI NAZIV ZELJENOG ARTIKLA -->
        <div id="right_menu">
            <!-- PRETRAGA ARTIKALA -->
            <form name="forma1" method="POST" action="">
                <table id="tabela_1">
                    <tr>
                        <td>Naziv artikla:</td>
                        <td><input type="text" name="naziv_artikla"></td>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="pretraga" value="PRETRAZI">
                        </td>
                    </tr>
                </table>
            </form>

            <br />
            <!--PHP REZULTATI PRETRAGE-->
            <?php
            require_once('kupac_pregled_artikala_nastavak_pretraga.php');
            ?>

        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>