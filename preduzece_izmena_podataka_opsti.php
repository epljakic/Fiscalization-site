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
    require_once('preduzece_izmena_podataka_opsti_provera.php');
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
            <form name="opsti_podaci" method="POST" onsubmit="return(proveriopstepodatke())">
                <table id="tabela_1">
                    <tr>
                        <td colspan="2" id="center">Izmena opstih informacija:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="kor_ime" value="<?php echo $korisnicko_ime; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Ime:</td>
                        <td><input type="text" name="ime" value="<?php echo $row1['ime']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Prezime:</td>
                        <td><input type="text" name="prezime" value="<?php echo $row1['prezime']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Kontakt telefon:</td>
                        <td><input type="text" name="telefon" value="<?php echo $row1['kontakt_telefon']; ?>"></td>
                    </tr>
                    <tr>
                        <td>I-mejl adresa:</td>
                        <td><input type="text" name="mejl_adresa" value="<?php echo $row1['mejl_adresa']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Naziv preduzeca:</td>
                        <td><input type="text" name="naziv_preduzeca" value="<?php echo $row2['naziv']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Drzava:</td>
                        <td><input type="text" name="drzava" value="<?php echo $row2['drzava']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Grad:</td>
                        <td><input type="text" name="grad" value="<?php echo $row2['grad']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Postanski broj:</td>
                        <td><input type="text" name="postanski_broj" value="<?php echo $row2['postanski_broj']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Ulica i broj:</td>
                        <td><input type="text" name="ulica_broj" value="<?php echo $row2['ulica_broj']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Pib:</td>
                        <td><input type="text" name="pib" value="<?php echo $row2['pib']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Maticni broj:</td>
                        <td><input type="text" name="maticni_broj" value="<?php echo $row2['maticni_broj']; ?>"></td>
                    </tr>
                    <tr>
                        <td>PDV:</td>
                        <td>
                            <input type="checkbox" name="pdv" <?php
                                                                if ($row2['pdv'] == 1) {
                                                                    echo "checked";
                                                                }
                                                                ?>>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="izmena_opste" value="IZMENI PODATKE">
                        </td>
                    </tr>
                </table>
            </form>

            <!--PHP ISPIS PORUKE NAKON IZMENE PODATAKA-->
            <div id="center">
                <?php echo $poruka2; ?>
            </div>
        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>