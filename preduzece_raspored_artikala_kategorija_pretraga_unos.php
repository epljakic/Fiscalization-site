<?php
ob_start();
$poruka3 = "";

if (!empty($_POST['dodaj'])) {
    $id_artikla = $_POST['id_artikla'];

    $upit8 = "UPDATE artikal SET kategorija = '" . $_SESSION['id_kategorije'] . "' WHERE id_artikla = '" . $id_artikla . "'";
    $result8 = mysqli_query($con, $upit8);

    if ($result8) {
        header('Location:preduzece_raspored_artikala_kategorija_odabir.php');
        exit();
    } else {
        $poruka3 = "<span style='color:red'> Neuspesno dodavanje kategorije! </span>";
    }
}
