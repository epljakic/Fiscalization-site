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
            <?php
            if (count($_SESSION['korpa']) > 0) {
            ?>
                <p id="center">Odaberite nacin placanja:</p>
                <table id="tabela_1">
                    <tr>
                        <td>Gotovina</td>
                        <td><a href="preduzece_izdavanje_racuna_gotovina.php" target="">ODABERI</a></td>
                    </tr>
                    <tr>
                        <td>Cek</td>
                        <td><a href="preduzece_izdavanje_racuna_cek.php" target="">ODABERI</a></td>
                    </tr>
                    <tr>
                        <td>Kartica</td>
                        <td><a href="preduzece_izdavanje_racuna_kartica.php" target="">ODABERI</a></td>
                    </tr>
                    <tr>
                        <td>Virman</td>
                        <td><a href="preduzece_izdavanje_racuna_virman.php" target="">ODABERI</a></td>
                    </tr>
                </table>
            <?php
            } else {
                echo "<p id='center' style='color:red'> Nema artikala u korpi! </p>";
            }
            ?>
        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>