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
    require_once('preduzece_izmena_podataka_racuni_provera.php');
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
            $result1 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime='" . $korisnicko_ime . "'");
            if (mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_assoc($result1);
            } else {
                echo "<span style='color:red'>Nemate informacije o sebi!</span>";
            }

            $upit2 = "SELECT * FROM ziro_racun WHERE id_preduzeca='" . $row1['id_preduzeca'] . "'";
            ?>
            <form name="ziro_racun" method="POST" onsubmit="return(proveriziroracune())">
                <table id="tabela_1">
                    <tr>
                        <td colspan="2" id="center">Izmena ziro racuna:</td>
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
                        <td colspan="2">
                            <input type="hidden" name="broj_ziro_racuna" value="<?php echo $row1['broj_ziro_racuna']; ?>">
                        </td>
                    </tr>

                    <?php
                    $result2 = mysqli_query($con, $upit2);
                    if (mysqli_num_rows($result2) > 0) {
                        $i = 0;
                        while ($row2 = mysqli_fetch_array($result2)) {
                    ?>
                            <tr>
                                <td>Ziro racun:</td>
                                <td>
                                    <input type="text" name="ziroracun_<?php echo $i; ?>" id="ziroracun_<?php echo $i; ?>" value="<?php echo $row2['racun']; ?>">
                                    |
                                    <input type="text" name="banka_<?php echo $i; ?>" id="banka_<?php echo $i; ?>" value="<?php echo $row2['banka']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="id_ziro_racuna_<?php echo $i; ?>" value="<?php echo $row2['id_zr']; ?>">
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    } ?>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="izmena_ziroracun" value="IZMENI PODATKE">
                        </td>
                    </tr>

                    <tr>
                        <td><br /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><br /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Novi racun:</td>
                        <td><a href="preduzece_izmena_podataka_dodaj_racun.php" target="">PRITISNI OVDE</a></td>
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