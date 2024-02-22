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
    require_once('preduzece_robe_usluge_izmeni_provera.php');

    $result2 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
    $row2 = mysqli_fetch_array($result2);
    $upit3 = "SELECT * FROM objekat WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "'";

    $result4 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $_SESSION['id_artikla'] . "'");
    $row4 = mysqli_fetch_array($result4);

    $result5 = mysqli_query($con, "SELECT * FROM objekat WHERE id_objekta = '" . $row4['id_objekta'] . "'");
    $row5 = mysqli_fetch_array($result5);
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

        <!-- FORMA ZA IZMENU PODATAKA ODABRANOG ARTIKLA -->
        <div id="right_menu">
            <p id="center">Izmenite artikal:</p>
            <form name="dodaj_artikal" method="POST" onsubmit="return(dodajartikal())">
                <table id="tabela_1">
                    <!-- OPSTI PODACI -->
                    <tr>
                        <td colspan="2" id="center">
                            Opsti podaci (obavezni):
                        </td>
                    </tr>
                    <tr>
                        <td>Sifra artikla:</td>
                        <td><input type="text" name="sifra_artikla" value="<?php echo $row4['sifra']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Naziv artikla:</td>
                        <td><input type="text" name="naziv_artikla" value="<?php echo $row4['naziv']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Jedinica mere:</td>
                        <td><input type="text" name="jedinica_mere" value="<?php echo $row4['jedinica_mere']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Poreska stopa:</td>
                        <td><input type="text" name="poreska_stopa" value="<?php echo $row4['poreska_stopa']; ?>"></td>
                    </tr>

                    <!-- DODATNI PODACI -->
                    <tr>
                        <td colspan="2" id="center">
                            Dodatni podaci (neobavezni):
                        </td>
                    </tr>
                    <tr>
                        <td>Zemlja porekla:</td>
                        <td><input type="text" name="zemlja_porekla" value="<?php echo $row4['zemlja_porekla']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Strani naziv:</td>
                        <td><input type="text" name="strani_naziv" value="<?php echo $row4['strani_naziv']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Barkod:</td>
                        <td><input type="text" name="barkod" value="<?php echo $row4['barkod']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Carinska tarifa:</td>
                        <td><input type="text" name="carinska_tarifa" value="<?php echo $row4['carinska_tarifa']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Eko taksa:</td>
                        <td><input type="checkbox" name="eko_taksa" <?php if ($row4['eko_taksa'] == 1) {
                                                                        echo "checked";
                                                                    } ?>></td>
                    </tr>
                    <tr>
                        <td>Akciza:</td>
                        <td><input type="checkbox" name="akciza" <?php if ($row4['akciza'] == 1) {
                                                                        echo "checked";
                                                                    } ?>></td>
                    </tr>
                    <tr>
                        <td>Minimalne zeljene zalihe:</td>
                        <td><input type="text" name="min_zalihe" value="<?php echo $row4['min_zalihe']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Maksimalne zeljene zalihe:</td>
                        <td><input type="text" name="max_zalihe" value="<?php echo $row4['max_zalihe']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Opis:</td>
                        <td><input type="text" name="opis" value="<?php echo $row4['opis']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Deklaracija:</td>
                        <td><input type="text" name="deklaracija" value="<?php echo $row4['deklaracija']; ?>"></td>
                    </tr>

                    <!-- CENE I STANJE ROBE -->
                    <tr>
                        <td colspan="2" id="center">
                            Cene i stanje robe:
                        </td>
                    </tr>
                    <tr>
                        <td>Naziv objekta:</td>
                        <td>
                            <select name="objekat" id="objekat">
                                <?php
                                $result3 = mysqli_query($con, $upit3);
                                if (mysqli_num_rows($result3) > 0) {
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                ?>
                                        <option value="<?php echo $row3['naziv']; ?>" <?php if ($row3['naziv'] == $row5['naziv']) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $row3['naziv']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nabavna cena:</td>
                        <td><input type="text" name="nabavna_cena" value="<?php echo $row4['nabavna_cena']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Prodajna cena:</td>
                        <td><input type="text" name="prodajna_cena" value="<?php echo $row4['prodajna_cena']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Stanje na lageru:</td>
                        <td><input type="text" name="lager" value="<?php echo $row4['lager']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Slika:</td>
                        <td>
                            <input type="file" name="slika" id="slika">
                            <input type="hidden" name="slika_stara" value="<?php echo $row4['slika']; ?>">
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="izmeni_artikal" value="IZMENI">
                        </td>
                    </tr>
                </table>
            </form>

            <!--PHP ISPIS PORUKE NAKON IZMENE ARTIKLA-->
            <div id="center">
                <?php echo $poruka5; ?>
            </div>




        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>