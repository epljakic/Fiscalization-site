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

        <!-- POCETNA STRANA PREDUZECA -->
        <div id="right_menu">
            <?php
            $result1 = mysqli_query($con, "select * from korisnik where korisnicko_ime='" . $korisnicko_ime . "'");
            if (mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_assoc($result1);
            } else {
                echo "<span style='color:red'>Nemate informacije o sebi!</span>";
            }

            $result2 = mysqli_query($con, "select * from preduzece where korisnicko_ime='" . $korisnicko_ime . "'");
            if (mysqli_num_rows($result2) > 0) {
                $row2 = mysqli_fetch_assoc($result2);
            } else {
                echo "<span style='color:red'>Nemate informacije o sebi!</span>";
            }
            ?>
            <table id="tabela_1">
                <tr>
                    <td colspan="2" id="center">Osnovne informacije:</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ime:</td>
                    <td><?php echo $row1['ime']; ?></td>
                </tr>
                <tr>
                    <td>Prezime:</td>
                    <td><?php echo $row1['prezime']; ?></td>
                </tr>
                <tr>
                    <td>Kontakt telefon:</td>
                    <td><?php echo $row1['kontakt_telefon']; ?></td>
                </tr>
                <tr>
                    <td>I-mejl adresa:</td>
                    <td><?php echo $row1['mejl_adresa']; ?></td>
                </tr>
                <tr>
                    <td>Naziv preduzeca:</td>
                    <td><?php echo $row2['naziv']; ?></td>
                </tr>
                <tr>
                    <td>Drzava:</td>
                    <td><?php echo $row2['drzava']; ?></td>
                </tr>
                <tr>
                    <td>Grad:</td>
                    <td><?php echo $row2['grad']; ?></td>
                </tr>
                <tr>
                    <td>Postanski broj:</td>
                    <td><?php echo $row2['postanski_broj']; ?></td>
                </tr>
                <tr>
                    <td>Ulica i broj:</td>
                    <td><?php echo $row2['ulica_broj']; ?></td>
                </tr>
                <tr>
                    <td>Pib:</td>
                    <td><?php echo $row2['pib']; ?></td>
                </tr>
                <tr>
                    <td>Maticni broj:</td>
                    <td><?php echo $row2['maticni_broj']; ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>