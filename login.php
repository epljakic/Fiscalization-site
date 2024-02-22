<?php
ob_start();
$poruka = "";
if (isset($_SESSION['ime'])) {
    unset($_SESSION['ime']);
}

/* PROVERA POLJA PRILIKOM PRIJAVE KORISNIKA */
if (!empty($_POST['prijava'])) {
    if (!empty($_POST['korisnicko_ime'])) {
        if (!empty($_POST['lozinka'])) {
            $korisnicko_ime = $_POST['korisnicko_ime'];
            $lozinka = $_POST['lozinka'];

            $upit1 = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korisnicko_ime . "'";
            $upit2 = "SELECT * FROM korisnik WHERE lozinka = '" . $lozinka . "'";
            $result1 = mysqli_query($con, $upit1);
            $result2 = mysqli_query($con, $upit2);

            if (mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_array($result1);
                if (mysqli_num_rows($result2) > 0) {
                    $status = $row1['status'];
                    if ($status == 'aktivan') {
                        $tip_korisnika = $row1['tip_korisnika'];
                        $prva_prijava = $row1['prva_prijava'];

                        $_SESSION['korisnicko_ime'] = $korisnicko_ime;
                        $_SESSION['tip_korisnika'] = $tip_korisnika;
                        $_SESSION['prva_prijava'] = $prva_prijava;
                        $_SESSION['lozinka'] = $lozinka;

                        if ($tip_korisnika == 'A') {
                            header("Location: administrator.php");
                        } elseif ($tip_korisnika == 'K') {
                            header("Location: kupac.php");
                        } else {
                            if ($prva_prijava == 1) {
                                header("Location: preduzece.php");
                            } else {
                                header("Location: preduzece_prva_prijava.php");
                            }
                        }
                    } else {
                        $_SESSION['ime'] = $korisnicko_ime;
                        $poruka = "<span style='color:red'> Nalog nije aktivan! </span>";
                    }
                } else {
                    $_SESSION['ime'] = $korisnicko_ime;
                    $poruka = "<span style='color:red'> Pogresna lozinka! </span>";
                }
            } else {
                $poruka = "<span style='color:red'> Korisnicko ime nije registrovano! </span>";
            }
            // Oslobadjanje resursa
            mysqli_free_result($result1);
            mysqli_free_result($result2);
        } else {
            $poruka = "<span style='color:red'> Unesite lozinku! </span>";
        }
    } else {
        $poruka = "<span style='color:red'> Unesite korisnicko ime! </span>";
    }
}
