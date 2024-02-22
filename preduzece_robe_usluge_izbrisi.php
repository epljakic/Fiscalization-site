<?php
ob_start();
$poruka2 = "";

/* BRISANJE ODABRANOG ARTIKLA */
if (!empty($_POST['izbrisi'])) {
    $id_artikla = $_POST['id_artikla'];

    $result5 = mysqli_query($con, "DELETE FROM artikal WHERE id_artikla = '" . $id_artikla . "'");
    if ($result5) {
        header('Location:preduzece_robe_usluge.php');
        exit();
    } else {
        $poruka2 = "<span style='color:red'> Neuspesno brisanje artikla! </span>";
    }
}

/* IZMENA ODABRANOG ARTIKLA */
if (!empty($_POST['izmeni'])) {
    $_SESSION['id_artikla'] = $_POST['id_artikla'];
    header('Location:preduzece_robe_usluge_izmeni.php');
    exit();
}
