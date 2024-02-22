<div id="odjava_logout">
    <!-- FORMA KOJA SE POJAVLJUJE NA SVAKOJ STRANI - ODJAVA KORISNIKA -->
    <form name="odjava" method="POST">
        <input type="submit" id="dugme_2" name="promena_lozinke" value="PROMENI LOZINKU">
        <input type="submit" id="dugme_2" name="odjava" value="ODJAVI SE">
    </form>

    <?php
        ob_start();
        if (!empty($_POST['odjava'])) {
            unset($_SESSION['ime']);
            unset($_SESSION['korisnicko_ime']);
            unset($_SESSION['tip_korisnika']);
            unset($_SESSION['prva_prijava']);
            unset($_SESSION['lozinka']);
            session_destroy();
            header('Location:index.php');
            exit();
        }
        if(!empty($_POST['promena_lozinke'])){
            header('Location:promena_lozinke.php');
        }
    ?>  
</div>