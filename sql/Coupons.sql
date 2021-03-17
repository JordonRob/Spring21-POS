--
-- Table structure for table `Coupons`
--
CREATE TABLE `Coupons` (
  `Name` varchar(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Price` double(10,2) NOT NULL,
  `Date_Created` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Coupons`
--

INSERT INTO `Coupons` (`Name`, `Code`, `Price`, `Date_Created`) VALUES
('Apple', '234521', .50, CURRENT_TIMESTAMP);

--
-- Indexes for table `Coupons`
--
ALTER TABLE `Coupons`
  ADD PRIMARY KEY (`Code`),
  ADD UNIQUE KEY `Code` (`Code`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Coupons`
--
ALTER TABLE `Coupons`
  MODIFY `Code` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;