<?php
ob_start();
$poruka2 = "";

if (isset($_POST['ziroracun_0'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $broj_ziro_racuna = $_POST['broj_ziro_racuna'];

    /* UNOS ZIRO RACUNA */
    for ($i = 0; $i < $broj_ziro_racuna; $i++) {
        $ziroracun = $_POST["ziroracun_" . $i . ""];
        $banka = $_POST["banka_" . $i . ""];
        $id_zr = $_POST["id_ziro_racuna_" . $i . ""];

        $upit8 = "UPDATE ziro_racun SET racun = '" . $ziroracun . "', banka = '" . $banka . "' WHERE id_zr = '" . $id_zr . "'";
        $result8 = mysqli_query($con, $upit8);
    }

    if ($result8) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna izmena podataka! </span>";
    }
}
