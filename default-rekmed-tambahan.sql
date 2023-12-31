DROP TABLE IF EXISTS `pasien_next_visit`;

CREATE TABLE `pasien_next_visit` (
  `pasien_schedule_id` bigint(11) NOT NULL,
  `mr` varchar(25) DEFAULT NULL,
  `agenda` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `next_visit` date DEFAULT NULL,
  `seen` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  CONSTRAINT `pasien_next_visit_mr_fk` FOREIGN KEY (`mr`) REFERENCES `pasien` (`mr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE pasien
ADD COLUMN no_nik varchar(25) DEFAULT NULL,
ADD COLUMN email varchar(255) DEFAULT NULL,
ADD COLUMN alergi longtext NOT NULL;

ALTER TABLE kunjungan 
ADD COLUMN nomor_antrian int(11) DEFAULT NULL;

ALTER TABLE `dokter`
ADD COLUMN `ttd` text DEFAULT NULL;

INSERT INTO `menu` VALUES (26,0,'Rawat Inap','bed',6,'rawat-inap/index');
INSERT INTO `menu` VALUES (27,0,'Poli Gigi','smile-o',6,'rm-gigi/index');
INSERT INTO `menu_akses` VALUES (26, 20), (26, 25);
INSERT INTO `menu_akses` VALUES (27, 20), (27, 25);
