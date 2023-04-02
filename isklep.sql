-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Maj 2022, 00:18
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `isklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `id_adres` int(11) NOT NULL,
  `miasto` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `ulica` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `numer` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `kod` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `tel` varchar(9) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `adres`
--

INSERT INTO `adres` (`id_adres`, `miasto`, `ulica`, `numer`, `kod`, `tel`) VALUES
(2, 'Siedlce', 'Lelewela', '15', '08-110', '148481456'),
(3, 'Siedlce', 'Nowa', '15', '08-110', '444888555'),
(4, 'Siedlce', 'Lelewela', '21', '08-110', '999888111');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id_kategoria` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id_kategoria`, `nazwa`) VALUES
(1, 'myszy'),
(2, 'Laptopy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klient` int(11) NOT NULL,
  `imie` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `czyPotwierdzone` varchar(1) COLLATE utf8_polish_ci DEFAULT '0',
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `token` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `id_adres` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_klient`, `imie`, `nazwisko`, `login`, `haslo`, `czyPotwierdzone`, `email`, `token`, `id_adres`) VALUES
(25, 'vggjpokeuuzmje', 'vggjpokeuuzmje', 'vggjpokeuuzmje', '63d3e6326922ab3ff04036aadc9dbcb1', '1', 'vggjpokeuuzmje@affecting.org', '2b1ba9f255d459c07831eed2677f5f7b', 0),
(27, 'huubi2001', 'huubi2001', 'huubi2001', 'd41d8cd98f00b204e9800998ecf8427e', '1', 'nawopex991@dkt1.com', '28a2f78b33158ae2e148512a38c3c198', 3),
(28, 'Jan', 'Zawadzki', 'minax23073', '26a6c59a91d21b7f519624688a20de11', '1', 'minax23073@questza.com', 'a5ec1b8a87d77d2bb8e7cebab27fe0f9', 4),
(30, 'Jan', 'Nowak', 'racexo5360', '1dada5e23cab5fb5ff7bbf44c52435b4', '0', 'racexo5360@1heizi.com', '71b4cd21e6b6241530321f366404a219', 0),
(31, 'woloxo9784', 'woloxo9784', 'woloxo9784', 'c4ef9123e90ef93e332952d439eecf20', '1', 'woloxo9784@1heizi.com', 'de9e6d02496827ded7079b73bf5b3c34', 0),
(32, 'Jan', 'SzarwiÅ„ski', 'yatig69936', 'ed8d79753ad32ed5b12462c56df91e5e', '0', 'yatig69936@sdysofa.com', '75fe6f8a912c096a97f1d6ed09425f9f', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id_pracownik` int(11) NOT NULL,
  `id_adres` int(11) NOT NULL,
  `id_kontakt` int(11) NOT NULL,
  `imie` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id_pracownik`, `id_adres`, `id_kontakt`, `imie`, `nazwisko`, `login`, `haslo`) VALUES
(1, 0, 0, 'Michal', 'Kowalski', 'michael123', 'fc041ed05ac319d5fe613877a7b1cfd2'),
(2, 0, 0, 'Janusz', 'Tracz', 'admin123', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id_produkt` int(11) NOT NULL,
  `id_kategoria` int(11) NOT NULL,
  `id_producent` int(11) NOT NULL,
  `nazwa` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `zdjecie` varchar(45) COLLATE utf8_polish_ci NOT NULL,
  `cena_netto` decimal(10,2) NOT NULL,
  `cena_brutto` decimal(10,2) NOT NULL,
  `ilosc` int(11) UNSIGNED NOT NULL,
  `data_dod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id_produkt`, `id_kategoria`, `id_producent`, `nazwa`, `opis`, `zdjecie`, `cena_netto`, `cena_brutto`, `ilosc`, `data_dod`) VALUES
(1, 1, 1, 'Mysz Razer Deathadder', 'Masna myszka', 'zdjecia/death.jpg', '150.00', '165.50', 6, NULL),
(2, 1, 1, 'Laptop Acer', 'Procesor i5 4.0GHz 4 rdzenie\r\n16GB RAM\r\nSystem Windows 10', 'zdjecia/lap.jpg', '2900.00', '3500.00', 44, NULL),
(3, 1, 1, 'Logitech g29', NULL, 'zdjecia/g29.jpg', '950.00', '1100.00', 4, NULL),
(4, 1, 1, 'Magic Mouse Apple', 'Magic Mouse oferuje prawdziwie nowatorski sposÃ³b dziaÅ‚ania. Jej gÅ‚adka powÅ‚oka peÅ‚ni podwÃ³jnÄ… funkcjÄ™: przyciskÃ³w myszy oraz powierzchni Multi-Touch z obsÅ‚ugÄ… gestÃ³w. CaÅ‚a gÃ³rna czÄ™Å›Ä‡ myszy reaguje na dotyk â€” wystarczy musnÄ…Ä‡ palcami ', 'zdjecia/5fbd37a7dcc480.64922914.jpg', '213.00', '307.50', 10, '2020-11-24 17:41:00'),
(5, 1, 1, 'Kabel USB-Lighting', 'DÅ‚ugoÅ›Ä‡: 1,2m<br />\r\nKolor: biaÅ‚y<br />\r\nSzybkie Å‚adowanie: tak', 'zdjecia/5fc12803ba11e8.86499224.jpg', '70.00', '86.10', 67, '2020-11-27 17:23:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienie` int(11) NOT NULL,
  `id_klient` int(11) NOT NULL,
  `zlozone` date NOT NULL,
  `dostarczone` date DEFAULT NULL,
  `dostawa` int(11) DEFAULT NULL,
  `czyPotwierdzone` varchar(1) COLLATE utf8_polish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienie`, `id_klient`, `zlozone`, `dostarczone`, `dostawa`, `czyPotwierdzone`) VALUES
(28, 27, '2020-11-26', NULL, NULL, '0'),
(29, 27, '2020-11-27', NULL, NULL, '1'),
(30, 27, '2020-11-27', NULL, NULL, '1'),
(31, 27, '2020-11-27', NULL, NULL, '1'),
(32, 28, '2020-11-27', NULL, NULL, '1'),
(33, 28, '2020-11-27', NULL, NULL, '1'),
(34, 28, '2020-11-27', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_produkty`
--

CREATE TABLE `zamowienia_produkty` (
  `id_zamowienie` int(11) NOT NULL,
  `id_produkt` int(11) NOT NULL,
  `ilosc` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zamowienia_produkty`
--

INSERT INTO `zamowienia_produkty` (`id_zamowienie`, `id_produkt`, `ilosc`) VALUES
(28, 1, 2),
(28, 2, 1),
(29, 3, 1),
(30, 4, 3),
(31, 1, 1),
(31, 2, 2),
(32, 5, 2),
(32, 1, 1),
(33, 5, 5),
(34, 5, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id_adres`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id_kategoria`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klient`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id_pracownik`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id_produkt`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adres`
--
ALTER TABLE `adres`
  MODIFY `id_adres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_kategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id_pracownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id_produkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
