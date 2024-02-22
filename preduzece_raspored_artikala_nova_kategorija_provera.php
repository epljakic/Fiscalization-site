<?php
ob_start();
$poruka2 = "";

/* PROVERA POLJA PRILIKOM KREIRANJA NOVE KATEGORIJE */
if (isset($_POST['naziv_kategorije'])) {
    $naziv_kategorije = $_POST['naziv_kategorije'];

    $upit1 = "INSERT INTO kategorija (kategorija) VALUES ('" . $naziv_kategorije . "')";
    $result1 = mysqli_query($con, $upit1);

    if ($result1) {
        header('Location:preduzece_raspored_artikala.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesna dodavanje nove kategorije! </span>";
    }
}
