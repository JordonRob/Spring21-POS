--
-- Table structure for table `Purchases`
--
CREATE TABLE `Purchases` (
    `Purchase ID` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Staff ID` INT NOT NULL,
    `Price` DOUBLE(10,2) NOT NULL,
    `Payment Method` VARCHAR(255) NOT NULL,
    `Time of Sale` DATETIME DEFAULT CURRENT_TIMESTAMP
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Purchases`
--
INSERT INTO `Purchases` (`Purchase ID`, `Staff ID`, `Price`, `Payment Method`, `Time of Sale`) VALUES 
(1, 14, 124.92, 'Credit', CURRENT_TIMESTAMP),
(2, 14, 4.92, 'Credit', CURRENT_TIMESTAMP);
--
-- AUTO_INCREMENT for table `Purchases`
--
ALTER TABLE `Purchases`
  MODIFY `Purchase ID` INT NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1;
COMMIT;
