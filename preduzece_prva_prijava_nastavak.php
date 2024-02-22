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
    require_once('preduzece_prva_prijava_nastavak_provera.php');

    $upit1 = "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result1 = mysqli_query($con, $upit1);
    $row1 = mysqli_fetch_array($result1);

    $upit2 = "SELECT * FROM delatnost";
    $upit3 = "SELECT * FROM fiskalna_kasa";

    ?>

    <!--HEADER-->
    <?php
    require_once('header_div.php');
    ?>

    <!------- MISLIM DA NIJE POTREBNO OBEZBEDITI LOG-OUT OVDE NA OVOJ STRANI------->


    <div id="lozinka_content">
        <form name="forma_preduzece_informacije" method="POST" onsubmit="return(proveripodatkepreduzece())">
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
                        <input type="hidden" name="broj_delatnosti" value="<?php echo $row1['broj_delatnosti']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="broj_ziro_racuna" value="<?php echo $row1['broj_ziro_racuna']; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">Delatnosti:</td>
                </tr>
                <?php
                for ($i = 0; $i < $row1['broj_delatnosti']; $i++) {
                ?>

                    <tr>
                        <td>Delatnost:</td>
                        <td>
                            <select name="delatnost_<?php echo $i; ?>" id="delatnost_<?php echo $i; ?>">
                                <?php
                                $result2 = mysqli_query($con, $upit2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row2 = mysqli_fetch_array($result2)) {
                                ?>
                                        <option value="<?php echo $row2['delatnost']; ?>"><?php echo $row2['delatnost']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                <?php
                }
                ?>

                <tr>
                    <td colspan="2"><br />Ziro racuni:</td>
                </tr>
                <?php
                for ($i = 0; $i < $row1['broj_ziro_racuna']; $i++) {
                ?>

                    <tr>
                        <td>Ziro racun:</td>
                        <td>
                            <input type="text" name="ziroracun_<?php echo $i; ?>" id="ziroracun_<?php echo $i; ?>" placeholder="3_cifre-12_cifara-2_cifre">
                            |
                            <input type="text" name="banka_<?php echo $i; ?>" id="banka_<?php echo $i; ?>" placeholder="Naziv banke">
                        </td>
                    </tr>
                <?php
                }
                ?>

                <tr>
                    <td colspan="2"><br />Fiskalne kase:</td>
                </tr>
                <?php
                for ($i = 0; $i < $row1['broj_objekata']; $i++) {
                ?>

                    <tr>
                        <td>Fiskalna kasa:</td>
                        <td>
                            <input type="text" name="objekat_<?php echo $i; ?>" id="objekat_<?php echo $i; ?>" placeholder="Naziv objekta">
                            |
                            <input type="text" name="lokacija_<?php echo $i; ?>" id="lokacija_<?php echo $i; ?>" placeholder="Lokacija objekta">
                            |
                            <select name="kasa_<?php echo $i; ?>" id="kasa_<?php echo $i; ?>">
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
                <?php
                }
                ?>

                <tr>
                    <td colspan="2" id="center">
                        <input type="submit" id="dugme_1" name="dodaj_nove_informacije" value="DODAJ PODATKE">
                    </td>
                </tr>
            </table>
        </form>

        <!--PHP ISPIS PORUKE NAKON UNOSA NOVIH PODATAKA-->
        <div id="center">
            <?php echo $poruka2; ?>
        </div>

    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>