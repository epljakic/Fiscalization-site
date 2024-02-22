<?php
ob_start();

if (!empty($_POST['odaberi'])) {
    $_SESSION['id_kategorije'] = $_POST['id_kategorije'];
    header('Location:preduzece_raspored_artikala_kategorija_odabir.php');
    exit();
}
