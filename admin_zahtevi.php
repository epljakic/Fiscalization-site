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

        <!-- PREGLED SVIH ZAHTEVA OD NOVO-REGISTROVANIH PREDUZECA -->
        <div id="right_menu">
            <?php
            $poruka = "";
            $result = mysqli_query($con, "SELECT * FROM korisnik JOIN preduzece ON korisnik.korisnicko_ime = preduzece.korisnicko_ime WHERE korisnik.status = 'neaktivan'");
            ?>

            <table id="tabela_1">
                <tr>
                    <th>Korisnicko ime: &nbsp;&nbsp;</th>
                    <th>Ime: &nbsp;&nbsp;</th>
                    <th>Prezime: &nbsp;&nbsp;</th>
                    <th>Naziv preduzeca: &nbsp;&nbsp;</th>
                    <th>Prihvati zahtev:</th>
                </tr>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <form name="fomra_aktivacija" method="POST">
                            <tr>
                                <td>
                                    <?php echo $row['korisnicko_ime']; ?>
                                    <input type="hidden" value="<?php echo $row['korisnicko_ime'] ?>" name="kor_ime">
                                </td>
                                <td><?php echo $row['ime']; ?></td>
                                <td><?php echo $row['prezime']; ?></td>
                                <td><?php echo $row['naziv']; ?></td>
                                <td><input type="submit" id="dugme_1" name="prihvati" value="PRIHVATI"></td>
                            </tr>
                        </form>

                <?php
                    }
                } else {
                    $poruka =  "<p style='color:red'> Trenutno nema korisnika koji cekaju odobrenje! </p>";
                }
                ?>
            </table>
            <br /><br />

            <div id="center">
                <?php
                echo $poruka;
                require_once('admin_zahtevi_prihvati.php');
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