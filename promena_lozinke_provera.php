<?php
ob_start();
$poruka3 = "";

/* PROVERA POLJA PRILIKOM PROMENE TRENUTNE LOZINKE */
if (isset($_POST['lozinka1'])) {
    $nova_lozinka = $_POST['lozinka1'];
    $upit2 = "UPDATE korisnik SET lozinka = '" . $nova_lozinka . "' WHERE korisnicko_ime = '" . $_SESSION['korisnicko_ime'] . "'";
    $result2 = mysqli_query($con, $upit2);
    if ($result2) {
        session_destroy();
        header('Location:index.php');
        exit();
    } else {
        $poruka3 = "<span style='color:red'> Neuspesna promena lozinke! </span>";
    }
}
