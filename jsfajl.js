/*
 * Funkcija koja sluzi za proveru polja prilikom registracije preduzeca.
 * Ukoliko je sve ok forma ce biti submitovana u suprotnom forma nece biti submitovana.
 */
function registracijapreduzeca() {

    var ime = document.registracija.ime.value;
    var prezime = document.registracija.prezime.value;
    var kor_ime = document.registracija.kor_ime.value;
    var lozinka1 = document.registracija.lozinka1.value;
    var lozinka2 = document.registracija.lozinka2.value;
    var mejl_adresa = document.registracija.mejl_adresa.value;
    var naziv_preduzeca = document.registracija.naziv_preduzeca.value;
    var drzava = document.registracija.drzava.value;
    var grad = document.registracija.grad.value;
    var postanski_broj = document.registracija.postanski_broj.value;
    var ulica_broj = document.registracija.ulica_broj.value;
    var pib = document.registracija.pib.value;
    var maticni_broj = document.registracija.maticni_broj.value;

    if (ime.length == 0 || prezime.length == 0 || kor_ime.length == 0 || lozinka1.length == 0 || lozinka2.length == 0 || mejl_adresa.length == 0 || naziv_preduzeca.length == 0 || drzava.length == 0 || grad.length == 0 || postanski_broj.length == 0 || ulica_broj.length == 0 || pib.length == 0 || maticni_broj.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (lozinka1 == lozinka2) {
            var uzorak_lozinka = /^[a-zA-Z](?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,11}$/;
            var uzorak_pib = /^[1-9]\d{8}$/;
            if (uzorak_lozinka.test(lozinka1)) {
                if (uzorak_pib.test(pib)) {
                    return (true);
                } else {
                    alert("PIB ne sme pocinjati 0 i mora imati 9 cifara!");
                    return (false);
                }
            } else {
                alert("Lozinka mora biti u odgovarajucem formatu!");
                return (false);
            }
        } else {
            alert("Lozinke se ne poklapaju!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom promene lozinke korisnika.
 * Ukoliko je sve ok forma ce biti submitovana i lozinka ce se promeniti, u suprotnom nece.
 */
function promenalozinke() {

    var stara_lozinka_baza = document.forma_lozinka.stara_loz_baza.value;
    var stara_lozinka = document.forma_lozinka.stara_loz.value;
    var lozinka1 = document.forma_lozinka.lozinka1.value;
    var lozinka2 = document.forma_lozinka.lozinka2.value;

    if (stara_lozinka.length == 0 || lozinka1.length == 0 || lozinka2.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (stara_lozinka == stara_lozinka_baza) {
            if (lozinka1 == lozinka2) {
                var uzorak_lozinka = /^[a-zA-Z](?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,11}$/;
                if (uzorak_lozinka.test(lozinka1)) {
                    return (true);
                } else {
                    alert("Lozinka mora biti u odgovarajucem formatu!");
                    return (false);
                }
            } else {
                alert("Lozinke se ne poklapaju!");
                return (false);
            }
        } else {
            alert("Pogresno uneta stara lozinka!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom dodavanja novog kupca u sistem.
 * Ukoliko je sve ok forma ce biti submitovana i korisnik ce biti dodat u sistem, u suprotnom nece.
 */
function admindodajkupca() {
    var ime = document.dodaj_kupca.ime.value;
    var prezime = document.dodaj_kupca.prezime.value;
    var kor_ime = document.dodaj_kupca.kor_ime.value;
    var lozinka1 = document.dodaj_kupca.lozinka1.value;
    var lozinka2 = document.dodaj_kupca.lozinka2.value;
    var telefon = document.dodaj_kupca.telefon.value;
    var mejl_adresa = document.dodaj_kupca.mejl_adresa.value;
    var licna_karta = document.dodaj_kupca.licna_karta.value;

    if (ime.length == 0 || prezime.length == 0 || kor_ime.length == 0 || lozinka1.length == 0 || lozinka2.length == 0 || mejl_adresa.length == 0 || telefon.length == 0 || licna_karta.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (lozinka1 == lozinka2) {
            var uzorak_lozinka1 = /^[a-zA-Z](?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,11}$/;
            var uzorak_lozinka = /^([a-zA-Z].*)(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{7,11}$/;
            var licna_karta_uzorak = /^\d{9}$/;
            if (uzorak_lozinka1.test(lozinka1)) {
                if (licna_karta_uzorak.test(licna_karta)) {
                    return (true);
                } else {
                    alert("Licna karta mora imati 9 cifara!");
                    return (false);
                }
            } else {
                alert("Lozinka mora biti u odgovarajucem formatu!");
                return (false);
            }
        } else {
            alert("Lozinke se ne poklapaju!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom dodavanja novog preduzeca u sistem.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function admindodajpreduzece() {
    var ime = document.dodaj_preduzece.ime.value;
    var prezime = document.dodaj_preduzece.prezime.value;
    var kor_ime = document.dodaj_preduzece.kor_ime.value;
    var lozinka1 = document.dodaj_preduzece.lozinka1.value;
    var lozinka2 = document.dodaj_preduzece.lozinka2.value;
    var telefon = document.dodaj_preduzece.telefon.value;
    var mejl_adresa = document.dodaj_preduzece.mejl_adresa.value;
    var naziv_preduzeca = document.dodaj_preduzece.naziv_preduzeca.value;
    var drzava = document.dodaj_preduzece.drzava.value;
    var grad = document.dodaj_preduzece.grad.value;
    var postanski_broj = document.dodaj_preduzece.postanski_broj.value;
    var ulica_broj = document.dodaj_preduzece.ulica_broj.value;
    var pib = document.dodaj_preduzece.pib.value;
    var maticni_broj = document.dodaj_preduzece.maticni_broj.value;

    if (ime.length == 0 || prezime.length == 0 || kor_ime.length == 0 || lozinka1.length == 0 || lozinka2.length == 0 || telefon.value == 0 || mejl_adresa.length == 0 || naziv_preduzeca.length == 0 || drzava.length == 0 || grad.length == 0 || postanski_broj.length == 0 || ulica_broj.length == 0 || pib.length == 0 || maticni_broj.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (lozinka1 == lozinka2) {
            var uzorak_lozinka = /^[a-zA-Z](?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,11}$/;
            var uzorak_pib = /^[1-9]\d{8}$/;
            if (uzorak_lozinka.test(lozinka1)) {
                if (uzorak_pib.test(pib)) {
                    return (true);
                } else {
                    alert("PIB ne sme pocinjati 0 i mora imati 9 cifara!");
                    return (false);
                }
            } else {
                alert("Lozinka mora biti u odgovarajucem formatu!");
                return (false);
            }
        } else {
            alert("Lozinke se ne poklapaju!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom prve prvijave novog preduzeca u sistem.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proveriinfpreduzece() {
    var broj_delatnosti = document.forma_preduzece_doc.broj_delatnosti.value;
    var broj_fiskalnih_kasa = document.forma_preduzece_doc.broj_fiskalnih_kasa.value;
    var broj_ziro_racuna = document.forma_preduzece_doc.broj_ziro_racuna.value;

    if (broj_delatnosti.length == 0 || broj_fiskalnih_kasa.length == 0 || broj_ziro_racuna.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (broj_fiskalnih_kasa >= 1) {
            window.location.href = "preduzece_prva_prijava_nastavak.php";

        } else {
            alert("Broj fiskalnih kasa mora biti >= 1!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom prve prvijave novog preduzeca u sistem.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proveripodatkepreduzece() {

    var broj_objekata = document.forma_preduzece_informacije.broj_objekata.value;
    var broj_ziro_racuna = document.forma_preduzece_informacije.broj_ziro_racuna.value;

    var prazno_racuni = 0;
    var prazno_objekti = 0;

    var ziro_racun_uzorak = /^\d{3}-\d{12}-\d{2}$/;

    /* PROVERA UNETIH ZIRO RACUNA */
    for (let i = 0; i < broj_ziro_racuna; i++) {
        var zr = "ziroracun_".concat(i);
        var bank = "banka_".concat(i);

        var zr_v = document.getElementById(zr).value;
        var bank_v = document.getElementById(bank).value;

        if (zr_v.length == 0 || bank_v.length == 0) {
            prazno_racuni = 1;
        }

        if (!(ziro_racun_uzorak.test(zr_v))) {
            prazno_racuni = 1;
        }
    }

    /* PROVERA UNETIH FISKALNIH KASA */
    for (let i = 0; i < broj_objekata; i++) {
        var obj = "objekat_".concat(i);
        var lok = "lokacija_".concat(i);

        var obj_v = document.getElementById(obj).value;
        var lok_v = document.getElementById(lok).value;

        if (obj_v.length == 0 || lok_v.length == 0) {
            prazno_objekti = 1;
        }
    }


    if (prazno_objekti != 0 || prazno_racuni != 0) {
        alert("Svi podaci moraju biti ispravno uneti!");
        return (false);
    } else {
        return (true);
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom izmene opstih informacija preduzeca.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proveriopstepodatke() {
    var ime = document.opsti_podaci.ime.value;
    var prezime = document.opsti_podaci.prezime.value;
    var telefon = document.opsti_podaci.telefon.value;
    var mejl_adresa = document.opsti_podaci.mejl_adresa.value;

    var naziv_preduzeca = document.opsti_podaci.naziv_preduzeca.value;
    var drzava = document.opsti_podaci.drzava.value;
    var grad = document.opsti_podaci.grad.value;
    var postanski_broj = document.opsti_podaci.postanski_broj.value;
    var ulica_broj = document.opsti_podaci.ulica_broj.value;
    var pib = document.opsti_podaci.pib.value;
    var maticni_broj = document.opsti_podaci.maticni_broj.value;

    if (ime.length == 0 || prezime.length == 0 || telefon.value == 0 || mejl_adresa.length == 0 || naziv_preduzeca.length == 0 || drzava.length == 0 || grad.length == 0 || postanski_broj.length == 0 || ulica_broj.length == 0 || pib.length == 0 || maticni_broj.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        var uzorak_pib = /^[1-9]\d{8}$/;
        if (uzorak_pib.test(pib)) {
            return (true);
        } else {
            alert("PIB ne sme pocinjati 0 i mora imati 9 cifara!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom izmene ziro racuna preduzeca.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proveriziroracune() {
    var broj_ziro_racuna = document.ziro_racun.broj_ziro_racuna.value;
    var prazno_racuni = 0;
    var ziro_racun_uzorak = /^\d{3}-\d{12}-\d{2}$/;

    /* PROVERA UNETIH ZIRO RACUNA */
    for (let i = 0; i < broj_ziro_racuna; i++) {
        var zr = "ziroracun_".concat(i);
        var bank = "banka_".concat(i);

        var zr_v = document.getElementById(zr).value;
        var bank_v = document.getElementById(bank).value;

        if (zr_v.length == 0 || bank_v.length == 0) {
            prazno_racuni = 1;
        }

        if (!(ziro_racun_uzorak.test(zr_v))) {
            prazno_racuni = 1;
        }
    }

    if (prazno_racuni != 0) {
        alert("Svi podaci moraju biti ispravno uneti!");
        return (false);
    } else {
        return (true);
    }

}

/*
 * Funkcija koja sluzi za proveru polja prilikom dodavanja novog ziro racuna.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proverinovizr() {
    var prazno_racuni = 0;
    var ziro_racun_uzorak = /^\d{3}-\d{12}-\d{2}$/;

    /* PROVERA UNETIH ZIRO RACUNA */
    var zr = document.forma_novi_zr.ziroracun.value;
    var bank = document.forma_novi_zr.banka.value;

    if (zr.length == 0 || bank.length == 0) {
        prazno_racuni = 1;
    }

    if (!(ziro_racun_uzorak.test(zr))) {
        prazno_racuni = 1;
    }

    if (prazno_racuni != 0) {
        alert("Svi podaci moraju biti ispravno uneti!");
        return (false);
    } else {
        return (true);
    }

}

/*
 * Funkcija koja sluzi za proveru polja prilikom izmene fiskalnih kasa preduzeca.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proverifiskalnekase() {
    var broj_objekata = document.fiskalna_kasa.broj_objekata.value;
    var prazno_objekti = 0;

    /* PROVERA UNETIH FISKALNIH KASA */
    for (let i = 0; i < broj_objekata; i++) {
        var obj = "objekat_".concat(i);
        var lok = "lokacija_".concat(i);

        var obj_v = document.getElementById(obj).value;
        var lok_v = document.getElementById(lok).value;

        if (obj_v.length == 0 || lok_v.length == 0) {
            prazno_objekti = 1;
        }
    }

    if (prazno_objekti != 0) {
        alert("Svi podaci moraju biti ispravno uneti!");
        return (false);
    } else {
        return (true);
    }

}

/*
 * Funkcija koja sluzi za proveru polja prilikom dodavanja nove fiskalne kase.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proverinovufk() {
    var prazno_objekti = 0;

    /* PROVERA UNETIH ZIRO RACUNA */
    var obj = document.forma_nova_fk.objekat.value;
    var lok = document.forma_nova_fk.lokacija.value;

    if (obj.length == 0 || lok.length == 0) {
        prazno_objekti = 1;
    }

    if (prazno_objekti != 0) {
        alert("Svi podaci moraju biti ispravno uneti!");
        return (false);
    } else {
        return (true);
    }

}

/*
 * Funkcija koja sluzi za proveru polja prilikom unosenja novog narucioca.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function naruciociprovera() {
    var ime = document.narucioci.ime.value;
    var prezime = document.narucioci.prezime.value;
    var kor_ime = document.narucioci.kor_ime.value;
    var lozinka1 = document.narucioci.lozinka1.value;
    var lozinka2 = document.narucioci.lozinka2.value;
    var mejl_adresa = document.narucioci.mejl_adresa.value;
    var telefon = document.narucioci.telefon.value;
    var naziv_preduzeca = document.narucioci.naziv_preduzeca.value;
    var drzava = document.narucioci.drzava.value;
    var grad = document.narucioci.grad.value;
    var postanski_broj = document.narucioci.postanski_broj.value;
    var ulica_broj = document.narucioci.ulica_broj.value;
    var pib = document.narucioci.pib.value;
    var maticni_broj = document.narucioci.maticni_broj.value;
    var broj_dana = document.narucioci.broj_dana.value;
    var rabat = document.narucioci.rabat.value;

    if (ime.length == 0 || prezime.length == 0 || kor_ime.length == 0 || lozinka1.length == 0 || lozinka2.length == 0 || mejl_adresa.length == 0 || telefon.length == 0 || naziv_preduzeca.length == 0 || drzava.length == 0 || grad.length == 0 || postanski_broj.length == 0 || ulica_broj.length == 0 || pib.length == 0 || maticni_broj.length == 0 || broj_dana.length == 0 || rabat.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (lozinka1 == lozinka2) {
            var uzorak_lozinka = /^[a-zA-Z](?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,11}$/;
            var uzorak_pib = /^[1-9]\d{8}$/;
            if (uzorak_lozinka.test(lozinka1)) {
                if (uzorak_pib.test(pib)) {
                    return (true);
                } else {
                    alert("PIB ne sme pocinjati 0 i mora imati 9 cifara!");
                    return (false);
                }
            } else {
                alert("Lozinka mora biti u odgovarajucem formatu!");
                return (false);
            }
        } else {
            alert("Lozinke se ne poklapaju!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom pretrage preduzeca.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function naruciocipretragaprovera() {
    var pib = document.pretraga_narucioca.pib_pretraga.value;
    var uzorak_pib = /^[1-9]\d{8}$/;
    var pretraga = 0;

    if (pib.length == 0) {
        pretraga = 1;
    }

    if (!(uzorak_pib.test(pib))) {
        pretraga = 1;
    }

    if (pretraga != 0) {
        alert("PIB mora biti ispravno!");
        return (false);
    } else {
        return (true);
    }
}

/*
 * Funkcija koja sluzi za proveru polja dodavanja dodatnih informacija za narucioca.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function naruciocidodatnaprovera() {
    var broj_dana = document.narucioci_dodatno.broj_dana.value;
    var rabat = document.narucioci_dodatno.rabat.value;
    var prazno = 0;

    if (broj_dana.length == 0 || rabat.length == 0) {
        prazno = 1;
    }

    if (prazno != 0) {
        alert("Sva polja moraju biti ispravno uneta!");
        return (false);
    } else {
        return (true);
    }
}


/*
 * Funkcija koja sluzi za proveru polja prilikom dodavanja novog artikla.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function dodajartikal() {
    var sifra_artikla = document.dodaj_artikal.sifra_artikla.value;
    var naziv_artikla = document.dodaj_artikal.naziv_artikla.value;
    var jedinica_mere = document.dodaj_artikal.jedinica_mere.value;
    var poreska_stopa = document.dodaj_artikal.poreska_stopa.value;

    var nabavna_cena = document.dodaj_artikal.nabavna_cena.value;
    var prodajna_cena = document.dodaj_artikal.prodajna_cena.value;
    var lager = document.dodaj_artikal.lager.value;

    var poreska_stopa_uzorak = /^(0|10|20)$/;

    if (sifra_artikla.length == 0 || naziv_artikla.length == 0 || jedinica_mere.length == 0 || poreska_stopa.length == 0 || nabavna_cena.length == 0 || prodajna_cena.length == 0 || lager.length == 0) {
        alert("Sva polja moraju biti ispravno uneta!");
        return (false);
    }

    if (!(poreska_stopa_uzorak.test(poreska_stopa))) {
        alert("Poreska stopa moze biti 0/10/20 %!");
        return (false);
    }

    return (true);
}

/*
 * Funkcija koja sluzi za proveru polja prilikom dodavanja nove kategorije.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function novakategorija() {
    var kategorija = document.nova_kategorija.naziv_kategorije.value;

    if (kategorija.length == 0) {
        alert("Unesite naziv kategorije!");
        return (false);
    } else {
        return (true);
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom unosenja kolicine artikala.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proverikolicinu() {
    var kolicina = document.kolicina.kolicina.value;

    if (kolicina.length != 0) {
        if (!isNaN(kolicina)) {
            return (true);
        } else {
            alert("Unesite brojcanu vrednost za kolicinu!");
            return (false);
        }
    } else {
        alert("Unesite koju kolicinu zelite!");
        return (false);
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom gotovinskog placanja.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proverigotovinu() {
    var gotovina = document.gotovina.gotovina.value;

    if (gotovina.length != 0) {
        if (!isNaN(gotovina)) {
            return (true);
        } else {
            alert("Unesite brojcanu vrednost za gotovinu!");
            return (false);
        }
    } else {
        alert("Upisite vrednost u polje gotovina!");
        return (false);
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom placanja cekom.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function provericek() {
    var ime = document.cek.ime.value;
    var prezime = document.cek.prezime.value;
    var licna_karta = document.cek.licna_karta.value;

    var uzorak_licna_karta = /^\d{9}$/;

    if (ime.length == 0 || prezime.length == 0 || licna_karta.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (uzorak_licna_karta.test(licna_karta)) {
            return (true);
        } else {
            alert("Licna karta mora sadrzati 9 cifara!");
            return (false);
        }
    }
}

/*
 * Funkcija koja sluzi za proveru polja prilikom placanja karticom.
 * Ukoliko je sve ok forma ce biti submitovana i preduzece ce biti dodato u sistem, u suprotnom nece.
 */
function proverikarticu() {
    var slip_racun = document.kartica.slip_racun.value;
    var licna_karta = document.kartica.licna_karta.value;

    var uzorak_licna_karta = /^\d{9}$/;

    if (slip_racun.length == 0 || licna_karta.length == 0) {
        alert("Sva polja moraju biti popunjena!");
        return (false);
    } else {
        if (uzorak_licna_karta.test(licna_karta)) {
            return (true);
        } else {
            alert("Licna karta mora sadrzati 9 cifara!");
            return (false);
        }
    }
}