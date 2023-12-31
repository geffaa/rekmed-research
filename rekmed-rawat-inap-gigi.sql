--
-- Table structure for table `rm_gigi`
--

CREATE TABLE `rm_gigi` (
  `rm_gigi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rm_id` bigint(20) NOT NULL,
  `oklusi` text DEFAULT NULL,
  `torus_palatinus` text DEFAULT NULL,
  `torus_mandibularis` text DEFAULT NULL,
  `palatum` text DEFAULT NULL,
  `supernumerary_teeth` text DEFAULT NULL,
  `diastema` text DEFAULT NULL,
  `gigi_anomali` text DEFAULT NULL,
  `lain_lain` text DEFAULT NULL,
  PRIMARY KEY (`rm_gigi_id`),
  CONSTRAINT `rm_gigi_rm_fk` FOREIGN KEY (`rm_id`) REFERENCES `rekam_medis` (`rm_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `ri_gigi`
--

CREATE TABLE `ri_gigi` (
  `ri_gigi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rm_gigi_id` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `gigi` text DEFAULT NULL,
  `keluhan_diagnosa` text DEFAULT NULL,
  `perawatan` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`ri_gigi_id`),
  CONSTRAINT `ri_gigi_rm_gigi_fk` FOREIGN KEY (`rm_gigi_id`) REFERENCES `rm_gigi` (`rm_gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ri_gigi_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `status_gigi`
--

CREATE TABLE `status_gigi` (
  `status_gigi_id` int NOT NULL AUTO_INCREMENT,
  `path` text DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `z_index` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`status_gigi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_gigi`
--

INSERT INTO `status_gigi` (`status_gigi_id`, `path`, `nama`, `z_index`) VALUES
(1, 'svg/tooth1.svg', 'Normal/baik', 1),
(2, 'svg/tooth2.svg', 'Status Two', 1),
(3, 'svg/tooth3.svg', 'Fracture (cfr)', 3),
(4, 'svg/tooth4.svg', 'Perawatan Saluran Akar (rct)', 1),
(5, 'svg/tooth5.svg', 'Tambalan Composite (cof)', 2),
(6, 'svg/tooth6.svg', 'Tambalan Composite (cof)k', 2),
(7, 'svg/tooth7.svg', 'Pit dan fissure sealant = (fis)', 2),
(8, 'svg/tooth8.svg', 'Caries = Tambalan sementara (car)', 2),
(9, 'svg/tooth9.svg', 'Gigi non-vital (nvt)', 2),
(10, 'svg/tooth10.svg', 'Full metal crown pada gigi vital (fmc)', 2),
(11, 'svg/tooth11.svg', 'Full metal crown pada gigi non-vital (fmc-rct)', 2),
(12, 'svg/tooth12.svg', 'Porcelain crown pada gigi vital (poc)', 2),
(13, 'svg/tooth13.svg', 'Porcelain crown pada gigi non vital (poc-rct)', 2),
(14, 'svg/tooth14.svg', 'Implant + Porcelain crown (ipx - poc)', 2),
(15, 'svg/tooth15.svg', 'Sisa akar', 3);

--
-- Table structure for table `gigi`
--

CREATE TABLE `gigi` (
  `gigi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `default_status_gigi` int(11) NOT NULL,
  PRIMARY KEY (`gigi_id`),
  UNIQUE KEY `unique_nomor` (`nomor`),
  CONSTRAINT `gigi_status_gigi_fk` FOREIGN KEY (`default_status_gigi`) REFERENCES `status_gigi` (`status_gigi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gigi`
--

INSERT INTO `gigi` (`nomor`, `default_status_gigi`)
VALUES
  (11, 2), (12, 2), (13, 2), (14, 1), (15, 1), (16, 1), (17, 1), (18, 1),
  (21, 2), (22, 2), (23, 2), (24, 1), (25, 1), (26, 1), (27, 1), (28, 1),
  (31, 2), (32, 2), (33, 2), (34, 1), (35, 1), (36, 1), (37, 1), (38, 1),
  (41, 2), (42, 2), (43, 2), (44, 1), (45, 1), (46, 1), (47, 1), (48, 1),
  (51, 2), (52, 2), (53, 2), (54, 1), (55, 1),
  (61, 2), (62, 2), (63, 2), (64, 1), (65, 1),
  (71, 2), (72, 2), (73, 2), (74, 1), (75, 1),
  (81, 2), (82, 2), (83, 2), (84, 1), (85, 1);

--
-- Table structure for table `odontogram`
--

CREATE TABLE `odontogram` (
  `odontogram_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rm_gigi_id` bigint(20) NOT NULL,
  `gigi_id` int(11) NOT NULL,
  `status_gigi_id` int(11) NOT NULL,
  PRIMARY KEY (`odontogram_id`),
  UNIQUE KEY `unique_combination` (`rm_gigi_id`, `gigi_id`, `status_gigi_id`),
  CONSTRAINT `odontogram_rm_gigi_fk` FOREIGN KEY (`rm_gigi_id`) REFERENCES `rm_gigi` (`rm_gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `odontogram_gigi_fk` FOREIGN KEY (`gigi_id`) REFERENCES `gigi` (`gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `odontogram_status_gigi_fk` FOREIGN KEY (`status_gigi_id`) REFERENCES `status_gigi` (`status_gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
