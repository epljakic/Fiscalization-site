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

    // Dolazak na ovu stranu brise sve artikle iz korpe
    if (isset($_SESSION['korpa'])) {
        unset($_SESSION['korpa']);
    }
    $_SESSION['korpa'] = array();

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
            $result1 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
            $row1 = mysqli_fetch_array($result1);

            $result2 = mysqli_query($con, "SELECT * FROM objekat WHERE id_preduzeca = '" . $row1['id_preduzeca'] . "'");
            ?>

            <p id="center">Izaberite objekat:</p>
            <table id="tabela_1">
                <tr>
                    <th>Naziv objekta</th>
                    <th>Odaberi</th>
                </tr>

                <?php
                $poruka2 = "";
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_array($result2)) {
                ?>
                        <form name="objekti" method="POST">
                            <tr>
                                <td>
                                    <?php echo $row2['naziv']; ?>
                                    <input type="hidden" value="<?php echo $row2['id_objekta'] ?>" name="id_objekta">
                                    <input type="hidden" value="<?php echo $row2['id_preduzeca'] ?>" name="id_preduzeca">
                                </td>
                                <td><input type="submit" id="dugme_1" name="odaberi" value="ODABERI"></td>
                            </tr>
                        </form>
                <?php
                    }
                } else {
                    $poruka2 = "<span style='color:red'> Preduzece nema objekata! </span>";
                }
                ?>
            </table>

            <!--PHP ISPIS PORUKE NAKON IZBORA OBJEKTA-->
            <div id="center">
                <?php
                echo $poruka2;
                if (!empty($_POST['odaberi'])) {
                    $_SESSION['id_objekta'] = $_POST['id_objekta'];
                    header('Location:preduzece_izdavanje_racuna_artikli.php');
                    exit();
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