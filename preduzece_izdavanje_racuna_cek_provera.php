<?php
ob_start();
$poruka2 = "";

if (isset($_POST['ime'])) {
    $korisnicko_ime = $_SESSION['korisnicko_ime'];
    $id_objekta = $_SESSION['id_objekta'];
    $id_artikla = $_SESSION['id_artikla'];

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $licna_karta = $_POST['licna_karta'];

    $result1 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
    $row1 = mysqli_fetch_array($result1);

    $iznos_racuna = 0;
    $iznos_poreza = 0;

    for ($i = 0; $i < count($_SESSION['korpa']); $i++) {
        // $artikal = "" . $naziv . "," . $id_objekta . "," . $id_artikla . "," . $kolicina . "";
        $artikal = explode(',', $_SESSION['korpa'][$i]);

        $result2 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $artikal[2] . "'");
        $row2 = mysqli_fetch_array($result2);

        $iznos_racuna += ((float)$row2['prodajna_cena'] + (float)$row2['prodajna_cena'] * (float)$row2['poreska_stopa'] / (float)100) * $artikal[3];
        $iznos_poreza += (float)$row2['poreska_stopa'];
    }

    $iznos_poreza /= count($_SESSION['korpa']);

    $datum = date('Y-m-d H:i:s');

    // Dodavanje u tabelu racun
    $result3 = mysqli_query($con, "INSERT INTO racun (id_preduzeca, iznos_racuna, iznos_poreza, datum, licna_karta, ime, prezime) VALUES ('" . $row1['id_preduzeca'] . "','" . $iznos_racuna . "','" . $iznos_poreza . "','" . $datum . "','" . $licna_karta . "','" . $ime . "','" . $prezime . "')");

    $result6 = mysqli_query($con, "SELECT * FROM racun ORDER BY id_racuna DESC LIMIT 1");
    $row6 = mysqli_fetch_array($result6);

    // Dodavanje u tabelu roba_sa_racuna i azuriranje tabele artikal
    for ($i = 0; $i < count($_SESSION['korpa']); $i++) {
        // $artikal = "" . $naziv . "," . $id_objekta . "," . $id_artikla . "," . $kolicina . "";
        $artikal = explode(',', $_SESSION['korpa'][$i]);

        $result4 = mysqli_query($con, "SELECT * FROM artikal WHERE id_artikla = '" . $artikal[2] . "'");
        $row4 = mysqli_fetch_array($result4);

        $lager = $row4['lager'] - (int)$artikal[3];

        $result5 = mysqli_query($con, "UPDATE artikal SET lager = '" . $lager . "' WHERE id_artikla = '" . $artikal[2] . "'");

        $result7 = mysqli_query($con, "INSERT INTO roba_sa_racuna (id_racuna, id_artikla, kolicina) VALUES ('" . $row6['id_racuna'] . "','" . $artikal[2] . "','" . $artikal[3] . "')");
    }

    if ($result3) {
        header("Location: preduzece_izdavanje_racuna.php");
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesno izdavanje racuna! </span>";
    }
}
