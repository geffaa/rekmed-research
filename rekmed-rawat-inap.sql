--
-- Table structure for table `rawat_inap`
--

CREATE TABLE `rawat_inap` (
  `rawat_inap_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mr` varchar(25) NOT NULL,
  PRIMARY KEY (`rawat_inap_id`),
  CONSTRAINT `rawat_inap_pasien_fk` FOREIGN KEY (`mr`) REFERENCES `pasien` (`mr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `ri_record`
--

CREATE TABLE `ri_record` (
  `ri_record_id` bigint(20) NOT NULL,
  `rawat_inap_id` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `subjective` text DEFAULT NULL,
  `objective` text DEFAULT NULL,
  `assessment` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_removed` tinyint(1) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`ri_record_id`),
  CONSTRAINT `ri_record_rawat_inap_fk` FOREIGN KEY (`rawat_inap_id`) REFERENCES `rawat_inap` (`rawat_inap_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ri_record_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
