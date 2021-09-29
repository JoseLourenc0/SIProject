SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tb_state` (
  `id` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `dh` datetime NOT NULL,
  `timeesp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tb_history` (
  `id` int(11) NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `nowf` datetime NOT NULL,
  `dtemperature` float NOT NULL,
  `dhumidity` float NOT NULL,
  `shumidity` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `user_name` varchar(300) NOT NULL,
  `user_email` varchar(300) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `user_permission` int(11) NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tb_state`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_history`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

ALTER TABLE `tb_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tb_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;