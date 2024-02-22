<?php
ob_start();
$poruka2 = "";

if (!empty($_POST['dodaj_delatnost'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $broj_delatnosti = $_POST['broj_delatnosti'];

    $broj_delatnosti++;

    /* UNOS DELATNOSTI */
    $delatnost = $_POST["delatnost"];
    $id_preduzeca = $_POST["id_pred"];

    $upit6 = "SELECT * FROM delatnost WHERE delatnost = '" . $delatnost . "'";
    $result6 = mysqli_query($con, $upit6);
    $row6 = mysqli_fetch_array($result6);

    $upit7 = "INSERT INTO sifra_delatnosti (id_preduzeca,delatnost) values ('" . $id_preduzeca . "','" . $row6['id_delatnosti'] . "')";
    $result7 = mysqli_query($con, $upit7);

    $upit8 = "UPDATE preduzece SET broj_delatnosti = '" . $broj_delatnosti . "' WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result8 = mysqli_query($con, $upit8);

    if ($result7 && $result8) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna izmena podataka! </span>";
    }
}
