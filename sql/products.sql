--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `name` varchar(255) NOT NULL,
  `PIDC` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `PIDC`, `price`, `quantity`) VALUES
('Apple', '324454', 1.25, 10),
('Pretzel', '667424', 2.00, 10),
('Pear', '156583', 1.25, 10),
('Cherries', '9834616', 4.00, 10);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PIDC`),
  ADD UNIQUE KEY `PIDC` (`PIDC`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PIDC` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;