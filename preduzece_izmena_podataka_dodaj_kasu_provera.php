<?php
ob_start();
$poruka2 = "";

if (isset($_POST['objekat'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $broj_objekata = $_POST['broj_objekata'];
    $id_preduzeca = $_POST['id_pred'];

    $broj_objekata++;

    /* UNOS FISKALNE KASE */
    $objekat = $_POST["objekat"];
    $lokacija = $_POST["lokacija"];
    $kasa = $_POST["kasa"];

    $upit9 = "SELECT * FROM fiskalna_kasa WHERE vrsta_kase = '" . $kasa . "'";
    $result9 = mysqli_query($con, $upit9);
    $row9 = mysqli_fetch_array($result9);

    $upit10 = "INSERT INTO objekat (naziv,id_preduzeca,lokacija,tip_kase) values ('" . $objekat . "','" . $id_preduzeca . "','" . $lokacija . "','" . $row9['id_fk'] . "')";
    $result10 = mysqli_query($con, $upit10);

    $upit8 = "UPDATE preduzece SET broj_objekata = '" . $broj_objekata . "' WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result8 = mysqli_query($con, $upit8);

    if ($result8 && $result10) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna izmena podataka! </span>";
    }
}
