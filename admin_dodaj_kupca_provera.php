<?php
ob_start();
$poruka_kupac = "";

/* PROVERA PRILIKOM DODAVANJA NOVOG KUPCA OD STRANE ADMINISTRATORA */
if (isset($_POST['ime'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $mejl_adresa = $_POST['mejl_adresa'];
    $licna_karta = $_POST['licna_karta'];

    $upit1 = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $upit2 = "SELECT * FROM korisnik WHERE mejl_adresa = '" . $mejl_adresa . "'";
    $upit3 = "SELECT * FROM kupac WHERE licna_karta = '" . $licna_karta . "'";
    $result1 = mysqli_query($con, $upit1);
    $result2 = mysqli_query($con, $upit2);
    $result3 = mysqli_query($con, $upit3);

    if (mysqli_num_rows($result1) == 0) {
        if (mysqli_num_rows($result2) == 0) {
            if (mysqli_num_rows($result3) == 0) {
                $result4 = mysqli_query($con, "insert into korisnik (korisnicko_ime,lozinka,ime,prezime,kontakt_telefon,mejl_adresa,tip_korisnika,status,prva_prijava) values "
                    . "('" . $_POST['kor_ime'] . "','" . $_POST['lozinka1'] . "','" . $_POST['ime'] . "','" . $_POST['prezime'] . "','" . $_POST['telefon'] . "','" . $_POST['mejl_adresa'] . "','K','aktivan','1')");
                $result5 = mysqli_query($con, "insert into kupac (korisnicko_ime,licna_karta) values "
                    . "('" . $_POST['kor_ime'] . "','" . $licna_karta . "')");
                if (!$result4) {
                    $poruka_kupac = "<span style='color:red'>Neuspesan unos u bazu korisnik!</span>";
                }
                if (!$result5) {
                    $poruka_kupac = "<span style='color:red'>Neuspesan unos u bazu kupac!</span>";
                }
                if ($result4 && $result5) {
                    $poruka_kupac = "<span style='color:red'>Kupac uspesno dodat!</span>";
                }
                mysqli_close($con);
            } else {
                $poruka_kupac = "<span style='color:red'> Broj licne karte koristi vec jedan kupac! </span>";
            }
        } else {
            $poruka_kupac = "<span style='color:red'> I-mejl adresa je u upotrebi! </span>";
        }
    } else {
        $poruka_kupac = "<span style='color:red'> Korisnicko ime je u upotrebi! </span>";
    }
}
