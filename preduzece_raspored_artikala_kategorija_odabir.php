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

    // Ukoliko korisnik nije preduzece unisti sesiju i vrati ga na index stranu
    if ($_SESSION['tip_korisnika'] != 'P') {
        unset($_SESSION['ime']);
        unset($_SESSION['korisnicko_ime']);
        unset($_SESSION['tip_korisnika']);
        unset($_SESSION['prva_prijava']);
        session_destroy();
        header('Location:index.php');
    }
    $korisnicko_ime = $_SESSION['korisnicko_ime'];
    require_once('dbconnection.php');

    $result1 = mysqli_query($con, "SELECT * FROM kategorija WHERE id_kategorije = '" . $_SESSION['id_kategorije'] . "'");
    $row1 = mysqli_fetch_array($result1);
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
            <a href="preduzece.php" target="">Pocetna strana</a> <br /><br />
            <a href="preduzece_izmena_podataka.php" target="">Podaci o preduzecu</a> <br /><br />
            <a href="preduzece_narucioci.php" target="">Narucioci</a> <br /><br />
            <a href="preduzece_robe_usluge.php" target="">Robe i usluge</a> <br /><br />
            <a href="preduzece_raspored_artikala.php" target="">Raspored artikala</a> <br /><br />
            <a href="preduzece_izdavanje_racuna.php" target="">Izdavanje racuna</a> <br /><br />
            <a href="preduzece_pregled_izvestaja.php" target="">Pregled izvestaja</a>
        </div>
        <div id="right_menu">
            <p id="center">Odabrana kategorija: <?php echo $row1['kategorija'] ?></p>

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
            require_once('preduzece_raspored_artikala_kategorija_pretraga.php');
            ?>

        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>