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
    <script lang="JavaScript" src="jsfajl.js"></script>
</head>

<!--BODY-->

<body>

    <!--PHP-->
    <?php
    ob_start();
    session_start();
    require_once('dbconnection.php');
    require_once('login.php');
    require_once('registracija_preduzeca.php');
    ?>

    <!--HEADER-->
    <?php
    require_once('header_div.php');
    ?>

    <div id="container">

        <!--LEFT SIDE INDEX (RACUNI)-->
        <div id="left_index">
            <p id="center">Poslednjih 5 racuna:</p>

            <div id="center">
                <dl>
                    <?php
                    $result8 = mysqli_query($con, "SELECT * FROM racun ORDER BY id_racuna DESC LIMIT 5");
                    if (mysqli_num_rows($result8) > 0) {
                        while ($row8 = mysqli_fetch_array($result8)) {
                            $result9 = mysqli_query($con, "SELECT * FROM preduzece WHERE id_preduzeca = '" . $row8['id_preduzeca'] . "'");
                            $row9 = mysqli_fetch_array($result9);
                    ?>
                            <dt>-------------------------Racun------------------------</dt>
                            <dt>
                                <?php echo $row9['naziv']; ?> &nbsp;&nbsp;
                                <?php echo $row8['iznos_racuna']; ?>din. &nbsp;&nbsp;
                                <?php echo $row8['iznos_poreza']; ?>%
                            </dt>

                            <?php
                            $res3 = mysqli_query($con, "SELECT * FROM roba_sa_racuna WHERE id_racuna = '" . $row8['id_racuna'] . "'");
                            if (mysqli_num_rows($res3) > 0) {
                                while ($rw3 = mysqli_fetch_array($res3)) {
                                    $res4 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $rw3['id_artikla'] . "'");
                                    $rw4 = mysqli_fetch_array($res4);
                            ?>

                                    <dd>
                                        <?php echo $rw4['naziv']; ?> &nbsp;&nbsp;
                                        Kol: <?php echo $rw3['kolicina']; ?>
                                    </dd>

                            <?php
                                }
                            }
                            ?>

                            <dt>--------------------------------------------------------</dt>
                            <dt><br /></dt>

                    <?php
                        }
                    }
                    ?>
                </dl>
            </div>

        </div>

        <!--CENTER INDEX (PRIJAVA)-->
        <div id="center_index">
            <p id="center">Prijava:</p>
            <form name="prijava" method="POST">
                <table id="tabela_1">
                    <tr>
                        <td>Korisnicko ime:</td>
                        <td>
                            <input type="text" name="korisnicko_ime" value="<?php if (isset($_SESSION['ime'])) {
                                                                                echo $_SESSION['ime'];
                                                                            } else {
                                                                                echo "";
                                                                            } ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Lozinka:</td>
                        <td><input type="password" name="lozinka"></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="prijava" value="PRIJAVI SE">
                        </td>
                    </tr>
                </table>
            </form>

            <!--PHP ISPIS PORUKE NAKON LOGOVANJA-->
            <div id="center">
                <?php echo $poruka; ?>
            </div>

        </div>


        <!--RIGHT SIDE INDEX (REGISTRACIJA)-->
        <div id="right_index">
            <p id="center">Registracija:</p>
            <form name="registracija" method="POST" onsubmit="return(registracijapreduzeca())">
                <table id="tabela_1">
                    <tr>
                        <td>Ime:</td>
                        <td><input type="text" name="ime"></td>
                    </tr>
                    <tr>
                        <td>Prezime:</td>
                        <td><input type="text" name="prezime"></td>
                    </tr>
                    <tr>
                        <td>Korisnicko ime:</td>
                        <td><input type="text" name="kor_ime"></td>
                    </tr>
                    <tr>
                        <td>Lozinka:</td>
                        <td><input type="password" name="lozinka1"></td>
                    </tr>
                    <tr>
                        <td>Potvrda lozinke:</td>
                        <td><input type="password" name="lozinka2"></td>
                    </tr>
                    <tr>
                        <td>Kontakt telefon:</td>
                        <td><input type="text" name="telefon"></td>
                    </tr>
                    <tr>
                        <td>I-mejl adresa:</td>
                        <td><input type="text" name="mejl_adresa"></td>
                    </tr>
                    <tr>
                        <td>Naziv preduzeca:</td>
                        <td><input type="text" name="naziv_preduzeca"></td>
                    </tr>
                    <tr>
                        <td>Drzava:</td>
                        <td><input type="text" name="drzava"></td>
                    </tr>
                    <tr>
                        <td>Grad:</td>
                        <td><input type="text" name="grad"></td>
                    </tr>
                    <tr>
                        <td>Postanski broj:</td>
                        <td><input type="text" name="postanski_broj"></td>
                    </tr>
                    <tr>
                        <td>Ulica i broj:</td>
                        <td><input type="text" name="ulica_broj"></td>
                    </tr>
                    <tr>
                        <td>PIB:</td>
                        <td><input type="text" name="pib" maxlength="9"></td>
                    </tr>
                    <tr>
                        <td>Maticni broj:</td>
                        <td><input type="text" name="maticni_broj" maxlength="8"></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="center">
                            <input type="submit" id="dugme_1" name="reg" value="REGISTRUJ SE">
                        </td>
                    </tr>
                </table>
            </form>

            <!--PHP ISPIS PORUKE NAKON REGISTRACIJE-->
            <div id="center">
                <?php echo $poruka1; ?>
            </div>
            
        </div>

    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>