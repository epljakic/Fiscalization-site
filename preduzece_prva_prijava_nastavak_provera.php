<?php
ob_start();
$poruka2 = "";

if (isset($_POST['objekat_0'])) {
    $korisnicko_ime = $_POST['kor_ime'];

    $broj_objekata = $_POST['broj_objekata'];
    $broj_delatnosti = $_POST['broj_delatnosti'];
    $broj_ziro_racuna = $_POST['broj_ziro_racuna'];

    $upit5 = "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result5 = mysqli_query($con, $upit5);
    $row5 = mysqli_fetch_array($result5);

    /* UNOS DELATNOSTI */
    for ($i = 0; $i < $broj_delatnosti; $i++) {
        $delatnost = $_POST["delatnost_" . $i . ""];

        $upit6 = "SELECT * FROM delatnost WHERE delatnost = '" . $delatnost . "'";
        $result6 = mysqli_query($con, $upit6);
        $row6 = mysqli_fetch_array($result6);

        $upit7 = "INSERT INTO sifra_delatnosti (id_preduzeca,delatnost) values ('" . $row5['id_preduzeca'] . "','" . $row6['id_delatnosti'] . "')";
        $result7 = mysqli_query($con, $upit7);
    }

    /* UNOS ZIRO RACUNA */
    for ($i = 0; $i < $broj_ziro_racuna; $i++) {
        $ziroracun = $_POST["ziroracun_" . $i . ""];
        $banka = $_POST["banka_" . $i . ""];

        $upit8 = "INSERT INTO ziro_racun (id_preduzeca,racun,banka) values ('" . $row5['id_preduzeca'] . "','" . $ziroracun . "','" . $banka . "')";
        $result8 = mysqli_query($con, $upit8);
    }

    /* UNOS FISKALNIH KASA */
    for ($i = 0; $i < $broj_objekata; $i++) {
        $objekat = $_POST["objekat_" . $i . ""];
        $lokacija = $_POST["lokacija_" . $i . ""];
        $kasa = $_POST["kasa_" . $i . ""];

        $upit9 = "SELECT * FROM fiskalna_kasa WHERE vrsta_kase = '" . $kasa . "'";
        $result9 = mysqli_query($con, $upit9);
        $row9 = mysqli_fetch_array($result9);

        $upit10 = "INSERT INTO objekat (naziv,id_preduzeca,lokacija,tip_kase) values ('" . $objekat . "','" . $row5['id_preduzeca'] . "','" . $lokacija . "','" . $row9['id_fk'] . "')";
        $result10 = mysqli_query($con, $upit10);
    }

    /* PROMENA PROMENLJIVE prva_prijava SA 0 -> 1 */
    $upit11 = "UPDATE korisnik SET prva_prijava = '1' WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $result11 = mysqli_query($con, $upit11);

    if ($result11) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna dodavanje unetih podataka! </span>";
    }
}
