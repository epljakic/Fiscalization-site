<?php
ob_start();
$poruka2 = "";

if (isset($_POST['ime'])) {
    $kor_ime = $_POST['kor_ime'];
    $mejl_adresa = $_POST['mejl_adresa'];

    $upit1 = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $kor_ime . "'";
    $upit2 = "SELECT * FROM korisnik WHERE mejl_adresa = '" . $mejl_adresa . "'";
    $result1 = mysqli_query($con, $upit1);
    $result2 = mysqli_query($con, $upit2);

    if (mysqli_num_rows($result1) == 0) {
        if (mysqli_num_rows($result2) == 0) {
            $result3 = mysqli_query($con, "insert into korisnik (korisnicko_ime,lozinka,ime,prezime,kontakt_telefon,mejl_adresa,tip_korisnika,status,prva_prijava) values "
                . "('" . $_POST['kor_ime'] . "','" . $_POST['lozinka1'] . "','" . $_POST['ime'] . "','" . $_POST['prezime'] . "','" . $_POST['telefon'] . "','" . $_POST['mejl_adresa'] . "','P','neaktivan','0')");
            $result4 = mysqli_query($con, "insert into preduzece (korisnicko_ime,naziv,drzava,grad,postanski_broj,ulica_broj,pib,maticni_broj) values "
                . "('" . $_POST['kor_ime'] . "','" . $_POST['naziv_preduzeca'] . "','" . $_POST['drzava'] . "','" . $_POST['grad'] . "','" . $_POST['postanski_broj'] . "','" . $_POST['ulica_broj'] . "','" . $_POST['pib'] . "','" . $_POST['maticni_broj'] . "')");

            $result5 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $_SESSION['korisnicko_ime'] . "'");
            $result6 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $_POST['kor_ime'] . "'");
            $row5 = mysqli_fetch_array($result5);
            $row6 = mysqli_fetch_array($result6);

            $result7 = mysqli_query($con, "INSERT INTO narucioci (id_preduzeca_1,id_preduzeca_2,broj_dana,rabat) values ('" . $row5['id_preduzeca'] . "','" . $row6['id_preduzeca'] . "','" . $_POST['broj_dana'] . "','" . $_POST['rabat'] . "')");

            if (!$result3) {
                $poruka2 = "<span style='color:red'>Neuspesan unos u bazu korisnik!</span>";
            }
            if (!$result4) {
                $poruka2 = "<span style='color:red'>Neuspesan unos u bazu preduzece!</span>";
            }
            if ($result7) {
                header('Location:preduzece.php');
                exit();
            } else {
                $poruka2 = "<span style='color:red'> Neuspesno dodavanje novog narucioca! </span>";
            }
        } else {
            $poruka2 = "<span style='color:red'> I-mejl adresa je u upotrebi! </span>";
        }
    } else {
        $poruka2 = "<span style='color:red'> Korisnicko ime je u upotrebi! </span>";
    }
}
