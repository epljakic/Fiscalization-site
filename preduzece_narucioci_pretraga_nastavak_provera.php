<?php
ob_start();
$poruka2 = "";

if (isset($_POST['broj_dana'])) {
    $preduzece1 = $_SESSION['preduzece_1'];
    $preduzece2 = $_SESSION['preduzece_2'];

    $broj_dana = $_POST["broj_dana"];
    $rabat = $_POST["rabat"];

    $upit8 = "UPDATE narucioci SET broj_dana = '" . $broj_dana . "', rabat = '" . $rabat . "' WHERE id_preduzeca_1 = '" . $preduzece1 . "' AND id_preduzeca_2 = '" . $preduzece2 . "'";
    $result8 = mysqli_query($con, $upit8);

    unset($_SESSION['preduzece_1']);
    unset($_SESSION['preduzece_2']);

    if ($result8) {
        header('Location:preduzece.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesno dodavanje novih podataka! </span>";
    }
}
