<?php
ob_start();
$poruka2 = "";

if (isset($_POST['ziroracun'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $broj_ziro_racuna = $_POST['broj_ziro_racuna'];
    $id_preduzeca = $_POST['id_pred'];

    $broj_ziro_racuna++;

    /* UNOS ZIRO RACUNA */
    $ziroracun = $_POST["ziroracun"];
    $banka = $_POST["banka"];

    $upit8 = "UPDATE preduzece SET broj_ziro_racuna = '" . $broj_ziro_racuna . "' WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result8 = mysqli_query($con, $upit8);

    $upit9 = "INSERT INTO ziro_racun (id_preduzeca,racun,banka) values ('" . $id_preduzeca . "','" . $ziroracun . "','" . $banka . "')";
    $result9 = mysqli_query($con, $upit9);

    if ($result8 && $result9) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna izmena podataka! </span>";
    }
}
