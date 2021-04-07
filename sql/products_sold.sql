--
-- Table structure for table `products_sold`
--
CREATE TABLE `products_sold` (
    `PSID` int(11) NOT NULL,
    `TID` int(11) NOT NULL,
    `PID` int(11) NOT NULL,
    `COID` int(11) NOT NULL, 
    `is_returned` tinyint(1) NOT NULL DEFAULT 0
);

--
-- Indexes for table `products_sold`
--
ALTER TABLE `products_sold`
  ADD PRIMARY KEY (`PSID`),
  ADD FOREIGN KEY (`TID`) REFERENCES transactions(`TID`),
  ADD FOREIGN KEY (`PID`) REFERENCES products(`PID`),
  ADD FOREIGN KEY (`COID`) REFERENCES coupons(`COID`);

ALTER TABLE `products_sold`
  MODIFY `PSID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;