--
-- Table structure for table `header`
--

CREATE TABLE `header` ( 
    `THID` INT(100) NOT NULL , 
    `address` VARCHAR(255) NOT NULL , 
    `manager` VARCHAR(100) NOT NULL , 
    `phone` VARCHAR(100) NOT NULL , 
    `tagline` TEXT NOT NULL , 
    `image` VARBINARY(100) NOT NULL 
);

--
-- Indexes for table `header`
--

ALTER TABLE `header`
  ADD PRIMARY KEY (`THID`);

ALTER TABLE `header`
  MODIFY `THID` INT(100) NOT NULL AUTO_INCREMENT;
COMMIT;