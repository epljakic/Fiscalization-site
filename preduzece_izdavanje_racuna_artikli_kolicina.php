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
    $id_objekta = $_SESSION['id_objekta'];
    $id_artikla = $_SESSION['id_artikla'];

    require_once('dbconnection.php');
    require_once('preduzece_izdavanje_racuna_artikli_kolicina_provera.php');
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

        <!-- UNOS ZELJENE KOLICINE IZABRANOG ARTIKLA -->
        <div id="right_menu">
            <?php
            $result1 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
            $row1 = mysqli_fetch_array($result1);

            $result2 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $id_artikla . "'");
            $row2 = mysqli_fetch_array($result2);
            ?>

            <p id="center">Unesite kolicinu koju zelite:</p>
            <form name="kolicina" method="POST" onsubmit="return(proverikolicinu())">
                <table id="tabela_1">
                    <tr>
                        <td>Kolicina:</td>
                        <td><input type="text" name="kolicina"></td>
                    </tr>
                    <tr>
                        <td>Stanje na lageru:</td>
                        <td><?php echo $row2['lager']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="kupi" value="KUPI ARTIKAL">
                        </td>
                    </tr>
                </table>
            </form>

            <!--PHP ISPIS PORUKE NAKON NARUCIVANJA ARTIKLA-->
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