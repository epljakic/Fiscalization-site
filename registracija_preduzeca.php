<?php
ob_start();
$poruka1 = "";

if (isset($_POST['ime'])) {
    $korisnicko_ime = $_POST['kor_ime'];
    $mejl_adresa = $_POST['mejl_adresa'];

    $upit1 = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
    $upit2 = "SELECT * FROM korisnik WHERE mejl_adresa = '" . $mejl_adresa . "'";
    $result1 = mysqli_query($con, $upit1);
    $result2 = mysqli_query($con, $upit2);

    if (mysqli_num_rows($result1) == 0) {
        if (mysqli_num_rows($result2) == 0) {
            $result3 = mysqli_query($con, "insert into korisnik (korisnicko_ime,lozinka,ime,prezime,kontakt_telefon,mejl_adresa,tip_korisnika,status,prva_prijava) values "
                . "('" . $_POST['kor_ime'] . "','" . $_POST['lozinka1'] . "','" . $_POST['ime'] . "','" . $_POST['prezime'] . "','" . $_POST['telefon'] . "','" . $_POST['mejl_adresa'] . "','P','neaktivan','0')");
            $result4 = mysqli_query($con, "insert into preduzece (korisnicko_ime,naziv,drzava,grad,postanski_broj,ulica_broj,pib,maticni_broj) values "
                . "('" . $_POST['kor_ime'] . "','" . $_POST['naziv_preduzeca'] . "','" . $_POST['drzava'] . "','" . $_POST['grad'] . "','" . $_POST['postanski_broj'] . "','" . $_POST['ulica_broj'] . "','" . $_POST['pib'] . "','" . $_POST['maticni_broj'] . "')");
            if (!$result3) {
                $poruka1 = "<span style='color:red'>Neuspesan unos u bazu korisnik!</span>";
            }
            if (!$result4) {
                $poruka1 = "<span style='color:red'>Neuspesan unos u bazu preduzece!</span>";
            }
            if ($result3 && $result4) {
                $poruka1 = "<span style='color:red'>Preduzece registrovano, sacekajte aktivaciju!</span>";
            }
            mysqli_close($con);
        } else {
            $poruka1 = "<span style='color:red'> I-mejl adresa je u upotrebi! </span>";
        }
    } else {
        $poruka1 = "<span style='color:red'> Korisnicko ime je u upotrebi! </span>";
    }
}
