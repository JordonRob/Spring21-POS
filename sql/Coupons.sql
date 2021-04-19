--
-- Table structure for table `coupons`
--
CREATE TABLE `coupons` (
    `COID` int(11) NOT NULL,
    `PID` int(11) NOT NULL,
    `VID` int(11) NOT NULL,
    `cname` text NOT NULL,
    `coupon_sku` varchar(20) NOT NULL,
    `amount_deducted` double NOT NULL,
    `date_created` DATETIME DEFAULT CURRENT_TIMESTAMP
);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`COID`),
  ADD FOREIGN KEY (`PID`) REFERENCES products_new(`PID`),
  ADD FOREIGN KEY (`VID`) REFERENCES vendors(`VID`);

ALTER TABLE `coupons`
  MODIFY `COID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
