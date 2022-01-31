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
-- Table structure for table `Datasets`
--

CREATE TABLE `Datasets` (
  `DatasetID` int(11) NOT NULL,
  `Name` varchar(1000) DEFAULT NULL,
  `TableName` varchar(1000) DEFAULT NULL,
  `RowsNum` int(11) DEFAULT NULL,
  `ColumnNum` int(11) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Attributes` varchar(1000) DEFAULT NULL,
  `Output` varchar(1000) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CreatedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Datasets`
--

INSERT INTO `Datasets` (`DatasetID`, `Name`, `TableName`, `RowsNum`, `ColumnNum`, `Description`, `Attributes`, `Output`, `UpdateDate`, `CreatedDate`) VALUES
(1, 'NSE Data Set', 'NSEStockData.php', 246, 8, 'Yahoo NSE Data', 'Date,Open,High,Low,Close,Adj Close,Volume', 'Buy,Sell', '2020-03-27 22:35:10', '2020-03-27 22:35:10'),
(2, 'NiftyDataset', 'NiftyDataset.php', 10, 27, 'Yahoo NiftyDataset', 'ID,Nifty_50,SGX_Nifty,DJIA_30,Nasdaq_100,Russel_2000,S&P_500,FTSE_100,Nikkei_225,CAC_40,DAX_30,Hang_Seng,SSE_180,MCXBULLDEX,GOLD_Future_India,Crude_Oil,Web_Info_Data,Indian_TV_News,Social_Media_Feed,Brokerages_House_News,FIIS_Data,DIIS_Data,Global_Trend,Nifty_50_Weekly_Expiry,Nifty_50_Monthly_Expiry,Pandemic_War_Situation,Output', 'Buy,Sell', '2020-03-27 22:35:10', '2020-03-27 22:35:10'),
(3, 'Internet Data Set', 'internetdataset.php', 15, 10437, 'Internet Data Set', 'ID,SourceID,Sourcename,Author,Title,Description,Url,UrlToImage,PublishedAt,Content,TopArticle,EngagementReactionCount,EngagementCommentCount,EngagementShareCount,EngagementCommentPluginCount', ' ', '2021-01-04 08:52:53', '2021-01-04 14:21:46'),
(4, 'Weather History', 'weatherhistory.php', 13, 96453, 'Weather History', 'ID,FormattedDate,Summary,PrecipType,Temperature,ApparentTemperature,Humidity,WindSpeed,WindBearing,Visibility,LoudCover,Pressure,DailySummary', 'Mostly cloudy throughout the day,Partly cloudy throughout the day,Partly cloudy until night,Partly cloudy starting in the morning,Foggy in the morning,Foggy starting overnight continuing until morning,Partly cloudy until evening,Mostly cloudy until night,Overcast throughout the day,Partly cloudy starting in the morning continuing until evening,Foggy until morning,Partly cloudy starting in the morning continuing until night,Mostly cloudy starting in the morning,Foggy starting in the evening,Partly cloudy starting overnight,Partly cloudy starting in the afternoon,Partly cloudy starting in the afternoon continuing until evening,Foggy overnight,Mostly cloudy starting overnight,Mostly cloudy until evening,Clear throughout the day,Partly cloudy starting overnight continuing until night,Foggy throughout the day,Partly cloudy overnight,Partly cloudy starting overnight continuing until evening,Foggy until night,Partly cloudy in the morning,Foggy starting overnight continuing until afternoon,Mos', '2021-01-04 10:44:36', '2021-01-04 16:05:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Datasets`
--
ALTER TABLE `Datasets`
  ADD PRIMARY KEY (`DatasetID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Datasets`
--
ALTER TABLE `Datasets`
  MODIFY `DatasetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
