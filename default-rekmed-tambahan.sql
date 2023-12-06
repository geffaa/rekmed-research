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

DROP TABLE IF EXISTS `rm_gigi`;

CREATE TABLE `rm_gigi` (
  `rm_gigi_id` bigint NOT NULL AUTO_INCREMENT,
  `rm_id` bigint NOT NULL,
  `oklusi` text DEFAULT NULL,
  `torus_palatinus` text DEFAULT NULL,
  `torus_mandibularis` text DEFAULT NULL,
  `palatum` text DEFAULT NULL,
  `supernumerary_teeth` text DEFAULT NULL,
  `diastema` text DEFAULT NULL,
  `gigi_anomali` text DEFAULT NULL,
  `lain_lain` text DEFAULT NULL,
  PRIMARY KEY (`rm_gigi_id`),
  FOREIGN KEY (`rm_id`) REFERENCES `rekam_medis`(`rm_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ri_gigi`;

CREATE TABLE `ri_gigi` (
  `ri_gigi_id` bigint NOT NULL AUTO_INCREMENT,
  `rm_gigi_id` bigint NOT NULL,
  `tanggal` date NOT NULL,
  `gigi` text DEFAULT NULL,
  `keluhan_diagnosa` text DEFAULT NULL,
  `perawatan` text DEFAULT NULL,
  `user_id` int NOT NULL,
  `is_verified` boolean DEFAULT false,
  PRIMARY KEY (`ri_gigi_id`),
  FOREIGN KEY (`rm_gigi_id`) REFERENCES `rm_gigi`(`rm_gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `gigi`;

CREATE TABLE `gigi` (
  `gigi_id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `posisi` int NOT NULL,
  PRIMARY KEY (`gigi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `status_gigi`;

CREATE TABLE `status_gigi` (
  `status_gigi_id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` text DEFAULT NULL,
  PRIMARY KEY (`status_gigi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `odontogram`;

CREATE TABLE `odontogram` (
  `rm_gigi_id` bigint NOT NULL,
  `gigi_id` int NOT NULL,
  `status_gigi_id` int NOT NULL,
  PRIMARY KEY (`rm_gigi_id`, `gigi_id`),
  FOREIGN KEY (`rm_gigi_id`) REFERENCES `rm_gigi`(`rm_gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`gigi_id`) REFERENCES `gigi`(`gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`status_gigi_id`) REFERENCES `status_gigi`(`status_gigi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `dokter`
ADD COLUMN `ttd` text DEFAULT NULL;

INSERT INTO `menu` VALUES (26,0,'Rawat Inap','bed',6,'rawat-inap/index');
INSERT INTO `menu` VALUES (27,0,'Poli Gigi','smile-o',6,'rm-gigi/index');
INSERT INTO `menu_akses` VALUES (26, 20), (26, 25);
INSERT INTO `menu_akses` VALUES (27, 20), (27, 25);