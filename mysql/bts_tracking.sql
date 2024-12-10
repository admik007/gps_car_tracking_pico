CREATE TABLE `bts_tracking` (
  `id` int(8) NOT NULL,
  `lat` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lon` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `alt` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `time` varchar(26) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `device` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mcc` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mnc` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bsic` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cellid` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lac` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` char(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Indexes for table `bts_tracking`
ALTER TABLE `bts_tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

-- AUTO_INCREMENT for table `bts_tracking`
ALTER TABLE `bts_tracking`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
