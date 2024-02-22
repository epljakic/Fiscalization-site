<?php
ob_start();
$poruka2 = "";

/* PROVERA UNETE KOLICINE PRILIKOM KUPOVINE ODABRANOG ARTIKLA */
if (isset($_POST['kolicina'])) {
    $korisnicko_ime = $_SESSION['korisnicko_ime'];
    $id_objekta = $_SESSION['id_objekta'];
    $id_artikla = $_SESSION['id_artikla'];

    $result4 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $id_artikla . "'");
    $row4 = mysqli_fetch_array($result4);

    if ($row4['lager'] > $_POST['kolicina']) {
        $naziv = $row4['naziv'];
        $kolicina = $_POST['kolicina'];
        $artikal = "" . $naziv . "," . $id_objekta . "," . $id_artikla . "," . $kolicina . "";
        array_push($_SESSION['korpa'], $artikal);
        header("Location: preduzece_izdavanje_racuna_artikli.php");
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Stanje na lageru je manje od unete kolicine! </span>";
    }
}
