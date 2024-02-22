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
    require_once('preduzece_robe_usluge_dodavanje_provera.php');

    $result2 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
    $row2 = mysqli_fetch_array($result2);
    $upit3 = "SELECT * FROM objekat WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "'";
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

        <!-- FORMA ZA DODAVANJE NOVOG ARTIKLA U PREDUZECE-OBJEKAT -->
        <div id="right_menu">
            <div id="left_side_1">
                <p id="center">Dodajte novi artikal:</p>
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
                            <td><input type="text" name="sifra_artikla"></td>
                        </tr>
                        <tr>
                            <td>Naziv artikla:</td>
                            <td><input type="text" name="naziv_artikla"></td>
                        </tr>
                        <tr>
                            <td>Jedinica mere:</td>
                            <td><input type="text" name="jedinica_mere"></td>
                        </tr>
                        <?php
                        if ($row2['pdv'] == 1) {
                        ?>
                            <tr>
                                <td>Poreska stopa:</td>
                                <td><input type="text" name="poreska_stopa" placeholder="0/10/20 %"></td>
                            </tr>
                        <?php
                        }
                        ?>

                        <!-- DODATNI PODACI -->
                        <tr>
                            <td colspan="2" id="center">
                                Dodatni podaci (neobavezni):
                            </td>
                        </tr>
                        <tr>
                            <td>Zemlja porekla:</td>
                            <td><input type="text" name="zemlja_porekla"></td>
                        </tr>
                        <tr>
                            <td>Strani naziv:</td>
                            <td><input type="text" name="strani_naziv"></td>
                        </tr>
                        <tr>
                            <td>Barkod:</td>
                            <td><input type="text" name="barkod"></td>
                        </tr>
                        <tr>
                            <td>Carinska tarifa:</td>
                            <td><input type="text" name="carinska_tarifa" placeholder="[%]"></td>
                        </tr>
                        <tr>
                            <td>Eko taksa:</td>
                            <td><input type="checkbox" name="eko_taksa"></td>
                        </tr>
                        <tr>
                            <td>Akciza:</td>
                            <td><input type="checkbox" name="akciza"></td>
                        </tr>
                        <tr>
                            <td>Minimalne zeljene zalihe:</td>
                            <td><input type="text" name="min_zalihe"></td>
                        </tr>
                        <tr>
                            <td>Maksimalne zeljene zalihe:</td>
                            <td><input type="text" name="max_zalihe"></td>
                        </tr>
                        <tr>
                            <td>Opis:</td>
                            <td><input type="text" name="opis"></td>
                        </tr>
                        <tr>
                            <td>Deklaracija:</td>
                            <td><input type="text" name="deklaracija"></td>
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
                                            <option value="<?php echo $row3['naziv']; ?>"><?php echo $row3['naziv']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nabavna cena:</td>
                            <td><input type="text" name="nabavna_cena"></td>
                        </tr>
                        <tr>
                            <td>Prodajna cena:</td>
                            <td><input type="text" name="prodajna_cena"></td>
                        </tr>
                        <tr>
                            <td>Stanje na lageru:</td>
                            <td><input type="text" name="lager"></td>
                        </tr>
                        <tr>
                            <td>Slika:</td>
                            <td><input type="file" name="slika" id="slika"></td>
                        </tr>
                        </tr>
                        <tr>
                            <td colspan="2" id="center">
                                <input type="submit" id="dugme_1" name="dodaj_artikal" value="DODAJ ARTIKAL">
                            </td>
                        </tr>
                    </table>
                </form>

                <!--PHP ISPIS PORUKE NAKON DODAVANJA ARTIKLA-->
                <div id="center">
                    <?php echo $poruka2; ?>

                </div>
            </div>

            <div id="right_side_1">
                <table id="tabela_1">
                    <tr>
                        <th>Objekat</th>
                        <th>Naziv</th>
                        <th>Nabavna cena</th>
                        <th>Prodajna cena</th>
                        <th>Na lageru</th>
                        <th>Min. </th>
                        <th>Max. [kolicina]</th>
                    </tr>

                    <?php
                    $poruka4 = "";
                    $upit4 = "SELECT * FROM artikal WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "'";
                    $result4 = mysqli_query($con, $upit4);
                    if (mysqli_num_rows($result4) > 0) {
                        while ($row4 = mysqli_fetch_array($result4)) {
                            $result5 = mysqli_query($con, "SELECT * FROM objekat WHERE id_objekta = '" . $row4['id_objekta'] . "'");
                            $row5 = mysqli_fetch_array($result5);
                    ?>
                            <tr>
                                <td><?php echo $row5['naziv']; ?></td>
                                <td><?php echo $row4['naziv']; ?></td>
                                <td><?php echo $row4['nabavna_cena']; ?></td>
                                <td><?php echo $row4['prodajna_cena']; ?></td>
                                <td><?php echo $row4['lager']; ?></td>
                                <td><?php echo $row4['min_zalihe']; ?></td>
                                <td><?php echo $row4['max_zalihe']; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        $poruka4 = "<span style='color:red'> Preduzece nema artikala! </span>";
                    }
                    ?>
                </table>

                <!--PHP ISPIS PORUKE NAKON PRIKAZA ARTIKALA-->
                <div id="center">
                    <?php echo $poruka4; ?>
                </div>
            </div>



        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>