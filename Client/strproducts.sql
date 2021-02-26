--
-- Table structure for table `strproducts`
--

CREATE TABLE `strproducts` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `PIDC` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `strproducts` (`id`, `name`, `PIDC`, `price`) VALUES
(1, 'Apple', '324454', 1.25),
(2, 'Pretzel', '667424', 2.00),
(3, 'Pear', '156583', 1.25),
(4, 'Cherries', '9834616', 4.00);

--
-- Indexes for table `products`
--
ALTER TABLE `strproducts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `PIDC` (`PIDC`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `strproducts`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;