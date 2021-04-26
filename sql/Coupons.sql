--
-- Table structure for table `coupons`
--
CREATE TABLE `coupons` (
    `COID` int(11) NOT NULL,
    `cname` varchar(255) NOT NULL,
    `coupon_sku` varchar(20) NOT NULL,
    `amount_deducted` double(10,2) NOT NULL,
    `date_created` DATETIME DEFAULT CURRENT_TIMESTAMP
);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`COID`);

ALTER TABLE `coupons`
  MODIFY `COID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1;
COMMIT;
