<?php
/* PRIHVATANJE NOVO-REGISTROVANIH PREDUZECA */
if (!empty($_POST['prihvati'])) {
    $kor_ime1 = $_POST['kor_ime'];
    $upit1 = "UPDATE korisnik SET status='aktivan' WHERE korisnicko_ime ='" . $kor_ime1 . "'";
    $status1 = mysqli_query($con, $upit1);

    if ($status1) {
        echo "<br/> <span style='text-align:center'> Korisnicki nalog aktiviran! </span>";
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "<br/> <span style='text-align:center'> Greska pri aktivaciji korisnickog naloga! </span>";
    }
}
