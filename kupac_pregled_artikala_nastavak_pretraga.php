<?php
ob_start();
$poruka = "";

/* REZULTATI DOBIJENIH ARTIKALA NAKON PRETRAGE(ukoliko je bilo pretrage po nazivu) */
$upit1 = "SELECT * FROM artikal WHERE id_preduzeca = '" . $id_preduzeca . "'";

if (!empty($_POST['pretraga'])) {
    $naziv_artikla = $_POST['naziv_artikla'];
    if (!empty($_POST['naziv_artikla'])) {
        $upit1 = "SELECT * FROM artikal WHERE id_preduzeca = '" . $id_preduzeca . "' AND naziv LIKE '%" . $naziv_artikla . "%'";
    }
}
?>

<table id="tabela_1">
    <tr>
        <th></th>
        <th>Naziv artikla &nbsp;</th>
        <th>Jedinica mere &nbsp;</th>
        <th>Stopa poreza &nbsp;</th>
        <th>Cena artikla &nbsp;</th>
        <th>Minimalna cena</th>
    </tr>

    <?php
    $result1 = mysqli_query($con, $upit1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_array($result1)) {
    ?>
            <form name="artikli_kategorije" method="POST">
                <tr>
                    <td>
                        <img src="<?php echo $row1['slika']; ?>" alt="Artikal" width="50" height="50">
                        <input type="hidden" value="<?php echo $row1['id_artikla'] ?>" name="id_artikla">
                    </td>
                    <td><?php echo $row1['naziv']; ?></td>
                    <td><?php echo $row1['jedinica_mere']; ?></td>
                    <td><?php echo $row1['poreska_stopa']; ?></td>
                    <td><?php echo $row1['prodajna_cena']; ?>din.</td>
                    <td><input type="submit" id="dugme_1" name="odaberi" value="ODABERI"></td>
                </tr>
            </form>

    <?php

        }
    } else {
        $poruka =  "<span style='color:red'> Nema artikala! </span>";
    }
    ?>
</table>

<!--PHP ISPIS PORUKE NAKON ODABIRA KATEGORIJE-->
<div id="center">
    <?php
    echo $poruka;
    if (!empty($_POST['odaberi'])) {
        $_SESSION['id_artikla'] = $_POST['id_artikla'];
        header('Location:kupac_pregled_artikala_nastavak_pretraga_mincena.php');
        exit();
    }
    ?>
</div>