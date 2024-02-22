-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2022 at 02:16 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fiskalizacija`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `korisnicko_ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`korisnicko_ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`korisnicko_ime`) VALUES
('marko'),
('petar');

-- --------------------------------------------------------

--
-- Table structure for table `artikal`
--

DROP TABLE IF EXISTS `artikal`;
CREATE TABLE IF NOT EXISTS `artikal` (
  `id_artikla` int(11) NOT NULL AUTO_INCREMENT,
  `sifra` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `naziv` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `jedinica_mere` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `poreska_stopa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `zemlja_porekla` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strani_naziv` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barkod` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `carinska_tarifa` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eko_taksa` tinyint(4) DEFAULT NULL COMMENT 'da/ne',
  `akciza` tinyint(4) DEFAULT NULL COMMENT 'da/ne',
  `min_zalihe` int(11) DEFAULT NULL,
  `max_zalihe` int(11) DEFAULT NULL,
  `opis` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deklaracija` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slika` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nabavna_cena` float NOT NULL,
  `prodajna_cena` float NOT NULL,
  `lager` int(11) NOT NULL,
  `kategorija` int(11) DEFAULT NULL,
  `id_objekta` int(11) NOT NULL,
  `id_preduzeca` int(11) NOT NULL,
  PRIMARY KEY (`id_artikla`),
  KEY `kategorija` (`kategorija`),
  KEY `naziv_objekta` (`id_objekta`),
  KEY `id_objekta` (`id_objekta`),
  KEY `id_preduzeca` (`id_preduzeca`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `artikal`
--

INSERT INTO `artikal` (`id_artikla`, `sifra`, `naziv`, `jedinica_mere`, `poreska_stopa`, `zemlja_porekla`, `strani_naziv`, `barkod`, `carinska_tarifa`, `eko_taksa`, `akciza`, `min_zalihe`, `max_zalihe`, `opis`, `deklaracija`, `slika`, `nabavna_cena`, `prodajna_cena`, `lager`, `kategorija`, `id_objekta`, `id_preduzeca`) VALUES
(1, '123321', 'Mleko', '2l', '10', 'Srbija', 'Milk', '00001111', '5', 1, 0, 10, 50, 'Mleko za decu', 'Mikail1', 'slike/kravica_mleko.jpg', 50, 120, 25, 1, 3, 2),
(3, '123456', 'Pavlaka', '100g', '10', 'Srbija', '', '10001000', '4', 1, 0, 2, 50, 'Kisela pavlaka', '', 'slike/pavlaka.jpg', 30, 90, 31, NULL, 3, 2),
(4, '000111', 'Jogurt gusti', '1,5l', '0', 'Srbija', 'Yogurt', '0001', NULL, 1, NULL, 10, 100, 'Gusti jogurt', NULL, 'slike/jogurt.jpg', 40, 110, 30, 1, 3, 2),
(6, '000001', 'Jogurt', '1l', '20', 'Srbija', 'Yogurt', '', '', 1, 1, 5, 55, 'Gusti jogurt 1l', '', 'slike/jogurt_2.jpg', 70, 99, 33, NULL, 3, 2),
(7, '000112', 'USB', '2GB', '20', 'Austrija', 'USB', '', '', 1, 0, 10, 100, 'USB sa 2GB memorije', '', 'slike/usb_kravica.jpg', 1500, 2400, 78, NULL, 3, 2),
(8, '000212', 'Beli sir', '0,5kg', '10', 'Srbija', 'White cheese', '001010', NULL, 1, NULL, 10, 25, 'Mladi beli sir idealnog ukusa', NULL, 'slike/beli_sir.jpg', 150, 220, 16, 3, 3, 2),
(9, '000132', 'Cok. mleko', '0,25l', '0', 'Srbija', 'Chocolate milk', '', '', 1, 0, 20, 70, 'Ukusno cokoladno mleko za decu', '', 'slike/cok_mleko1.jpg', 30, 55, 48, NULL, 3, 2),
(10, '001011', 'Bela kafa', '0,5l', '10', 'Amerika', 'White coffe', NULL, NULL, 1, 1, 10, 30, NULL, NULL, 'slike/bela_kafa.jpg', 90, 130, 19, NULL, 3, 2),
(11, '001321', 'Igracka', '50g', '0', 'Srbija', 'Toy', NULL, NULL, NULL, 1, 5, 15, 'Igracka za decu', NULL, 'slike/kravica_igracka.jpg', 100, 150, 10, NULL, 3, 2),
(12, '001111', 'Vanila', '0,25l', '0', 'Srbija', 'Vanila milk', '101011', NULL, 1, NULL, 10, 40, 'Osvezavajuce mleko sa ukusom vanile', NULL, 'slike/kravica_vanila.jpg', 50, 75, 28, NULL, 3, 2),
(13, '101102', 'Krem sir', '50g', '0', 'Srbija', NULL, NULL, NULL, NULL, NULL, 0, 19, NULL, NULL, 'slike/krem_sir.jpg', 89, 134, 10, NULL, 3, 2),
(14, '122911', 'Sladoled', '2kg', '10', NULL, NULL, NULL, NULL, 1, NULL, 10, 40, NULL, NULL, 'slike/sladoled.jpg', 300, 380, 34, NULL, 3, 2),
(15, '000001', 'Protein', '0,5l', '10', 'Srbija', '', '01011010', '', 1, 0, 20, 120, 'Proteinski napitak sa 30g proteina', '', 'slike/protein.jpg', 140, 220, 80, NULL, 8, 1),
(16, '000002', 'Protein', '0,5l', '10', 'Srbija', '', '', '', 1, 0, 10, 400, 'Proteinski napitag sa 30g proteina', '', 'slike/protein.jpg', 80, 120, 38, NULL, 7, 1),
(17, '000003', 'Sir', '150g', '0', 'Srbija', '', '', '', 1, 1, 20, 50, 'Sir za pravljenje sendvica', '', 'slike/sendvic_sir.jpg', 120, 180, 40, NULL, 8, 1),
(18, '000004', 'Zdenka', '200g', '20', 'Srbija', '', '', '', 1, 0, 20, 45, 'Namaz za jela', '', 'slike/sumadinka.jpg', 180, 230, 28, NULL, 8, 1),
(19, '000005', 'Jogood', '0,5l', '0', 'Srbija', '', '', '', 0, 0, 10, 100, 'Vocni jogurt sa ukusom sumskog voca', '', 'slike/jogood.jpg', 90, 110, 45, NULL, 7, 1),
(20, '000006', 'Jogood', '0,5l', '10', 'Srbija', '', '', '', 0, 0, 20, 200, 'Vocni jogurt sa ukusom sumskog voca', '', 'slike/jogood.jpg', 130, 160, 80, NULL, 8, 1),
(21, '000020', 'Sladoled', '2kg', '10', 'Srbija', '', '', '', 1, 0, 10, 25, 'Sladoled za porodicu', '', 'slike/sladoled.jpg', 250, 340, 17, NULL, 6, 2),
(22, '000007', 'Kajmak', '1kg', '10', 'Srbija', '', '', '', 1, 0, 10, 20, '', '', 'slike/podrazumevana.jpg', 200, 265, 13, NULL, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `delatnost`
--

DROP TABLE IF EXISTS `delatnost`;
CREATE TABLE IF NOT EXISTS `delatnost` (
  `id_delatnosti` int(11) NOT NULL AUTO_INCREMENT,
  `delatnost` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_delatnosti`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delatnost`
--

INSERT INTO `delatnost` (`id_delatnosti`, `delatnost`) VALUES
(1, 'Poljoprivreda'),
(2, 'Rudarstvo'),
(3, 'Informacione tehnologije'),
(4, 'Prehrana'),
(5, 'Obrazovanje'),
(6, 'Gradjevinarstvo'),
(7, 'Ostale usluzne delatnosti');

-- --------------------------------------------------------

--
-- Table structure for table `fiskalna_kasa`
--

DROP TABLE IF EXISTS `fiskalna_kasa`;
CREATE TABLE IF NOT EXISTS `fiskalna_kasa` (
  `id_fk` int(11) NOT NULL AUTO_INCREMENT,
  `vrsta_kase` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fiskalna_kasa`
--

INSERT INTO `fiskalna_kasa` (`id_fk`, `vrsta_kase`) VALUES
(1, 'Favourite'),
(2, 'Colibri'),
(3, 'Mobika'),
(4, 'Compact'),
(5, 'HCP Best'),
(6, 'HCP Integra');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

DROP TABLE IF EXISTS `kategorija`;
CREATE TABLE IF NOT EXISTS `kategorija` (
  `id_kategorije` int(11) NOT NULL AUTO_INCREMENT,
  `kategorija` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kategorije`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id_kategorije`, `kategorija`) VALUES
(1, 'Pica'),
(2, 'Slatkici'),
(3, 'Hrana'),
(5, 'Tehnologija'),
(6, 'Igracke');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `korisnicko_ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `kontakt_telefon` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mejl_adresa` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tip_korisnika` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A-Administrator, K-Kupac, P-Preduzece',
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'aktivan/neaktivan',
  `prva_prijava` tinyint(4) NOT NULL COMMENT '0-prvi, 1-drugi pristup',
  PRIMARY KEY (`korisnicko_ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnicko_ime`, `lozinka`, `ime`, `prezime`, `kontakt_telefon`, `mejl_adresa`, `tip_korisnika`, `status`, `prva_prijava`) VALUES
('esmir', 'e$m11R12', 'Esmir', 'Pljakic', '0631279789', 'esmir998@gmail.com', 'P', 'neaktivan', 0),
('goran', 'goran123', 'Goran', 'Spaleta', '0631231234', 'goran@gmail.com', 'K', 'aktivan', 1),
('jovan', 'jovan123', 'Jovan', 'Jovanovic', '0631234321', 'jovan88@gmail.com', 'P', 'aktivan', 1),
('marko', 'marko123', 'Marko', 'Markovic', '0631231234', 'marko@gmail.com', 'A', 'aktivan', 1),
('melek', 'meLeKa1$', 'Meleka', 'Papic', '0631279789', 'mel@gmail.com', 'P', 'neaktivan', 0),
('mihajlo', 'mihajlo123', 'Mihajlo', 'Stasevic', ' 0631231234', 'mihajlo@gmail.com', 'P', 'aktivan', 1),
('milan', 'milan123', 'Milan', 'Micic', '0633214321', 'milan98@gmail.com', 'P', 'neaktivan', 0),
('petar', 'petar123', 'Petar', 'Petrovic', '0631231234', 'petar@gmail.com', 'A', 'aktivan', 1),
('roko', 'roko123', 'Roko', 'Simic', '0631234321', 'roko@gmail.com', 'K', 'aktivan', 1),
('tamara', 'tamara123', 'Tamara', 'Tami', '0631231234', 'tamara@gmail.com', 'K', 'aktivan', 1),
('tomislav', 'tomi123', 'Tomislav', 'Rubinjoni', '0633214321', 'tomislav@gmail.com', 'K', 'aktivan', 1),
('zoran', 'zoran123', 'Zoran', 'Zoric', '0631234321', 'zoran88@gmail.com', 'P', 'neaktivan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kupac`
--

DROP TABLE IF EXISTS `kupac`;
CREATE TABLE IF NOT EXISTS `kupac` (
  `korisnicko_ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `licna_karta` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`korisnicko_ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kupac`
--

INSERT INTO `kupac` (`korisnicko_ime`, `licna_karta`) VALUES
('goran', '699784524'),
('roko', '147998057'),
('tamara', '915753852'),
('tomislav', '987486153');

-- --------------------------------------------------------

--
-- Table structure for table `narucioci`
--

DROP TABLE IF EXISTS `narucioci`;
CREATE TABLE IF NOT EXISTS `narucioci` (
  `id_narucioca` int(11) NOT NULL AUTO_INCREMENT,
  `id_preduzeca_1` int(11) NOT NULL,
  `id_preduzeca_2` int(11) NOT NULL,
  `broj_dana` int(11) DEFAULT NULL,
  `rabat` float DEFAULT NULL,
  PRIMARY KEY (`id_narucioca`),
  KEY `id_preduzeca_1` (`id_preduzeca_1`),
  KEY `id_preduzeca_2` (`id_preduzeca_2`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `narucioci`
--

INSERT INTO `narucioci` (`id_narucioca`, `id_preduzeca_1`, `id_preduzeca_2`, `broj_dana`, `rabat`) VALUES
(1, 2, 6, 10, 10),
(2, 2, 7, 5, 25);

-- --------------------------------------------------------

--
-- Table structure for table `objekat`
--

DROP TABLE IF EXISTS `objekat`;
CREATE TABLE IF NOT EXISTS `objekat` (
  `id_objekta` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `id_preduzeca` int(11) NOT NULL,
  `lokacija` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tip_kase` int(11) NOT NULL,
  PRIMARY KEY (`id_objekta`),
  KEY `naziv` (`naziv`),
  KEY `id_preduzeca` (`id_preduzeca`),
  KEY `tip_kase` (`tip_kase`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `objekat`
--

INSERT INTO `objekat` (`id_objekta`, `naziv`, `id_preduzeca`, `lokacija`, `tip_kase`) VALUES
(2, 'Mihajlo Beograd', 2, 'Nikole Tesle 7', 6),
(3, 'Mihajlo Novi Sad', 2, 'Mihajla Pupina 2', 5),
(6, 'Mihajlo Tutin', 2, 'Tutinska 22', 2),
(7, 'Jovan Nis', 1, 'Nis', 5),
(8, 'Jovan Beograd', 1, 'Beograd', 3);

-- --------------------------------------------------------

--
-- Table structure for table `preduzece`
--

DROP TABLE IF EXISTS `preduzece`;
CREATE TABLE IF NOT EXISTS `preduzece` (
  `korisnicko_ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `id_preduzeca` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `drzava` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `postanski_broj` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ulica_broj` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `pib` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `maticni_broj` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `broj_objekata` int(11) DEFAULT NULL,
  `broj_delatnosti` int(11) DEFAULT NULL,
  `broj_ziro_racuna` int(11) DEFAULT NULL,
  `pdv` tinyint(4) DEFAULT NULL COMMENT '0-nije, 1-jeste pdv',
  PRIMARY KEY (`korisnicko_ime`),
  KEY `id_preduzeca` (`id_preduzeca`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `preduzece`
--

INSERT INTO `preduzece` (`korisnicko_ime`, `id_preduzeca`, `naziv`, `drzava`, `grad`, `postanski_broj`, `ulica_broj`, `pib`, `maticni_broj`, `broj_objekata`, `broj_delatnosti`, `broj_ziro_racuna`, `pdv`) VALUES
('esmir', 6, 'Estrix', 'Srbija', 'Tutin', '36320', '29.Novembar 2/12', '123456789', '12345678', 1, NULL, NULL, NULL),
('jovan', 1, 'Imlek', 'Srbija', 'Beograd', '11000', 'Mije Kovacevica 7b', '105428306', '20376449', 2, 2, 2, 1),
('melek', 7, 'Melekas toys', 'Srbija', 'Sjenica', '36000', 'Njegoseva 20', '321654987', '32165498', NULL, NULL, NULL, NULL),
('mihajlo', 2, 'Kravica', 'Srbija', ' Beograd', '11000', 'Nikole Tesle 10', '199875461', '12597836', 3, 3, 3, 1),
('milan', 3, 'Swisslion Takovo', 'Srbija', 'Novi Sad', '400100', 'Stefana Stefanovica 2', '206974321', '33789578', 1, NULL, NULL, NULL),
('zoran', 4, 'Bambi', 'Srbija', 'Pozarevac', '12000', 'Djure Djakovica BB', '100436827', '07162936', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

DROP TABLE IF EXISTS `racun`;
CREATE TABLE IF NOT EXISTS `racun` (
  `id_racuna` int(11) NOT NULL AUTO_INCREMENT,
  `id_preduzeca` int(11) NOT NULL,
  `iznos_racuna` float NOT NULL,
  `iznos_poreza` float NOT NULL,
  `licna_karta` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ime` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prezime` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `broj_racuna` int(11) DEFAULT NULL,
  `narucilac` int(11) DEFAULT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id_racuna`),
  KEY `id_preduzeca` (`id_preduzeca`),
  KEY `narucilac` (`narucilac`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`id_racuna`, `id_preduzeca`, `iznos_racuna`, `iznos_poreza`, `licna_karta`, `ime`, `prezime`, `broj_racuna`, `narucilac`, `datum`) VALUES
(6, 2, 264, 10, NULL, NULL, NULL, NULL, NULL, '2022-07-13 09:08:29'),
(7, 2, 330, 10, NULL, NULL, NULL, NULL, NULL, '2022-07-13 09:12:12'),
(10, 2, 264, 10, '147998057', 'Roko', 'Simic', NULL, NULL, '2022-07-13 09:48:01'),
(11, 2, 396, 10, '987486153', NULL, NULL, 123, NULL, '2022-07-13 10:05:35'),
(12, 2, 693, 10, NULL, NULL, NULL, NULL, 6, '2022-07-13 11:25:48'),
(13, 2, 3140, 6.66667, '147998057', 'Roko', 'Simic', NULL, NULL, '2022-07-14 12:41:41'),
(14, 2, 1122, 10, '699784524', NULL, NULL, 2201, NULL, '2022-07-14 12:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `roba_sa_racuna`
--

DROP TABLE IF EXISTS `roba_sa_racuna`;
CREATE TABLE IF NOT EXISTS `roba_sa_racuna` (
  `id_rsr` int(11) NOT NULL AUTO_INCREMENT,
  `id_racuna` int(11) NOT NULL,
  `id_artikla` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  PRIMARY KEY (`id_rsr`),
  KEY `id_racuna` (`id_racuna`),
  KEY `id_artikla` (`id_artikla`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roba_sa_racuna`
--

INSERT INTO `roba_sa_racuna` (`id_rsr`, `id_racuna`, `id_artikla`, `kolicina`) VALUES
(2, 6, 1, 2),
(3, 7, 1, 1),
(4, 7, 3, 2),
(7, 10, 1, 2),
(8, 11, 3, 4),
(9, 12, 1, 3),
(10, 12, 3, 3),
(11, 13, 7, 1),
(12, 13, 9, 2),
(13, 13, 12, 2),
(14, 14, 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sifra_delatnosti`
--

DROP TABLE IF EXISTS `sifra_delatnosti`;
CREATE TABLE IF NOT EXISTS `sifra_delatnosti` (
  `id_sd` int(11) NOT NULL AUTO_INCREMENT,
  `id_preduzeca` int(11) NOT NULL,
  `delatnost` int(11) NOT NULL,
  PRIMARY KEY (`id_sd`),
  KEY `id_preduzeca` (`id_preduzeca`),
  KEY `delatnost` (`delatnost`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sifra_delatnosti`
--

INSERT INTO `sifra_delatnosti` (`id_sd`, `id_preduzeca`, `delatnost`) VALUES
(4, 2, 4),
(5, 2, 7),
(6, 2, 1),
(7, 1, 4),
(8, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ziro_racun`
--

DROP TABLE IF EXISTS `ziro_racun`;
CREATE TABLE IF NOT EXISTS `ziro_racun` (
  `id_zr` int(11) NOT NULL AUTO_INCREMENT,
  `id_preduzeca` int(11) NOT NULL,
  `racun` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `banka` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_zr`),
  KEY `id_preduzeca` (`id_preduzeca`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ziro_racun`
--

INSERT INTO `ziro_racun` (`id_zr`, `id_preduzeca`, `racun`, `banka`) VALUES
(1, 2, '222-222222222222-11', 'Intesa'),
(2, 2, '222-333333333333-22', 'Komercijalna'),
(4, 2, '333-222222222222-11', 'Unicredit'),
(5, 1, '000-123456789876-11', 'ERSTE BANK'),
(6, 1, '111-123456789876-00', 'HALKBANK');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`korisnicko_ime`) REFERENCES `korisnik` (`korisnicko_ime`);

--
-- Constraints for table `artikal`
--
ALTER TABLE `artikal`
  ADD CONSTRAINT `artikal_ibfk_1` FOREIGN KEY (`id_objekta`) REFERENCES `objekat` (`id_objekta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artikal_ibfk_2` FOREIGN KEY (`kategorija`) REFERENCES `kategorija` (`id_kategorije`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artikal_ibfk_3` FOREIGN KEY (`id_preduzeca`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kupac`
--
ALTER TABLE `kupac`
  ADD CONSTRAINT `kupac_ibfk_1` FOREIGN KEY (`korisnicko_ime`) REFERENCES `korisnik` (`korisnicko_ime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `narucioci`
--
ALTER TABLE `narucioci`
  ADD CONSTRAINT `narucioci_ibfk_1` FOREIGN KEY (`id_preduzeca_1`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `narucioci_ibfk_2` FOREIGN KEY (`id_preduzeca_2`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `objekat`
--
ALTER TABLE `objekat`
  ADD CONSTRAINT `objekat_ibfk_1` FOREIGN KEY (`id_preduzeca`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `objekat_ibfk_2` FOREIGN KEY (`tip_kase`) REFERENCES `fiskalna_kasa` (`id_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preduzece`
--
ALTER TABLE `preduzece`
  ADD CONSTRAINT `preduzece_ibfk_1` FOREIGN KEY (`korisnicko_ime`) REFERENCES `korisnik` (`korisnicko_ime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `racun_ibfk_1` FOREIGN KEY (`id_preduzeca`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `racun_ibfk_2` FOREIGN KEY (`narucilac`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roba_sa_racuna`
--
ALTER TABLE `roba_sa_racuna`
  ADD CONSTRAINT `roba_sa_racuna_ibfk_1` FOREIGN KEY (`id_racuna`) REFERENCES `racun` (`id_racuna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roba_sa_racuna_ibfk_2` FOREIGN KEY (`id_artikla`) REFERENCES `artikal` (`id_artikla`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sifra_delatnosti`
--
ALTER TABLE `sifra_delatnosti`
  ADD CONSTRAINT `sifra_delatnosti_ibfk_1` FOREIGN KEY (`id_preduzeca`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sifra_delatnosti_ibfk_2` FOREIGN KEY (`delatnost`) REFERENCES `delatnost` (`id_delatnosti`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ziro_racun`
--
ALTER TABLE `ziro_racun`
  ADD CONSTRAINT `ziro_racun_ibfk_1` FOREIGN KEY (`id_preduzeca`) REFERENCES `preduzece` (`id_preduzeca`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
