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

    // Ukoliko korisnik nije administrator unisti sesiju i vrati ga na index stranu
    if ($_SESSION['tip_korisnika'] != 'A') {
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
            <a href="administrator.php" target="">Pocetna strana</a> <br /><br />
            <a href="admin_zahtevi.php" target="">Zahtevi preduzeca</a> <br /><br />
            <a href="admin_dodaj_kupca.php" target="">Dodaj kupca</a> <br /><br />
            <a href="admin_dodaj_preduzece.php" target="">Dodaj preduzece</a> <br /><br />
            <a href="admin_izvestaj.php" target="">Dnevni izvestaji</a>
        </div>

        <!-- POCETNA STRANA ADMINISTRATORA -->
        <div id="right_menu">
            <?php
            $result = mysqli_query($con, "select * from korisnik where korisnicko_ime='" . $korisnicko_ime . "'");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
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
                    <td><?php echo $row['ime']; ?></td>
                </tr>
                <tr>
                    <td>Prezime:</td>
                    <td><?php echo $row['prezime']; ?></td>
                </tr>
                <tr>
                    <td>Kontakt telefon:</td>
                    <td><?php echo $row['kontakt_telefon']; ?></td>
                </tr>
                <tr>
                    <td>I-mejl adresa:</td>
                    <td><?php echo $row['mejl_adresa']; ?></td>
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