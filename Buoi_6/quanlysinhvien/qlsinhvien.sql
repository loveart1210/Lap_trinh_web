CREATE DATABASE IF NOT EXISTS `qlsinhvien` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `qlsinhvien`;

CREATE TABLE `sinhvien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoten` varchar(100) NOT NULL,
  `gioitinh` varchar(10) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sinhvien` (`hoten`, `gioitinh`, `ngaysinh`) VALUES
('Nguyễn Văn An', 'Nam', '2003-10-20'),
('Trần Thị Bích', 'Nữ', '2003-05-15'),
('Lê Hoàng Cường', 'Nam', '2003-08-01'),
('Phạm Thị Dung', 'Nữ', '2003-11-25');