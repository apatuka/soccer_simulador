/*
Navicat MySQL Data Transfer

Source Server         : DB
Source Server Version : 50532
Source Host           : 127.0.0.1:3306
Source Database       : fixt

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-01-13 23:43:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `confederacion`
-- ----------------------------
DROP TABLE IF EXISTS `confederacion`;
CREATE TABLE `confederacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `confederacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `siglas` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of confederacion
-- ----------------------------
INSERT INTO `confederacion` VALUES ('1', 'Confederación Sudamericana de Fútbol', 'CONMEBOL');
INSERT INTO `confederacion` VALUES ('2', 'UEFA', 'UEFA');

-- ----------------------------
-- Table structure for `equipos`
-- ----------------------------
DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `str` decimal(10,0) DEFAULT NULL,
  `torneo` int(11) DEFAULT NULL,
  `pais` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of equipos
-- ----------------------------
INSERT INTO `equipos` VALUES ('1', 'Olimpia', '40', '1', '1');
INSERT INTO `equipos` VALUES ('2', 'Cerro Porteño', '40', '1', '1');
INSERT INTO `equipos` VALUES ('3', 'Libertad', '30', '1', '1');
INSERT INTO `equipos` VALUES ('4', 'Nacional', '30', '1', '1');
INSERT INTO `equipos` VALUES ('5', 'Guarani', '30', '1', '1');
INSERT INTO `equipos` VALUES ('6', 'Sp. Luqueño', '22', '1', '1');
INSERT INTO `equipos` VALUES ('7', 'Rubio Ñu', '19', '1', '1');
INSERT INTO `equipos` VALUES ('8', 'Carapeguá', '15', '1', '1');
INSERT INTO `equipos` VALUES ('9', 'Cerro PF', '15', '1', '1');
INSERT INTO `equipos` VALUES ('10', 'Gral. Diaz', '25', '1', '1');
INSERT INTO `equipos` VALUES ('11', 'Dvo. Capiata', '25', '1', '1');
INSERT INTO `equipos` VALUES ('12', 'Sol de America', '22', '1', '1');
INSERT INTO `equipos` VALUES ('13', '3 de Febrero', '15', '2', '1');
INSERT INTO `equipos` VALUES ('14', '12 de Octubre', '15', '2', '1');
INSERT INTO `equipos` VALUES ('15', 'Sp. Trinidense', '15', '2', '1');
INSERT INTO `equipos` VALUES ('16', 'Tacuary', '14', '2', '1');
INSERT INTO `equipos` VALUES ('17', 'Sp. Colombia', '14', '2', '1');
INSERT INTO `equipos` VALUES ('18', 'Independiente GC', '13', '2', '1');
INSERT INTO `equipos` VALUES ('19', 'Paranaense', '13', '2', '1');
INSERT INTO `equipos` VALUES ('20', 'Gral. Caballero', '15', '2', '1');
INSERT INTO `equipos` VALUES ('21', 'Caacupé FBC', '12', '2', '1');
INSERT INTO `equipos` VALUES ('22', 'Fernando de la Mora', '9', '2', '1');
INSERT INTO `equipos` VALUES ('23', 'Resistencia', '12', '2', '1');
INSERT INTO `equipos` VALUES ('24', 'Dvo. Santaní', '12', '2', '1');
INSERT INTO `equipos` VALUES ('25', 'River Plate', '11', '2', '1');
INSERT INTO `equipos` VALUES ('26', 'San Lorenzo', '10', '2', '1');
INSERT INTO `equipos` VALUES ('27', 'Martín Ledesma', '9', '2', '1');
INSERT INTO `equipos` VALUES ('28', '2 de Mayo', '9', '2', '1');
INSERT INTO `equipos` VALUES ('29', 'Peñarol', '45', '3', '2');
INSERT INTO `equipos` VALUES ('30', 'Defensor Sporting', '40', '3', '2');
INSERT INTO `equipos` VALUES ('31', 'Nacional', '45', '3', '2');
INSERT INTO `equipos` VALUES ('32', 'River Plate', '30', '3', '2');
INSERT INTO `equipos` VALUES ('33', 'El Tanque Sisley', '25', '3', '2');
INSERT INTO `equipos` VALUES ('34', 'Wanderers', '25', '3', '2');
INSERT INTO `equipos` VALUES ('35', 'Fénix', '20', '3', '2');
INSERT INTO `equipos` VALUES ('36', 'Juventud', '20', '3', '2');
INSERT INTO `equipos` VALUES ('37', 'Racing', '15', '3', '2');
INSERT INTO `equipos` VALUES ('38', 'Cerro', '15', '3', '2');
INSERT INTO `equipos` VALUES ('39', 'Danubio', '15', '3', '2');
INSERT INTO `equipos` VALUES ('40', 'Liverpool', '12', '3', '2');
INSERT INTO `equipos` VALUES ('41', 'Bella Vista', '12', '3', '2');
INSERT INTO `equipos` VALUES ('42', 'Central Español', '10', '3', '2');
INSERT INTO `equipos` VALUES ('43', 'Progreso', '10', '3', '2');
INSERT INTO `equipos` VALUES ('44', 'Cerro Largo', '10', '3', '2');

-- ----------------------------
-- Table structure for `pais`
-- ----------------------------
DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `siglas` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `str` int(11) DEFAULT NULL,
  `confederacion` int(11) DEFAULT NULL,
  `bandera` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of pais
-- ----------------------------
INSERT INTO `pais` VALUES ('1', 'Paraguay', 'PAR', '0', '1', 'py');
INSERT INTO `pais` VALUES ('2', 'Uruguay', 'URU', '0', '1', 'uy');
INSERT INTO `pais` VALUES ('999', 'Sudamerica', 'SUD', '0', '1', 'su');

-- ----------------------------
-- Table structure for `partidos`
-- ----------------------------
DROP TABLE IF EXISTS `partidos`;
CREATE TABLE `partidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `torneo` int(11) DEFAULT NULL,
  `eqloc` int(11) DEFAULT NULL,
  `eqvis` int(11) DEFAULT NULL,
  `gloc` int(11) DEFAULT '0',
  `gvis` int(11) DEFAULT '0',
  `estado` set('pendiente','jugado') COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of partidos
-- ----------------------------

-- ----------------------------
-- Table structure for `tabla`
-- ----------------------------
DROP TABLE IF EXISTS `tabla`;
CREATE TABLE `tabla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `torneo` int(11) DEFAULT NULL,
  `equipo` int(11) DEFAULT NULL,
  `pg` int(11) DEFAULT '0',
  `pe` int(11) DEFAULT '0',
  `pp` int(11) DEFAULT '0',
  `pts` int(11) DEFAULT '0',
  `gf` int(11) DEFAULT '0',
  `gc` int(11) DEFAULT '0',
  `grupo` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of tabla
-- ----------------------------

-- ----------------------------
-- Table structure for `torneo`
-- ----------------------------
DROP TABLE IF EXISTS `torneo`;
CREATE TABLE `torneo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `año` int(4) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of torneo
-- ----------------------------

-- ----------------------------
-- Table structure for `torneo_clasificatorio_ascenso`
-- ----------------------------
DROP TABLE IF EXISTS `torneo_clasificatorio_ascenso`;
CREATE TABLE `torneo_clasificatorio_ascenso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  `destino_torneo` int(11) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `fase_destino` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of torneo_clasificatorio_ascenso
-- ----------------------------
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('1', 'Ascenso a Primera (Campeon)', '2', '1', '1', '1');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('2', 'Ascenso a Primera (Subcampeon)', '2', '1', '2', '1');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('3', 'Libertadores - Paraguay 1 (Campeon Acumulativo)', '1', '4', '1', '2');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('4', 'Libertadores - Paraguay 2 (Subcampeon Acumulativo)', '1', '4', '2', '2');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('5', 'Libertadores - Paraguay 3 (Tercer Acumulativo)', '1', '4', '3', '1');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('6', 'Sudamericana - Paraguay 1 (Cuarto Acumulativo)', '1', '0', '4', '1');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('7', 'Sudamericana - Paraguay 2 (Quinto Acumulativo)', '1', '0', '5', '1');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('8', 'Sudamericana - Paraguay 3 (Sexto Acumulativo)', '1', '0', '6', '1');
INSERT INTO `torneo_clasificatorio_ascenso` VALUES ('9', 'Sudamericana - Paraguay 4 (Septimo Acumulativo)', '1', '0', '7', '1');

-- ----------------------------
-- Table structure for `torneo_clasificatorio_descenso`
-- ----------------------------
DROP TABLE IF EXISTS `torneo_clasificatorio_descenso`;
CREATE TABLE `torneo_clasificatorio_descenso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  `destino_torneo` int(11) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `posicion_destino` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of torneo_clasificatorio_descenso
-- ----------------------------
INSERT INTO `torneo_clasificatorio_descenso` VALUES ('1', 'Descenso (Peor Acumulativo 1)', '1', '2', '11', '1');
INSERT INTO `torneo_clasificatorio_descenso` VALUES ('2', 'Descenso (Peor Acumulativo 2)', '1', '2', '12', '1');

-- ----------------------------
-- Table structure for `torneo_data`
-- ----------------------------
DROP TABLE IF EXISTS `torneo_data`;
CREATE TABLE `torneo_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pais` int(3) DEFAULT NULL,
  `division` int(11) DEFAULT NULL,
  `ascienden` int(11) DEFAULT NULL,
  `descienden` int(11) DEFAULT NULL,
  `cupo_libertadores` int(11) DEFAULT NULL,
  `cupo_sudamericana` int(11) DEFAULT NULL,
  `torneo_ascenso_id` int(11) DEFAULT NULL,
  `torneo_descenso_id` int(11) DEFAULT NULL,
  `esquema_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of torneo_data
-- ----------------------------
INSERT INTO `torneo_data` VALUES ('1', 'División de Honor', '1', '1', '0', '2', '3', '4', '0', '2', '1');
INSERT INTO `torneo_data` VALUES ('2', 'División Intermedia', '1', '2', '2', '3', '0', '0', '1', '0', '2');
INSERT INTO `torneo_data` VALUES ('3', 'Campeonato Uruguayo', '2', '1', '0', '3', '3', '4', '0', '0', '3');
INSERT INTO `torneo_data` VALUES ('4', 'Copa Libertadores', '999', '1', '0', '0', '0', '0', '0', '0', '4');

-- ----------------------------
-- Table structure for `torneo_esquemas`
-- ----------------------------
DROP TABLE IF EXISTS `torneo_esquemas`;
CREATE TABLE `torneo_esquemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `esquema` varchar(255) DEFAULT NULL,
  `equipos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of torneo_esquemas
-- ----------------------------
INSERT INTO `torneo_esquemas` VALUES ('1', 'PRIMERAPY', '12');
INSERT INTO `torneo_esquemas` VALUES ('2', 'SEGUNDAPY', '16');
INSERT INTO `torneo_esquemas` VALUES ('3', 'PRIMERAUY', '16');
INSERT INTO `torneo_esquemas` VALUES ('4', 'LIBERTADORES', '38');

-- ----------------------------
-- Table structure for `torneo_esquema_data`
-- ----------------------------
DROP TABLE IF EXISTS `torneo_esquema_data`;
CREATE TABLE `torneo_esquema_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_esquema` int(11) DEFAULT NULL,
  `fase` int(11) DEFAULT NULL,
  `equipos` int(11) DEFAULT NULL,
  `tipo` set('preliminar','grupo','knockout') DEFAULT NULL,
  `n_grupos` int(11) DEFAULT NULL,
  `n_llaves` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of torneo_esquema_data
-- ----------------------------
INSERT INTO `torneo_esquema_data` VALUES ('1', '1', '1', '12', 'grupo', '1', '0');
INSERT INTO `torneo_esquema_data` VALUES ('2', '2', '1', '16', 'grupo', '1', '0');
INSERT INTO `torneo_esquema_data` VALUES ('3', '3', '1', '16', 'grupo', '1', '0');
INSERT INTO `torneo_esquema_data` VALUES ('4', '4', '1', '12', 'preliminar', '0', '6');
INSERT INTO `torneo_esquema_data` VALUES ('5', '4', '2', '26', 'grupo', '8', '0');
INSERT INTO `torneo_esquema_data` VALUES ('6', '4', '3', '16', 'knockout', '0', '8');

-- ----------------------------
-- Table structure for `torneo_temporada`
-- ----------------------------
DROP TABLE IF EXISTS `torneo_temporada`;
CREATE TABLE `torneo_temporada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `torneo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `temporada` int(11) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of torneo_temporada
-- ----------------------------
INSERT INTO `torneo_temporada` VALUES ('1', 'Torneo Apertura', '1', '1');
INSERT INTO `torneo_temporada` VALUES ('2', 'Torneo Clausura', '2', '1');
INSERT INTO `torneo_temporada` VALUES ('3', 'Torneo Intermedia', '1', '2');
INSERT INTO `torneo_temporada` VALUES ('4', 'Campeonato Uruguayo', '1', '3');
INSERT INTO `torneo_temporada` VALUES ('5', 'Libertadores', '1', '4');
