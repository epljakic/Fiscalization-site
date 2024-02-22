<?php
ob_start();
$poruka2 = "";

/* PROVERA PRILIKOM DODAVANJA NOVOG ARTIKLA */
if (isset($_POST['sifra_artikla'])) {

    $eko_taksa = 0;
    $akciza = 0;
    $poreska_stopa = 0;

    if (isset($_POST['poreska_stopa'])) {
        $poreska_stopa = $_POST['poreska_stopa'];
    }

    if (isset($_POST['eko_taksa'])) {
        $eko_taksa = 1;
    }
    if (isset($_POST['akciza'])) {
        $akciza = 1;
    }

    $slika = "slike/podrazumevana.jpg";

    if (!empty($_POST['slika'])) {
        $slika = "slike/" . $_POST['slika'];
    }

    $result6 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $_SESSION['korisnicko_ime'] . "'");
    $row6 = mysqli_fetch_array($result6);

    $result7 = mysqli_query($con, "SELECT * FROM objekat WHERE naziv = '" . $_POST['objekat'] . "'");
    $row7 = mysqli_fetch_array($result7);

    $result9 = mysqli_query($con, "SELECT * FROM artikal WHERE sifra = '" . $_POST['sifra_artikla'] . "' AND id_preduzeca = '" . $row6['id_preduzeca'] . "'");

    if (mysqli_num_rows($result9) == 0) {

        $upit8 = "INSERT INTO artikal (sifra, naziv, jedinica_mere, poreska_stopa, zemlja_porekla, strani_naziv, barkod, carinska_tarifa, eko_taksa, akciza, min_zalihe, max_zalihe, opis, deklaracija, slika, nabavna_cena, prodajna_cena, lager, id_objekta, id_preduzeca) values ('" . $_POST['sifra_artikla'] . "','" . $_POST['naziv_artikla'] . "','" . $_POST['jedinica_mere'] . "','" . $poreska_stopa . "','" . $_POST['zemlja_porekla'] . "','" . $_POST['strani_naziv'] . "','" . $_POST['barkod'] . "','" . $_POST['carinska_tarifa'] . "','" . $eko_taksa . "','" . $akciza . "','" . $_POST['min_zalihe'] . "','" . $_POST['max_zalihe'] . "','" . $_POST['opis'] . "','" . $_POST['deklaracija'] . "','" . $slika . "','" . $_POST['nabavna_cena'] . "','" . $_POST['prodajna_cena'] . "','" . $_POST['lager'] . "','" . $row7['id_objekta'] . "','" . $row6['id_preduzeca'] . "')";
        $result8 = mysqli_query($con, $upit8);

        if ($result8) {
            header('Location:preduzece_robe_usluge.php');
            exit();
        } else {
            $poruka2 = "<span style='color:red'> Neuspesno dodavanje artikla! </span>";
        }
    } else {
        $poruka2 = "<span style='color:red'> Sifra artikla vec postoji! </span>";
    }
}
