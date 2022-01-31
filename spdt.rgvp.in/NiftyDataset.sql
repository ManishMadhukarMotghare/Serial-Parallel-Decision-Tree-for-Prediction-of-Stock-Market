-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2021 at 11:37 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rgvpiqgy_rnd_spdt`
--

-- --------------------------------------------------------

--
-- Table structure for table `NiftyDataset`
--

CREATE TABLE `NiftyDataset` (
  `ID` int(11) NOT NULL,
  `Nifty50` decimal(12,2) NOT NULL,
  `SGXNifty` decimal(12,2) NOT NULL,
  `DJIA30` decimal(12,2) NOT NULL,
  `Nasdaq100` decimal(12,2) NOT NULL,
  `Russel2000` decimal(12,2) NOT NULL,
  `SnP500` decimal(12,2) NOT NULL,
  `FTSE100` decimal(12,2) NOT NULL,
  `Nikkei225` decimal(12,2) NOT NULL,
  `CAC40` decimal(12,2) NOT NULL,
  `DAX30` decimal(12,2) NOT NULL,
  `HangSeng` decimal(12,2) NOT NULL,
  `SSE180` decimal(12,2) NOT NULL,
  `MCXBulldex` decimal(12,2) NOT NULL,
  `GoldFutureIndia` decimal(12,2) NOT NULL,
  `CrudeOil` decimal(12,2) NOT NULL,
  `WebInfoData` int(11) NOT NULL,
  `IndianTVNews` int(11) NOT NULL,
  `SocialMediaFeed` int(11) NOT NULL,
  `BrokeragesHouseNews` int(11) NOT NULL,
  `FIISData` int(11) NOT NULL,
  `DIISData` int(11) NOT NULL,
  `GlobalTrend` int(11) NOT NULL,
  `Nifty50WeeklyExpiry` int(11) NOT NULL,
  `Nifty50MonthlyExpiry` int(11) NOT NULL,
  `PandemicWarSituation` int(11) NOT NULL,
  `Output` enum('Buy','Sell') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NiftyDataset`
--

INSERT INTO `NiftyDataset` (`ID`, `Nifty50`, `SGXNifty`, `DJIA30`, `Nasdaq100`, `Russel2000`, `SnP500`, `FTSE100`, `Nikkei225`, `CAC40`, `DAX30`, `HangSeng`, `SSE180`, `MCXBulldex`, `GoldFutureIndia`, `CrudeOil`, `WebInfoData`, `IndianTVNews`, `SocialMediaFeed`, `BrokeragesHouseNews`, `FIISData`, `DIISData`, `GlobalTrend`, `Nifty50WeeklyExpiry`, `Nifty50MonthlyExpiry`, `PandemicWarSituation`, `Output`) VALUES
(1, 11300.55, 11109.65, 26550.90, 10513.71, 1482.59, 3242.72, 6129.26, 22657.38, 4928.94, 28.15, 24772.76, 10321.90, 1698.55, 52186.00, 41.39, 1, -1, 1, 1, 1, 1, 1, 1, 1, -1, 'Buy'),
(2, 11131.80, 11274.20, 26584.77, 10536.27, 1484.65, 3239.41, 6100.54, 22715.85, 4939.62, 28.27, 24603.26, 10362.88, 1561.35, 51277.00, 41.74, 1, 1, 1, -1, 1, -1, 1, 1, 1, -1, 'Sell'),
(3, 11194.15, 11174.75, 26469.89, 10363.18, 1467.55, 3215.63, 5915.24, 22751.61, 4956.43, 28.00, 24705.33, 10387.20, 1504.60, 52186.00, 41.13, -1, -1, -1, 1, -1, 1, -1, 1, 1, -1, 'Sell'),
(4, 11215.45, 11109.65, 26652.33, 10461.42, 1490.20, 3235.66, 5985.34, 22884.22, 5033.76, 28.20, 25263.00, 10271.35, 1455.40, 52698.00, 41.34, 1, 1, 1, 1, 1, 1, 1, -1, -1, -1, 'Buy'),
(5, 11132.60, 11109.65, 27005.84, 10706.13, 1490.14, 3276.02, 6154.45, 22717.48, 5037.12, 28.54, 25057.94, 10362.88, 1505.00, 52490.00, 41.08, 1, 1, -1, -1, 1, 1, -1, -1, 1, -1, 'Buy'),
(6, 11162.25, 11109.65, 26840.40, 10680.36, 1487.51, 3257.30, 6076.45, 22696.42, 5104.28, 28.33, 25635.66, 10387.20, 1500.20, 52186.00, 41.73, -1, -1, 1, 1, -1, 1, 1, 1, -1, -1, 'Buy'),
(7, 11022.20, 11075.90, 26680.87, 10767.09, 1467.95, 3251.84, 6091.23, 22770.36, 5093.18, 28.12, 25057.99, 10271.35, 1440.85, 52186.00, 41.76, 1, 1, 1, 1, -1, -1, 1, 1, 1, -1, 'Sell'),
(8, 10901.70, 11047.80, 26671.95, 10503.19, 1473.32, 3224.73, 6017.28, 22945.50, 5069.42, 27.82, 25089.17, 10362.88, 1345.10, 52698.00, 40.65, 1, 1, 1, 1, 1, -1, -1, 1, 1, -1, 'Sell'),
(9, 10739.95, 11023.25, 26734.71, 10473.83, 1467.56, 3215.57, 6122.23, 22587.01, 5085.28, 27.59, 24970.69, 10387.20, 1309.60, 52490.00, 40.63, 1, 1, 1, 1, 1, -1, 1, -1, 1, -1, 'Buy'),
(10, 10618.20, 10997.35, 26870.10, 10550.49, 1478.27, 3226.56, 6120.26, 22784.74, 5108.98, 27.66, 25481.58, 10271.35, 1288.60, 52186.00, 40.57, 1, 1, 1, 1, 1, -1, 1, -1, 1, -1, 'Buy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `NiftyDataset`
--
ALTER TABLE `NiftyDataset`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `NiftyDataset`
--
ALTER TABLE `NiftyDataset`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
