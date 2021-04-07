--
-- Table structure for table `transactions`
--
CREATE TABLE `transactions` (
  `TID` int(11) NOT NULL,
  `THID` int(11) NOT NULL,
  `EID` int(11) NOT NULL,
  `timestamp`  DATETIME DEFAULT CURRENT_TIMESTAMP,
  `TXID` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `total` double NOT NULL
);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TID`),
  ADD FOREIGN KEY (`THID`) REFERENCES header(`THID`),
  ADD FOREIGN KEY (`TXID`) REFERENCES taxes(`TXID`),
  ADD FOREIGN KEY (`EID`) REFERENCES employees(`EID`);


ALTER TABLE `transactions`
  MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;