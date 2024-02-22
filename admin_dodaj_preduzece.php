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
    require_once('admin_dodaj_preduzece_provera.php');
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

        <div id="right_menu">
            <p id="center">Dodaj preduzece:</p>
            <form name="dodaj_preduzece" method="POST" onsubmit="return(admindodajpreduzece())">
                <table id="tabela_1">
                    <tr>
                        <td>Ime:</td>
                        <td><input type="text" name="ime"></td>
                    </tr>
                    <tr>
                        <td>Prezime:</td>
                        <td><input type="text" name="prezime"></td>
                    </tr>
                    <tr>
                        <td>Korisnicko ime:</td>
                        <td><input type="text" name="kor_ime"></td>
                    </tr>
                    <tr>
                        <td>Lozinka:</td>
                        <td><input type="password" name="lozinka1"></td>
                    </tr>
                    <tr>
                        <td>Potvrda lozinke:</td>
                        <td><input type="password" name="lozinka2"></td>
                    </tr>
                    <tr>
                        <td>Kontakt telefon:</td>
                        <td><input type="text" name="telefon"></td>
                    </tr>
                    <tr>
                        <td>I-mejl adresa:</td>
                        <td><input type="text" name="mejl_adresa"></td>
                    </tr>
                    <tr>
                        <td>Naziv preduzeca:</td>
                        <td><input type="text" name="naziv_preduzeca"></td>
                    </tr>
                    <tr>
                        <td>Drzava:</td>
                        <td><input type="text" name="drzava"></td>
                    </tr>
                    <tr>
                        <td>Grad:</td>
                        <td><input type="text" name="grad"></td>
                    </tr>
                    <tr>
                        <td>Postanski broj:</td>
                        <td><input type="text" name="postanski_broj"></td>
                    </tr>
                    <tr>
                        <td>Ulica i broj:</td>
                        <td><input type="text" name="ulica_broj"></td>
                    </tr>
                    <tr>
                        <td>PIB:</td>
                        <td><input type="text" name="pib" maxlength="9"></td>
                    </tr>
                    <tr>
                        <td>Maticni broj:</td>
                        <td><input type="text" name="maticni_broj" maxlength="8"></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="dodaj_preduzece" value="DODAJ PREDUZECE">
                        </td>
                    </tr>
                </table>
            </form>

            <!--PHP ISPIS PORUKE NAKON DODAVANJA NOVOG KUPCA-->
            <div id="center">
                <?php echo $poruka_preduzece; ?>
            </div>
            
        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>