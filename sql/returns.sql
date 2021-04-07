--
-- Table structure for table `returns`
--
CREATE TABLE `returns` (
    `RID` int(11) NOT NULL,
    `PID` int(11) NOT NULL,
    `TID` int(11) NOT NULL,
    `timestamp` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `EID` int(11) NOT NULL,
    `reason` text NOT NULL
);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`RID`),
  ADD FOREIGN KEY (`TID`) REFERENCES transactions(`TID`),
  ADD FOREIGN KEY (`PID`) REFERENCES products(`PID`),
  ADD FOREIGN KEY (`EID`) REFERENCES employees(`EID`);

ALTER TABLE `returns`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;