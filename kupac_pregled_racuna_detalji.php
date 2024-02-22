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

    // Ukoliko korisnik nije kupac unisti sesiju i vrati ga na index stranu
    if ($_SESSION['tip_korisnika'] != 'K') {
        unset($_SESSION['ime']);
        unset($_SESSION['korisnicko_ime']);
        unset($_SESSION['tip_korisnika']);
        unset($_SESSION['prva_prijava']);
        session_destroy();
        header('Location:index.php');
    }
    $korisnicko_ime = $_SESSION['korisnicko_ime'];
    $id_racuna = $_SESSION['id_rac'];

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
            <a href="kupac.php" target="">Pocetna strana</a> <br /><br />
            <a href="kupac_pregled_artikala.php" target="">Pregled artikala</a> <br /><br />
            <a href="kupac_pregled_racuna.php" target="">Pregled racuna</a> <br /><br />
            <a href="kupac_potrosnja.php" target="">Potrosnja</a> <br /><br />
        </div>

        <!-- PREGLED ARTIKALA KOJI SU SE NALAZILI NA IZABRANOM RACUNU -->
        <div id="right_menu">
            <p id="center">Detalji izabranog racuna:</p>

            <table id="tabela_1">
                <?php
                $result1 = mysqli_query($con, "SELECT * FROM racun WHERE id_racuna = '" . $id_racuna . "'");
                $row1 = mysqli_fetch_array($result1);

                $result2 = mysqli_query($con, "SELECT * FROM preduzece WHERE id_preduzeca = '" . $row1['id_preduzeca'] . "'");
                $row2 = mysqli_fetch_array($result2);
                ?>

                <tr>
                    <td>Naziv preduzeca: </td>
                    <td><?php echo $row2['naziv']; ?></td>
                </tr>
                <tr>
                    <td>Iznos racuna: </td>
                    <td><?php echo $row1['iznos_racuna']; ?>din.</td>
                </tr>
                <tr>
                    <td>Iznos poreza: </td>
                    <td><?php echo $row1['iznos_poreza']; ?>%</td>
                </tr>
                <tr>
                    <td>Kupljeni artikli:</td>
                    <td></td>
                </tr>

                <?php
                $result3 = mysqli_query($con, "SELECT * FROM roba_sa_racuna WHERE id_racuna = '" . $row1['id_racuna'] . "'");
                if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_array($result3)) {
                        $result4 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $row3['id_artikla'] . "'");
                        $row4 = mysqli_fetch_array($result4);
                ?>
                        <tr>
                            <td><?php echo $row4['naziv']; ?></td>
                            <td>Kolicina: <?php echo $row3['kolicina']; ?></td>
                        </tr>

                <?php
                    }
                }
                ?>

            </table>

        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>