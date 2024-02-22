<?php
ob_start();
$poruka5 = "";

/* PROVERA PRILIKOM IZMENE PODATAKA VEC POSTOJECEG ARTIKLA */
if (isset($_POST['sifra_artikla'])) {

    $eko_taksa = 0;
    $akciza = 0;

    if (isset($_POST['eko_taksa'])) {
        $eko_taksa = 1;
    }
    if (isset($_POST['akciza'])) {
        $akciza = 1;
    }

    $slika_stara = $_POST['slika_stara'];
    $slika = "slike/" . $_POST['slika'];

    if ($slika == "slike/") {
        $slika = $slika_stara;
    }

    $result7 = mysqli_query($con, "SELECT * FROM objekat WHERE naziv = '" . $_POST['objekat'] . "'");
    $row7 = mysqli_fetch_array($result7);

    $result9 = mysqli_query($con, "SELECT * FROM artikal WHERE sifra = '" . $_POST['sifra_artikla'] . "' AND id_preduzeca = '" . $row6['id_preduzeca'] . "'");

    if (mysqli_num_rows($result9) == 0) {
        $upit8 = "UPDATE artikal SET sifra = '" . $_POST['sifra_artikla'] . "', naziv = '" . $_POST['naziv_artikla'] . "', jedinica_mere = '" . $_POST['jedinica_mere'] . "', poreska_stopa = '" . $_POST['poreska_stopa'] . "', zemlja_porekla = '" . $_POST['zemlja_porekla'] . "', strani_naziv = '" . $_POST['strani_naziv'] . "', barkod = '" . $_POST['barkod'] . "',  carinska_tarifa = '" . $_POST['carinska_tarifa'] . "', eko_taksa = '" . $eko_taksa . "', akciza = '" . $akciza . "', min_zalihe = '" . $_POST['min_zalihe'] . "', max_zalihe = '" . $_POST['max_zalihe'] . "', opis = '" . $_POST['opis'] . "', deklaracija = '" . $_POST['deklaracija'] . "', slika = '" . $slika . "', nabavna_cena = '" . $_POST['nabavna_cena'] . "', prodajna_cena = '" . $_POST['prodajna_cena'] . "', lager = '" . $_POST['lager'] . "', id_objekta = '" . $row7['id_objekta'] . "' WHERE id_artikla = '" . $_SESSION['id_artikla'] . "'";
        $result8 = mysqli_query($con, $upit8);

        if ($result8) {
            unset($_SESSION['id_artikla']);
            header('Location:preduzece_robe_usluge.php');
            exit();
        } else {
            $poruka5 = "<span style='color:red'> Neuspesno dodavanje artikla! </span>";
        }
    } else {
        $poruka5 = "<span style='color:red'> Sifra artikla vec postoji! </span>";
    }
}
