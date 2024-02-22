<?php
ob_start();
$poruka1 = "";

if (isset($_POST['broj_delatnosti'])) {
    $korisnicko_ime = $_POST['kor_ime'];

    $pdv_on_off = 0;

    if (isset($_POST['pdv_cb'])) {
        $pdv_on_off = 1;
    }

    $upit1 = "UPDATE preduzece SET broj_objekata = '" . $_POST['broj_fiskalnih_kasa'] . "', broj_delatnosti = '" . $_POST['broj_delatnosti'] . "', broj_ziro_racuna = '" . $_POST['broj_ziro_racuna'] . "', pdv = '" . $pdv_on_off . "' WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result1 = mysqli_query($con, $upit1);

    if ($result1) {
        header('Location:preduzece_prva_prijava_nastavak.php');
        exit();
    } else {
        $poruka1 = "<span style='color:red'> Neuspesna dodavanje novih informacija u tabelu preduzece! </span>";
    }
}
