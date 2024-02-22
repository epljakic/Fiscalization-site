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
    $korisnicko_ime = $_SESSION['korisnicko_ime'];
    require_once('dbconnection.php');
    require_once('promena_lozinke_provera.php');
    ?>

    <!--HEADER-->
    <?php
    require_once('header_div.php');
    ?>

    <!--LOG-OUT-->
    <?php
    require_once('logout.php');
    ?>

    <!-- FORMA ZA PROMENU TRENUTNE LOZINKE -->
    <div id="lozinka_content">
        <form name="forma_lozinka" method="POST" onsubmit="return(promenalozinke())">
            <table id="tabela_1">
                <tr>
                    <td collspan="2"><input type="hidden" name="stara_loz_baza" value="<?php echo $_SESSION['lozinka']; ?>"></td>
                </tr>
                <tr>
                    <td>Stara lozinka:</td>
                    <td><input type="password" name="stara_loz"></td>
                </tr>
                <tr>
                    <td>Nova lozinka:</td>
                    <td><input type="password" name="lozinka1"></td>
                </tr>
                <tr>
                    <td>Potvrda nove lozinke:</td>
                    <td><input type="password" name="lozinka2"></td>
                </tr>
                <tr>
                    <td colspan="2" id="center">
                        <input type="submit" id="dugme_1" name="promena_lozinke" value="PROMENI LOZINKU">
                    </td>
                </tr>
            </table>
        </form>

        <!--PHP ISPIS PORUKE NAKON PROMENE LOZINKE-->
        <div id="center">
            <?php echo $poruka3; ?>
        </div>
    </div>

    <!--FOOTER-->
    <?php
    require_once('footer_div.php');
    ?>

</body>

</html>