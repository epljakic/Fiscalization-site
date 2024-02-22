<?php
ob_start();
$poruka2 = "";
$poruka3 = "";

if (isset($_POST['pib_pretraga'])) {
    $pib = $_POST['pib_pretraga'];
    $upit4 = "SELECT * FROM preduzece WHERE pib = '" . $pib . "'";
?>

    <table id="table_1">
        <tr>
            <th>Naziv preduzeca &nbsp;&nbsp;&nbsp;</th>
            <th>Dodaj narucioca</th>
        </tr>
        <?php
        $result4 = mysqli_query($con, $upit4);
        if (mysqli_num_rows($result4) > 0) {
            while ($row4 = mysqli_fetch_array($result4)) {
                if ($row4['korisnicko_ime'] != $_SESSION['korisnicko_ime']) {
        ?>
                    <form name="forma2" method="POST" action="">
                        <tr>
                            <td>
                                <?php echo $row4['naziv']; ?>
                                <input type="hidden" value="<?php echo $row4['id_preduzeca'] ?>" name="id_preduzeca">
                            </td>
                            <td><input type="submit" id="dugme_1" name="dodaj" value="DODAJ"></td>
                        </tr>
                    </form>

        <?php
                }
            }
        } else {
            $poruka2 =  "<span style='color:red'> Nema rezultata za takvu pretragu! </span>";
        }
        ?>
    </table>

<?php
    echo $poruka2;
}


if (!empty($_POST['dodaj'])) {
    $id_preduzeca2 = $_POST['id_preduzeca'];

    $upit5 = "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $_SESSION['korisnicko_ime'] . "'";
    $result5 = mysqli_query($con, $upit5);
    $row5 = mysqli_fetch_array($result5);
    $id_preduzeca1 = $row5['id_preduzeca'];

    $upit6 = "INSERT INTO narucioci (id_preduzeca_1, id_preduzeca_2) VALUES ('" . $id_preduzeca1 . "','" . $id_preduzeca2 . "')";
    $result6 = mysqli_query($con, $upit6);

    // Zbog abdejta koji treba kasnije da se desi, lakse azurirati odredjeni red
    $_SESSION['preduzece_1'] = $id_preduzeca1;
    $_SESSION['preduzece_2'] = $id_preduzeca2;

    if ($result6) {
        header('Location:preduzece_narucioci_pretraga_nastavak.php');
        exit();
    } else {
        $poruka3 = "<span style='color:red'> Neuspesno dodavanje narucioca! </span>";
    }
}
?>