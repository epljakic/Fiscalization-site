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

    $result2 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
    $row2 = mysqli_fetch_array($result2);

    // Broj artikala po strani
    $results_per_page = 10;

    // Ukupan broj artikala
    $up4 = "SELECT * FROM artikal WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "'";
    $res4 = mysqli_query($con, $up4);
    $number_of_result = mysqli_num_rows($res4);

    // Broj strana
    $number_of_page = ceil($number_of_result / $results_per_page);

    // Koja je trenutna strana
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    // Pocetni rezultat
    $page_first_result = ($page - 1) * $results_per_page;

    // Dohvatanje potrebnih podataka
    $upit4 = "SELECT * FROM artikal WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "' LIMIT " . $page_first_result . "," . $results_per_page;
    $result4 = mysqli_query($con, $upit4);

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

        <!-- PRIKAZ SVIH ARTIKALA U SVIM OBJEKTIMA NA NIVOU PREDUZECA + PAGINACIJA -->
        <div id="right_menu">
            <table id="tabela_1">
                <tr>
                    <td colspan="2" id="center">
                        Ukupan broj artikala: <?php echo $number_of_result; ?> |
                        <a href="preduzece_robe_usluge_dodavanje.php" target="">UNOS</a>
                    </td>
                </tr>
            </table>

            <table id="tabela_1">
                <tr>
                    <th></th>
                    <th>Sifra artikla &nbsp;</th>
                    <th>Naziv artikla &nbsp;</th>
                    <th>Jedinica mere &nbsp;</th>
                    <th>Stopa poreza &nbsp;</th>
                    <th>Proizvodjac &nbsp;</th>
                    <th>Izmeni &nbsp;</th>
                    <th>Izbrisi</th>
                </tr>

                <?php
                $poruka4 = "";
                if (mysqli_num_rows($result4) > 0) {
                    while ($row4 = mysqli_fetch_array($result4)) {
                ?>
                        <form name="artikli" method="POST">
                            <tr>
                                <td>
                                    <img src="<?php echo $row4['slika']; ?>" alt="Artikal" width="50" height="50">
                                    <input type="hidden" value="<?php echo $row4['id_artikla'] ?>" name="id_artikla">
                                </td>
                                <td><?php echo $row4['sifra']; ?></td>
                                <td><?php echo $row4['naziv']; ?></td>
                                <td><?php echo $row4['jedinica_mere']; ?></td>
                                <td><?php echo $row4['poreska_stopa']; ?></td>
                                <td><?php echo $row2['naziv']; ?></td>
                                <td><input type="submit" id="dugme_1" name="izmeni" value="IZMENI"></td>
                                <td><input type="submit" id="dugme_1" name="izbrisi" value="IZBRISI"></td>
                            </tr>
                        </form>
                <?php
                    }
                } else {
                    $poruka4 = "<span style='color:red'> Preduzece nema artikala! </span>";
                }
                ?>
            </table>

            <!--PHP ISPIS PORUKE NAKON DODAVANJA ARTIKLA-->
            <div id="center">
                <?php
                echo $poruka4;
                require_once('preduzece_robe_usluge_izbrisi.php');
                echo $poruka2;
                ?>
            </div>

            <!--PAGINACIJA-->
            <div id="center">
                <?php
                for ($page = 1; $page <= $number_of_page; $page++) {
                    echo '<a href = "preduzece_robe_usluge.php?page=' . $page . '">' . $page . ' </a>';
                }
                ?>
            </div>

        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>