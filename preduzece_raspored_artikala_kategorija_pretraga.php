<?php
ob_start();
$poruka = "";

$result2 = mysqli_query($con, "SELECT * FROM preduzece WHERE korisnicko_ime = '" . $korisnicko_ime . "'");
$row2 = mysqli_fetch_array($result2);

$upit3 = "SELECT * FROM artikal WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "'";

if (!empty($_POST['pretraga'])) {
    $naziv_artikla = $_POST['naziv_artikla'];
    if (!empty($_POST['naziv_artikla'])) {
        $upit3 = "SELECT * FROM artikal WHERE id_preduzeca = '" . $row2['id_preduzeca'] . "' AND naziv LIKE '%" . $naziv_artikla . "%'";
    }
}
?>

<table id="tabela_1">
    <tr>
        <th></th>
        <th>Sifra artikla &nbsp;</th>
        <th>Naziv artikla &nbsp;</th>
        <th>Jedinica mere &nbsp;</th>
        <th>Stopa poreza &nbsp;</th>
        <th>Dodaj</th>
    </tr>
    <?php
    $result3 = mysqli_query($con, $upit3);
    if (mysqli_num_rows($result3) > 0) {
        while ($row3 = mysqli_fetch_array($result3)) {
            if ($row3['kategorija'] == "") {
    ?>
                <form name="artikli_kategorije" method="POST">
                    <tr>
                        <td>
                            <img src="<?php echo $row3['slika']; ?>" alt="Artikal" width="50" height="50">
                            <input type="hidden" value="<?php echo $row3['id_artikla'] ?>" name="id_artikla">
                        </td>
                        <td><?php echo $row3['sifra']; ?></td>
                        <td><?php echo $row3['naziv']; ?></td>
                        <td><?php echo $row3['jedinica_mere']; ?></td>
                        <td><?php echo $row3['poreska_stopa']; ?></td>
                        <td><input type="submit" id="dugme_1" name="dodaj" value="DODAJ"></td>
                    </tr>
                </form>

    <?php
            }
        }
    } else {
        $poruka =  "<span style='color:red'> Nema rezultata za takvu pretragu! </span>";
    }
    ?>
</table>

<!--PHP ISPIS PORUKE NAKON ODABIRA KATEGORIJE-->
<div id="center">
    <?php echo $poruka; ?>
</div>

<?php
require_once('preduzece_raspored_artikala_kategorija_pretraga_unos.php');
?>