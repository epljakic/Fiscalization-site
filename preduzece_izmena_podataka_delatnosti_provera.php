<?php
ob_start();
$poruka2 = "";

if (!empty($_POST['izmena_delatnosti'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $broj_delatnosti = $_POST['broj_delatnosti'];

    /* UNOS DELATNOSTI */
    for ($i = 0; $i < $broj_delatnosti; $i++) {
        $delatnost = $_POST["delatnost_" . $i . ""];
        $id_sd = $_POST["id_sd_" . $i . ""];

        $upit6 = "SELECT * FROM delatnost WHERE delatnost = '" . $delatnost . "'";
        $result6 = mysqli_query($con, $upit6);
        $row6 = mysqli_fetch_array($result6);

        $upit7 = "UPDATE sifra_delatnosti SET delatnost = '" . $row6['id_delatnosti'] . "' WHERE id_sd = '" . $id_sd . "'";
        $result7 = mysqli_query($con, $upit7);
    }

    if ($result7) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna izmena podataka! </span>";
    }
}
