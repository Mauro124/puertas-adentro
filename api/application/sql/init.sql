CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Logo` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `imagen` MEDIUMTEXT DEFAULT NULL,
  `link` VARCHAR(255) DEFAULT NULL,
  `destacado` bit(1) DEFAULT NULL,
  `oculto` bit(1) DEFAULT NULL,
  `prioridad` int(1) DEFAULT NULL,
  `nombre` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `Banner` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `imagen` MEDIUMTEXT DEFAULT NULL,
  `ancho` int(11) DEFAULT NULL,
  `alto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `Usuario` (`usuario`, `password`) VALUES ("admin", "admin");
INSERT INTO `Banner` (`imagen`, `ancho`, `alto`) VALUES ("banner_test", 0, 0);
