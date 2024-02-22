<?php
/* KONEKCIJA SA BAZOM */
$con = mysqli_connect('localhost', 'root', '', 'fiskalizacija');
if (mysqli_connect_errno()) {
    echo "Greska prilikom povezivanja sa bazom!";
}