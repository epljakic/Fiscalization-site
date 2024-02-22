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
    require_once('preduzece_prva_prijava_provera.php');
    ?>

    <!--HEADER-->
    <?php
    require_once('header_div.php');
    ?>

    <!------- MISLIM DA NIJE POTREBNO OBEZBEDITI LOG-OUT OVDE NA OVOJ STRANI------->


    <div id="lozinka_content">
        <form name="forma_preduzece_doc" method="POST" onsubmit="return(proveriinfpreduzece())">
            <table id="tabela_1">
                <tr>
                    <td colspan="2" id="center">
                        Pre nastavka rada sa sistemom neophodno je popuniti sledecu formu:
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="hidden" name="kor_ime" value="<?php echo $korisnicko_ime; ?>"></td>
                </tr>
                <tr>
                    <td>Broj delatnosti:</td>
                    <td><input type="text" name="broj_delatnosti"></td>
                </tr>
                <tr>
                    <td>PDV sistem?</td>
                    <td><input type="checkbox" name="pdv_cb" value="0"></td>
                </tr>
                <tr>
                    <td>Broj ziro racuna:</td>
                    <td><input type="text" name="broj_ziro_racuna"></td>
                </tr>
                <tr>
                    <td>Broj fiskalnih kasa:</td>
                    <td><input type="text" name="broj_fiskalnih_kasa"></td>
                </tr>

                <tr>
                    <td colspan="2" id="center">
                        <input type="submit" id="dugme_1" name="dodaj_podatke" value="DODAJ PODATKE">
                    </td>
                </tr>
            </table>
        </form>

        <!--PHP ISPIS PORUKE NAKON UNOSA NOVIH PODATAKA-->
        <div id="center">
            <?php echo $poruka1; ?>
        </div>

    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>