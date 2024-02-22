<?php
ob_start();
$poruka2 = "";

if (isset($_POST['ime'])) {
    $korisnicko_ime = $_POST['kor_ime'];

    $pdv_on_off = 0;

    if (isset($_POST['pdv'])) {
        $pdv_on_off = 1;
    }

    /* AZURIRANJE PODATAKA UNUTAR BAZE */
    $upit3 = "UPDATE korisnik SET ime = '" . $_POST['ime'] . "', prezime = '" . $_POST['prezime'] . "', kontakt_telefon =' " . $_POST['telefon'] . "', mejl_adresa = '" . $_POST['mejl_adresa'] . "' WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result3 = mysqli_query($con, $upit3);

    $upit4 = "UPDATE preduzece SET naziv = '" . $_POST['naziv_preduzeca'] . "', drzava = '" . $_POST['drzava'] . "', grad =' " . $_POST['grad'] . "', postanski_broj = '" . $_POST['postanski_broj'] . "', ulica_broj = '" . $_POST['ulica_broj'] . "', pib = '" . $_POST['pib'] . "', maticni_broj = '" . $_POST['maticni_broj'] . "', pdv = '" . $pdv_on_off . "' WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result4 = mysqli_query($con, $upit4);

    if ($result3 && $result4) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna izmena podataka! </span>";
    }
}
