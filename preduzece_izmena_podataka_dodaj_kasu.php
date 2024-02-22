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
    require_once('preduzece_izmena_podataka_dodaj_kasu_provera.php');

    $upit1 = "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result1 = mysqli_query($con, $upit1);
    $row1 = mysqli_fetch_array($result1);

    $upit3 = "SELECT * FROM fiskalna_kasa";
    ?>

    <!--HEADER-->
    <?php
    require_once('header_div.php');
    ?>

    <!--LOG-OUT-->
    <?php
    require_once('logout.php');
    ?>

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
            <form name="forma_nova_fk" method="POST" onsubmit="return(proverinovufk())">
                <table id="tabela_1">
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="kor_ime" value="<?php echo $row1['korisnicko_ime']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="broj_objekata" value="<?php echo $row1['broj_objekata']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id_pred" value="<?php echo $row1['id_preduzeca']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><br />Dodajte novu fiskalnu kasu:</td>
                    </tr>
                    <tr>
                        <td>Fiskalna kasa:</td>
                        <td>
                            <input type="text" name="objekat" id="objekat" placeholder="Naziv objekta">
                            |
                            <input type="text" name="lokacija" id="lokacija" placeholder="Lokacija objekta">
                            |
                            <select name="kasa" id="kasa">
                                <?php
                                $result3 = mysqli_query($con, $upit3);
                                if (mysqli_num_rows($result3) > 0) {
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                ?>
                                        <option value="<?php echo $row3['vrsta_kase']; ?>"><?php echo $row3['vrsta_kase']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="dodaj_novu_kasu" value="DODAJ KASU">
                        </td>
                    </tr>
                </table>
            </form>

            <!--PHP ISPIS PORUKE NAKON UNOSA NOVIH PODATAKA-->
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