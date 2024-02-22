<?php
ob_start();
$poruka2 = "";

if (isset($_POST['objekat_0'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $broj_objekata = $_POST['broj_objekata'];

    /* UNOS FISKALNIH KASA */
    for ($i = 0; $i < $broj_objekata; $i++) {
        $objekat = $_POST["objekat_" . $i . ""];
        $lokacija = $_POST["lokacija_" . $i . ""];
        $kasa = $_POST["kasa_" . $i . ""];
        $id_objekta = $_POST["id_objekta_" . $i . ""];

        $upit9 = "SELECT * FROM fiskalna_kasa WHERE vrsta_kase = '" . $kasa . "'";
        $result9 = mysqli_query($con, $upit9);
        $row9 = mysqli_fetch_array($result9);

        $upit10 = "UPDATE objekat SET naziv = '" . $objekat . "', lokacija = '" . $lokacija . "', tip_kase = '" . $row9['id_fk'] . "' WHERE id_objekta = '" . $id_objekta . "'";
        $result10 = mysqli_query($con, $upit10);
    }

    if ($result10) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna izmena podataka! </span>";
    }
}
