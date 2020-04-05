-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 apr 2020 om 23:22
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schiphol`
--

CREATE DATABASE schiphol;

USE schiphol;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `melden_klachtsoort` ()  BEGIN
    SELECT
        klachtsoort
    FROM
        klachtsoort
    ORDER BY
        ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `melden_postcode` ()  BEGIN
	SELECT postcode 
    FROM postcode 
    ORDER BY postcode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `overzicht_gebruikview_` ()  BEGIN
	SELECT
    k.ID AS Nr,
    p.postcode AS Postcode,
    k.datum AS Datum,
    ks.klachtsoort AS Soort
FROM
    klacht k
LEFT OUTER JOIN postcode p ON
    k.ID_postcode = p.ID
LEFT OUTER JOIN klachtsoort ks ON
    k.ID_klachtsoort = ks.ID
WHERE
    p.ID IS NOT NULL OR ks.ID IS NOT NULL
ORDER BY
    p.postcode AND k.datum;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `overzicht_totaal` ()  BEGIN
SELECT
    ks.klachtsoort AS klacht,
    COUNT(k.ID_klachtsoort) AS aantal
FROM
    klachtsoort ks,
    klacht k
    WHERE ks.ID = k.ID_klachtsoort
GROUP BY ks.ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `over_ons_postcode` ()  BEGIN
SELECT postcode FROM postcode ORDER BY postcode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `toevoegen_gebruiker` (IN `naam` VARCHAR(45), IN `postcode` SMALLINT(6), IN `geslacht` VARCHAR(1), IN `geboortedatum` DATE, IN `klacht` SMALLINT(6))  BEGIN
    INSERT INTO gebruiker
VALUES(
    '',
    naam,
    postcode,
    geslacht,
    geboortedatum,
    email
);
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `ID` smallint(6) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `ID_postcode` smallint(6) NOT NULL,
  `geslacht` varchar(1) NOT NULL,
  `geboortedatum` date NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`ID`, `naam`, `ID_postcode`, `geslacht`, `geboortedatum`, `email`) VALUES
(1, 'John van den Berg', 1, 'M', '1984-10-07', 'jvdb@live.nl'),
(2, 'Celia Hayna', 5, 'V', '1986-05-24', 'ch@gnail.com'),
(3, 'Justin Boom', 6, 'M', '1991-05-03', 'jv@live.nl'),
(4, 'Roemer Gallo', 5, 'M', '1085-05-31', 'rg@hotmail.com'),
(5, 'Dixie Normus', 2, 'v', '1989-12-07', 'dix-e@nor.mus'),
(6, 'Mike Wiener', 4, 'm', '1978-02-17', 'wiener@mike.net'),
(7, 'Annas Rhammar', 2, 'v', '1965-06-14', 'asrhmr@gmail.com'),
(8, 'dion potkamp', 2, 'm', '1998-03-05', 'd.p@gmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klacht`
--

CREATE TABLE `klacht` (
  `ID` smallint(6) NOT NULL,
  `ID_gebruiker` smallint(6) NOT NULL,
  `ID_klachtsoort` smallint(6) NOT NULL,
  `ID_postcode` smallint(6) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klacht`
--

INSERT INTO `klacht` (`ID`, `ID_gebruiker`, `ID_klachtsoort`, `ID_postcode`, `datum`) VALUES
(1, 1, 1, 1, '2016-05-01 16:00:00'),
(2, 2, 2, 5, '2016-05-11 17:30:00'),
(3, 3, 3, 6, '2016-01-10 08:30:30'),
(4, 3, 3, 5, '2016-05-10 09:45:00'),
(6, 5, 2, 2, '2019-03-26 20:25:33'),
(7, 6, 2, 4, '2019-03-26 20:28:29'),
(8, 7, 3, 2, '2019-03-26 20:33:48'),
(9, 8, 3, 2, '2019-03-27 11:13:54'),
(10, 8, 4, 2, '2019-03-27 11:14:37');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klachtsoort`
--

CREATE TABLE `klachtsoort` (
  `ID` smallint(6) NOT NULL,
  `klachtsoort` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klachtsoort`
--

INSERT INTO `klachtsoort` (`ID`, `klachtsoort`) VALUES
(1, 'milieu'),
(2, 'veiligheid'),
(3, 'geluid'),
(4, 'Stank');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `overzicht_tabel`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `overzicht_tabel` (
`Nr` smallint(6)
,`Postcode` varchar(7)
,`Datum` timestamp
,`Soort` varchar(50)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `postcode`
--

CREATE TABLE `postcode` (
  `ID` smallint(6) NOT NULL,
  `postcode` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `postcode`
--

INSERT INTO `postcode` (`ID`, `postcode`) VALUES
(1, '1098 LV'),
(2, '1098 LX'),
(3, '1098 XX'),
(4, '1099 TT'),
(5, '1999 BB'),
(6, '2000 AA');

-- --------------------------------------------------------

--
-- Structuur voor de view `overzicht_tabel`
--
DROP TABLE IF EXISTS `overzicht_tabel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `overzicht_tabel`  AS  select `k`.`ID` AS `Nr`,`p`.`postcode` AS `Postcode`,`k`.`datum` AS `Datum`,`ks`.`klachtsoort` AS `Soort` from ((`klacht` `k` left join `postcode` `p` on(`k`.`ID_postcode` = `p`.`ID`)) left join `klachtsoort` `ks` on(`k`.`ID_klachtsoort` = `ks`.`ID`)) where `p`.`ID` is not null or `ks`.`ID` is not null order by `p`.`postcode` <> 0 and `k`.`datum` <> 0 ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `naam` (`naam`);

--
-- Indexen voor tabel `klacht`
--
ALTER TABLE `klacht`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `ID_gebruiker` (`ID_gebruiker`),
  ADD KEY `ID_klachtsoort` (`ID_klachtsoort`);

--
-- Indexen voor tabel `klachtsoort`
--
ALTER TABLE `klachtsoort`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `postcode`
--
ALTER TABLE `postcode`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `klacht`
--
ALTER TABLE `klacht`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `klachtsoort`
--
ALTER TABLE `klachtsoort`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `postcode`
--
ALTER TABLE `postcode`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;