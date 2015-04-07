<?
############################################################################
#    Copyright (C) 2004 by iBlue                                           #
#    iblue@gmx.net                                                         #
#                                                                          #
#    This program is free software; you can redistribute it and#or modify  #
#    it under the terms of the GNU General Public License as published by  #
#    the Free Software Foundation; either version 2 of the License, or     #
#    (at your option) any later version.                                   #
#                                                                          #
#    This program is distributed in the hope that it will be useful,       #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of        #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         #
#    GNU General Public License for more details.                          #
#                                                                          #
#    You should have received a copy of the GNU General Public License     #
#    along with this program; if not, write to the                         #
#    Free Software Foundation, Inc.,                                       #
#    59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             #
############################################################################
?>
<?
/*

CREATE TABLE `users` 
(
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
 `user` VARCHAR( 255 ) NOT NULL ,
 `pass` VARCHAR( 255 ) NOT NULL ,
 INDEX ( `id` ) ,
 UNIQUE ( `user` )
);



CREATE TABLE `user_info` 
(
 `userid` BIGINT UNSIGNED NOT NULL ,
 `email` VARCHAR( 255 ) NOT NULL ,
 `planetid` BIGINT UNSIGNED NOT NULL ,
 `active` TINYINT UNSIGNED NOT NULL ,
 INDEX ( `userid` ) ,
 UNIQUE ( `email` )
);


CREATE TABLE `planets` 
(
 `gal` MEDIUMINT UNSIGNED NOT NULL ,
 `sys` MEDIUMINT UNSIGNED NOT NULL ,
 `plan` TINYINT UNSIGNED NOT NULL ,
 `userid` BIGINT UNSIGNED NOT NULL ,
 `pname` VARCHAR( 255 ) NOT NULL ,
 INDEX ( `gal` , `sys` , `plan` , `userid` ) 
);



CREATE TABLE `planets_res` (
 `gal` TINYINT UNSIGNED NOT NULL ,
 `sys` MEDIUMINT UNSIGNED NOT NULL ,
 `plan` TINYINT UNSIGNED NOT NULL ,
 `fe`  DOUBLE UNSIGNED NOT NULL ,
 `lut` DOUBLE UNSIGNED NOT NULL ,
 `h2`  DOUBLE UNSIGNED NOT NULL ,
 `h2o` DOUBLE UNSIGNED NOT NULL ,
 `lastupdate` BIGINT UNSIGNED NOT NULL,
 INDEX ( `gal` , `sys` , `plan` ) 
);



CREATE TABLE `buildings` (
 `id` BIGINT NOT NULL ,
 `res1` FLOAT NOT NULL ,
 `res2` FLOAT NOT NULL ,
 `res3` FLOAT NOT NULL ,
 `res4` FLOAT NOT NULL ,
 `pro1` FLOAT NOT NULL ,
 `pro2` FLOAT NOT NULL ,
 `pro3` FLOAT NOT NULL ,
 `pro4` FLOAT NOT NULL ,
 `name` VARCHAR( 127 ) NOT NULL ,
 `desc` TEXT NOT NULL ,
 `time` BIGINT NOT NULL ,
 `need_id` BIGINT NOT NULL ,
 INDEX ( `id` ) 
);

CREATE TABLE `planet_buildings` (
 `gal` TINYINT UNSIGNED NOT NULL ,
 `sys` MEDIUMINT UNSIGNED NOT NULL ,
 `plan` TINYINT UNSIGNED NOT NULL ,
 `buildid` BIGINT UNSIGNED NOT NULL ,
 `level` BIGINT UNSIGNED NOT NULL 
);


CREATE TABLE `planets_info` (
 `gal` TINYINT UNSIGNED NOT NULL ,
 `sys` MEDIUMINT UNSIGNED NOT NULL ,
 `plan` TINYINT UNSIGNED NOT NULL ,
 `diameter` INT UNSIGNED NOT NULL ,
 `temp_lo` SMALLINT NOT NULL ,
 `temp_hi` SMALLINT NOT NULL ,
 `points` BIGINT UNSIGNED NOT NULL 
);

CREATE TABLE `needs` (
 `id` BIGINT UNSIGNED NOT NULL ,
 `building` BIGINT UNSIGNED NOT NULL ,
 `level` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `id` , `building` , `level` ) 
);


CREATE TABLE `tasks` (
  `taskid` bigint(20) NOT NULL auto_increment,
  `userid` bigint(20) unsigned NOT NULL default '0',
  `gal` tinyint(3) unsigned NOT NULL default '0',
  `sys` mediumint(8) unsigned NOT NULL default '0',
  `plan` tinyint(3) unsigned NOT NULL default '0',
  `typ` bigint(20) unsigned NOT NULL default '0',
  `objectid` bigint(20) unsigned NOT NULL default '0',
  `objectlevel` bigint(20) unsigned NOT NULL default '0',
  `endtime` bigint(20) unsigned NOT NULL default '0',
  `order` bigint(20) unsigned NOT NULL default '0',
  KEY `taskid` (`taskid`,`userid`,`gal`,`sys`,`plan`)
)


INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '1', '500', '200', '0', '0', '0', '0', '0', '0', 'Kommandozentrale', 'Koordiniert den Bau von Gebäuden. Ein Ausbau erhöht die Baugeschwindigkeit.', '20000', '-1'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '2', '300', '100', '0', '0', '0', '0', '0', '0', 'Forschungszentrum', 'Ermöglicht das Erforschen neuer Technologien.', '22000', '-1'
);

INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '3', '250', '20', '0', '0', '4', '0', '0', '0', 'Eisenmine', 'Abbau von Eisen', '4600', '-1'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '4', '130', '20', '0', '0', '0', '2.5', '0', '0', 'Luthriumraffinerie', 'Fördert Luthrium', '4600', '-1'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '5', '100', '20', '0', '0', '0', '0', '5', '0', 'Bohrturm', 'Fördert Wasser', '4000', '-1'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '6', '350', '20', '0', '0', '0', '0', '-5', '1', 'Chemiefabrik', 'Wandelt Wasser in Wasserstoff um (Verhältnis 5:1)', '14000 ', '1'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '7', '20000', '15000', '0', '1000', '0', '0', '-25', '12.5', 'Erweiterte Chemiefabrik', 'Wandelt Wasser in Wasserstoff um (Verhältnis 2:1)', '70000', '2'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '8', '2000', '2000', '0', '0', '0', '0', '0', '0', 'Eisenspeicher', 'Zum lagern von Eisen', '144000', '3'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '9', '2000', '2000', '0', '0', '0', '0', '0', '0', 'Luthriumspeicher', 'Zum lagern von Luthrium', '144000', '4'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '10', '2000', '0', '0', '0', '0', '0', '0', '0', 'Wassertanks', 'Zum lagern von Wasser', '144000', '5'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '11', '2000', '2000', '0', '0', '0', '0', '0', '0', 'Wasserstoffspeicher', 'Zum lagern von Wasserstoff', '144000', '6'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '12', '2000', '4000', '0', '20', '0', '0', '0', '0', 'Schiffsfabrik', '', '74000', '-1'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '13', '400', '400', '0', '20', '0', '0', '0', '0', 'Orbitale Verteidigungsstation', 'Die Verteidigungsanlage ihres Planeten. Kann mit Verteidigungstürmen bestückt werden', '9000', '-1'
);
INSERT INTO `buildings` ( `id` , `res1` , `res2` , `res3` , `res4` , `pro1` , `pro2` , `pro3` , `pro4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '14', '10000', '0', '2000', '10000', '0', '0', '0', '0', 'Planetarer Schild', 'Erhöht den Verteidigungswert Ihrer Verteidigungstürme', '22000', '7'
);


INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '1', '5', '1'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '2', '5', '10'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '2', '1', '6'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '3', '3', '5'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '4', '4', '5'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '5', '5', '5'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '6', '6', '5'
);

INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '7', '12', '1'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '7', '13', '1'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '7', '15', '1'
);
INSERT INTO `needs` ( `id` , `building` , `level` ) 
VALUES (
 '8', '6', '5'
);

CREATE TABLE `science` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
 `res1` FLOAT NOT NULL ,
 `res2` FLOAT NOT NULL ,
 `res3` FLOAT NOT NULL ,
 `res4` FLOAT NOT NULL ,
 `name` VARCHAR( 127 ) NOT NULL ,
 `desc` TEXT NOT NULL ,
 `time` BIGINT UNSIGNED NOT NULL ,
 `need_id` BIGINT NOT NULL ,
 INDEX ( `id` ) 
);
CREATE TABLE `user_sci` (
 `userid` BIGINT UNSIGNED NOT NULL ,
 `sciid` BIGINT UNSIGNED NOT NULL ,
 `level` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `userid` , `sciid` , `level` ) 
);
CREATE TABLE `sci_needs` (
 `id` BIGINT UNSIGNED NOT NULL ,
 `sciid` BIGINT UNSIGNED NOT NULL ,
 `level` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `id` , `sciid` , `level` ) 
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '1', '1000', '0', '0', '0', 'Verbrennungsantrieb', 'Antriebstechnik für kleine Raumschiffe', '5000', '-1'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '2', '4000', '4000', '0', '2000', 'Ionenantrieb', 'Sehr schnelle Antriebstechnik', '20000', '1'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '3', '0', '0', '0', '30000', 'Raumkrümmungsantrieb', 'Sparsamer und schneller Antrieb, für große Raumschiffe', '5000', '2'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '4', '9500', '5750', '0', '450', 'Ionisation', 'Ionenwaffen erforschen', '52000', '-1'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '5', '17000', '13250', '0', '1240', 'Energiebündelung', 'Erhöht die Effizienz von Ionenwaffen', '52000', '3'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '6', '4000', '0', '0', '0', 'Explosivgeschosse', 'Explosionsgeschosse richten enormen Schaden an', '5000', '4'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '7', '400', '100', '0', '0', 'Spionagetechnik', 'Verbessert die Funktion von Spionagesonden', '52000', '-1'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '8', '4000', '4000', '4000', '4000', 'Erweiterte Schiffspanzerung', 'Erhöht die Panzerung aller Raumschiffe', '150000', '-1'
);
INSERT INTO `science` ( `id` , `res1` , `res2` , `res3` , `res4` , `name` , `desc` , `time` , `need_id` ) 
VALUES (
 '9', '0', '10000', '0', '2000', 'Erhöhte Ladekapazität', 'Erhöht die Ladekapazität aller Raumschiffe', '5000', '-1'
);
INSERT INTO `sci_needs` ( `id` , `sciid` , `level` ) 
VALUES (
 '1', '1', '2'
);
INSERT INTO `sci_needs` ( `id` , `sciid` , `level` ) 
VALUES (
 '2', '1', '5'
);
INSERT INTO `sci_needs` ( `id` , `sciid` , `level` ) 
VALUES (
 '2', '2', '5'
);
INSERT INTO `sci_needs` ( `id` , `sciid` , `level` ) 
VALUES (
 '3', '4', '1'
);
INSERT INTO `sci_needs` ( `id` , `sciid` , `level` ) 
VALUES (
 '4', '4', '2'
);
INSERT INTO `sci_needs` ( `id` , `sciid` , `level` ) 
VALUES (
 '4', '5', '1'
);

CREATE TABLE `msgs` (
  `msgid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `fromuid` BIGINT UNSIGNED NOT NULL ,
 `touid` BIGINT UNSIGNED NOT NULL ,
 `fromgal` TINYINT UNSIGNED NOT NULL ,
 `fromsys` MEDIUMINT UNSIGNED NOT NULL ,
 `fromplan` TINYINT UNSIGNED NOT NULL ,
 `togal` TINYINT UNSIGNED NOT NULL ,
 `tosys` MEDIUMINT UNSIGNED NOT NULL ,
 `toplan` TINYINT UNSIGNED NOT NULL ,
 `red` TINYINT NOT NULL ,
 `type` TINYINT NOT NULL ,
 `date` BIGINT UNSIGNED NOT NULL ,
 `subject` VARCHAR( 127 ) NOT NULL ,
 `text` MEDIUMTEXT NOT NULL,
 INDEX ( `fromuid` , `touid` , `fromgal` , `fromsys` , `fromplan` , `togal` , `tosys` , `toplan` , `red` , `type` ) 
);
CREATE TABLE `ships` (
 `id` BIGINT UNSIGNED NOT NULL ,
 `res1` BIGINT NOT NULL ,
 `res2` BIGINT NOT NULL ,
 `res3` BIGINT NOT NULL ,
 `res4` BIGINT NOT NULL ,
 `ag` FLOAT UNSIGNED NOT NULL ,
 `vt` FLOAT UNSIGNED NOT NULL ,
 `name` VARCHAR( 127 ) NOT NULL ,
 `desc` TEXT NOT NULL ,
 `speed` FLOAT UNSIGNED NOT NULL ,
 `consum` FLOAT UNSIGNED NOT NULL ,
 `load` BIGINT UNSIGNED NOT NULL ,
 `time` BIGINT NOT NULL ,
 `sci_need` BIGINT NOT NULL ,
 INDEX ( `id` , `sci_need` ) 
);
CREATE TABLE `ship_build` (
 `buildid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
 `gal` TINYINT UNSIGNED NOT NULL ,
 `sys` MEDIUMINT UNSIGNED NOT NULL ,
 `plan` TINYINT UNSIGNED NOT NULL ,
 `count` BIGINT UNSIGNED NOT NULL ,
 `order` BIGINT UNSIGNED NOT NULL ,
 `resttime` BIGINT UNSIGNED NOT NULL ,
 `lastact` BIGINT UNSIGNED NOT NULL ,
 `shiptype` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `buildid` 0) 
);
CREATE TABLE `planet_orbit` (
 `gal` TINYINT UNSIGNED NOT NULL ,
 `sys` MEDIUMINT UNSIGNED NOT NULL ,
 `plan` TINYINT UNSIGNED NOT NULL ,
 `fleetid` BIGINT UNSIGNED NOT NULL ,
 `fe` BIGINT UNSIGNED DEFAULT '0' NOT NULL ,
 `lut` BIGINT UNSIGNED DEFAULT '0' NOT NULL ,
 `h2o` BIGINT UNSIGNED DEFAULT '0' NOT NULL ,
 `h2` BIGINT UNSIGNED DEFAULT '0' NOT NULL ,
 INDEX ( `gal` , `sys` , `plan` , `fleetid` ) 
);
CREATE TABLE `fleets` (
 `fleetid` BIGINT UNSIGNED NOT NULL ,
 `shiptype` BIGINT UNSIGNED NOT NULL ,
 `count` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `fleetid` , `shiptype` , `count` ) 
);

CREATE TABLE `transfer` (
  `fleetid` bigint(20) unsigned NOT NULL auto_increment,
  `fromgal` mediumint(8) unsigned NOT NULL default '0',
  `fromsys` mediumint(8) unsigned NOT NULL default '0',
  `fromplan` mediumint(8) unsigned NOT NULL default '0',
  `togal` mediumint(8) unsigned NOT NULL default '0',
  `tosys` mediumint(8) unsigned NOT NULL default '0',
  `toplan` mediumint(8) unsigned NOT NULL default '0',
  `option` bigint(20) unsigned NOT NULL default '0',
  `tstart` bigint(20) unsigned NOT NULL default '0',
  `tthere` bigint(20) unsigned NOT NULL default '0',
  `tback` bigint(20) unsigned NOT NULL default '0',
  `loadres4` bigint(20) unsigned NOT NULL default '0',
  `loadres3` bigint(20) unsigned NOT NULL default '0',
  `loadres2` bigint(20) unsigned NOT NULL default '0',
  `loadres1` bigint(20) unsigned NOT NULL default '0',
  KEY `fleetid` (`fleetid`,`fromgal`,`fromsys`,`fromplan`,`togal`,`tosys`,`toplan`,`option`)
);

CREATE TABLE `reports` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `time` bigint(20) unsigned NOT NULL default '0',
  `tcoords` varchar(127) NOT NULL default '',
  `fcoords` varchar(127) NOT NULL default '',
  `ships_a` text NOT NULL,
  `ships_v` text NOT NULL,
  `towers_v` text NOT NULL,
  `spy` tinyint(1) unsigned NOT NULL default '0',
  `buildings` text NOT NULL,
  `sci` text NOT NULL,
  `to_info` text NOT NULL,
  `res_raided` text NOT NULL,
  `res_recycled` text NOT NULL,
  `res_spy` text NOT NULL,
  `fleetid` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

INSERT INTO `sci_needs` VALUES (101, 1, 1);
INSERT INTO `sci_needs` VALUES (102, 1, 2);
INSERT INTO `sci_needs` VALUES (104, 1, 2);
INSERT INTO `sci_needs` VALUES (105, 2, 1);
INSERT INTO `sci_needs` VALUES (106, 2, 2);
INSERT INTO `sci_needs` VALUES (106, 7, 5);
INSERT INTO `sci_needs` VALUES (107, 2, 4);
INSERT INTO `sci_needs` VALUES (108, 2, 10);
INSERT INTO `sci_needs` VALUES (108, 7, 10);
INSERT INTO `sci_needs` VALUES (109, 3, 1);
INSERT INTO `sci_needs` VALUES (110, 3, 1);
INSERT INTO `sci_needs` VALUES (110, 8, 1);
INSERT INTO `sci_needs` VALUES (111, 3, 4);
INSERT INTO `sci_needs` VALUES (112, 1, 1);
INSERT INTO `sci_needs` VALUES (113, 3, 5);

INSERT INTO `ships` VALUES (101, 250, 0, 0, 75, '50', '100', 'Kojote', 'Schwaches Schiff aber billiges, ausgestattet mit einem 1277nm-Infrarot-Laser.', '800', '10', 250, 2400, 101);
INSERT INTO `ships` VALUES (102, 850, 850, 100, 0, '300', '100', 'Sammler', 'Sammelt die um den Planeten kreisenden Truemmer zerstoerter Schiffe auf.', '1000', '30', 10000, 12400, 102);
INSERT INTO `ships` VALUES (103, 0, 150, 0, 0, '1', '1', 'Sonde', 'Schnelle Erkundungssonde um sich Informationen ueber einen Planeten zu beschaffen.', '9e+06', '1', 15, 100, -1);
INSERT INTO `ships` VALUES (104, 1000, 0, 0, 0, '200', '200', 'Revenger', 'Ein dem Kojoten sehr aehnliches Schiff, mit 2 statt einem Laser und verbesserter Panzerung.', '1300', '25', 200, 6000, 104);
INSERT INTO `ships` VALUES (105, 500, 500, 0, 0, '150', '300', 'Predator', 'Bestueckt mit 6 starken Infrarot-Lasern und einer Luthriumhydrid-Panzerung.', '2000', '40', 900, 10000, 105);
INSERT INTO `ships` VALUES (106, 0, 2000, 0, 0, '1300', '150', 'Stealthbomber', 'Der Stealthbomber bleibt bis kurz vor dem Kampf unentdeckt.', '1000', '100', 4000, 72000, 106);
INSERT INTO `ships` VALUES (107, 10000, 15000, 1000, 10000, '1', '1000', 'Kolonisationseinheit', 'Errichtet eine Kommandozentrale auf anderen Planeten.', '15000', '800', 1000000, 1440000, 107);
INSERT INTO `ships` VALUES (108, 200000, 150000, 20000, 55000, '10', '1000', 'Invasionseinheit', 'Nimmt fremde bewohnte Planeten in Besitz.', '500', '1000', 1000000, 2830000, 108);
INSERT INTO `ships` VALUES (109, 2000, 2000, 0, 0, '2000', '800', 'Tiger', 'Sehr schnelles Schiff. Ausgestattet mit 12 Wasserstoff-Plasmwerfern.', '3500', '60', 2000, 52000, 109);
INSERT INTO `ships` VALUES (110, 4000, 5000, 0, 0, '2250', '6500', 'Puma', 'Gepanzertes Raumschiff mit 2 Neutronenbschleuniger die Metalle verdampfen lassen.', '2100', '90', 24000, 52000, 110);
INSERT INTO `ships` VALUES (111, 50000, 5000, 0, 0, '15000', '35000', 'Shortbird IV', 'Gepanzertes Raumschiff mit monströser Bewaffnung.', '2700', '200', 34000, 480000, 111);
INSERT INTO `ships` VALUES (112, 2000, 2000, 0, 0, '1', '500', 'Kleiner Transporter', 'unbewaffnetes Transportschiff.', '1900', '10', 9000, 25000, 112);
INSERT INTO `ships` VALUES (113, 8000, 2000, 0, 5000, '15', '12000', 'Grosser Transporter', 'Transportschiff mit 12facher Luthriumhydrid-Panzerung', '4500', '30', 50000, 45000, 113);


CREATE TABLE `ally_members` (
 `userid` BIGINT UNSIGNED NOT NULL ,
 `allyid` BIGINT UNSIGNED NOT NULL ,
 `rank` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `userid` , `allyid` , `rank` ) 
);

CREATE TABLE `allys` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
 `name` VARCHAR( 128 ) NOT NULL ,
 `tag` VARCHAR( 32 ) NOT NULL ,
 `desc` TEXT NOT NULL ,
 `url` VARCHAR( 255 ) NOT NULL ,
 `score` FLOAT UNSIGNED DEFAULT '0' NOT NULL ,
 `memberc` BIGINT UNSIGNED DEFAULT '1' NOT NULL ,
 PRIMARY KEY ( `id` ) 
);

CREATE TABLE `ally_app` (
 `allyid` BIGINT UNSIGNED NOT NULL ,
 `userid` BIGINT UNSIGNED NOT NULL ,
 `txt` TEXT NOT NULL ,
 INDEX ( `allyid` , `userid` ) 
);

CREATE TABLE `towers` (
 `id` BIGINT UNSIGNED NOT NULL ,
 `res1` BIGINT NOT NULL ,
 `res2` BIGINT NOT NULL ,
 `res3` BIGINT NOT NULL ,
 `res4` BIGINT NOT NULL ,
 `ag` FLOAT UNSIGNED NOT NULL ,
 `vt` FLOAT UNSIGNED NOT NULL ,
 `name` VARCHAR( 127 ) NOT NULL ,
 `desc` TEXT NOT NULL ,
 `time` BIGINT NOT NULL ,
 `sci_need` BIGINT NOT NULL ,
 INDEX ( `id` , `sci_need` ) 
);

CREATE TABLE `fleets_tr` (
 `fleetid` BIGINT UNSIGNED NOT NULL ,
 `shiptype` BIGINT UNSIGNED NOT NULL ,
 `count` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `fleetid` , `shiptype` , `count` ) 
);

CREATE TABLE `towers_build` (
 `buildid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
 `gal` TINYINT UNSIGNED NOT NULL ,
 `sys` MEDIUMINT UNSIGNED NOT NULL ,
 `plan` TINYINT UNSIGNED NOT NULL ,
 `count` BIGINT UNSIGNED NOT NULL ,
 `order` BIGINT UNSIGNED NOT NULL ,
 `resttime` BIGINT UNSIGNED NOT NULL ,
 `lastact` BIGINT UNSIGNED NOT NULL ,
 `shiptype` BIGINT UNSIGNED NOT NULL ,
 INDEX ( `buildid` ) 
);
*/
?>
<?
require("config.inc.php5");
//----------------CONFIG---------------------------
if($CONFIG['server'] == "iblue")
{
  $CONFIG['time']['speedfactor'] = 60;
}
else
{
  $CONFIG['time']['speedfactor'] = 1;
}
//---------------END-CONFIG------------------------
class cl_database //im moment mysql, spaeter evtl postgreesql, MS-Sql *pfui*, sonstiges
{
  /* protected */ var $debug = false;
  /* protected */ var $var_sql;
  /* protected */ var $var_result;
  /* protected */ var $var_error;
  /* protected */ var $var_errno;
  /* protected */ var $var_link;
  /* protected */ var $db_connected=false;
  /* protected */ var $db_selected=false;
  function __construct($host,$user,$password)
  {
    if($this->debug)
    {
      echo "cl_database::__construct('$host','$user','$password');<br>";
    }
    $this->connect($host,$user,$password);
  }

  function connect($host,$user,$password)
  {
    if($this->debug)
    {
      echo "cl_database::connect('$host','$user','$password');<br>";
    }
    $this->var_link = mysql_connect($host,$user,$password);
    $this->db_connected=true;
  }

  function __destruct()
  {
    if($this->debug)
    {
      echo "cl_database::__destruct();<br>";
    }
    @mysql_free_result($this->var_result);
    @mysql_close($this->var_link);
  }
  
  function select_db($db)
  {
    if($this->debug)
    {
      echo "cl_database::select_db();<br>";
    }
    $db_sel = mysql_select_db($db,$this->var_link);
    if(!$db_sel)
    {
      $this->var_sql   = "SELECT DB '$db';";
      $this->var_error = mysql_error($this->var_link);
      $this->var_errno = mysql_errno($this->var_link);
      $this->var_result = false; //this->error() == true;
    }
    else
    {
      $this->var_sql   = "SELECT DB '$db';";
      $this->var_result = true; //this->error() == false;
    }
    $this->db_selected=!$this->var_result;
  }
  function query($sql)
  {
    if($this->debug)
    {
      echo "cl_database::query('$sql');<br>";
    }
    //echo "Query: <b>$sql</b><br>";
    //echo "cl_database::query('$sql');<br>";
    $this->var_sql = trim($sql);
    $this->var_result = mysql_query($this->var_sql,$this->var_link);
    if(!$this->var_result)
    {
      $this->var_errno = mysql_errno($this->var_link);
      $this->var_error = mysql_error($this->var_link);
    }    
  }
  function error()
  {
    if($this->debug)
    {
      echo "cl_database::error();<br>";
    }
    $tmp = $this->var_result;
    $tmp = (bool)$tmp;
    $tmp = !$tmp;
    return $tmp;
  }
  function geterror()
  {
    if($this->debug)
    {
      echo "cl_database::geterror();<br>";
    }
    if($this->error()) 
    {
      $str  = "<br>\n"; 
      $str .= "Query: <b>".$this->var_sql."</b><br>\n";
      $str .= "Error: <b>".$this->var_error."</b><br>\n";
      $str .= "Error Number: <b>".$this->var_errno."</b><br>\n";
    }
    else 
    {
      $str = "Error: No Error!<br>\n(c) by Microsoft :P";
    }
    return $str;
  }
  function numrows()
  {
    if($this->debug)
    {
      echo "cl_database::numrows();<br>";
    }
    if($this->error()) 
    {
      $return = -1;
    }
    else 
    {
      $return = mysql_num_rows($this->var_result);
    }
    return $return;
  }
  function fetch()
  {
    if($this->debug)
    {
      echo "cl_database::fetch();<br>";
    }
    if($this->error()) 
    {
      echo "<br>\nEs trat ein Fehler auf. Bitte überprüfen sie ihr";
      echo "MySQL-Query.\n<br>";
      $return = null;
    }
    else 
    {
      $return = mysql_fetch_array($this->var_result);
    }
    return $return;
  }
  function err()
  {
    if($this->debug)
    {
      echo "cl_database::err();<br>";
    }
    if($this->error())
    {
      echo $this->geterror();
    }
  }
}

class cl_extended_database extends cl_database
{
  
  /* protected */ var $started=false;
  function __construct()
  {
    global $CONFIG;
    $this->connect($CONFIG["mysql"]["host"],$CONFIG["mysql"]["user"],$CONFIG["mysql"]["pass"]);
    $this->select_db($CONFIG["mysql"]["db"]);
  }
  function reinit()
  {
    $this->__destruct();
    $this->__construct();
  }
  function start()
  {
    global $CONFIG;
    if(!$this->started)
    {
      if($this->db_connected==false)
      {
        $this->connect($CONFIG["mysql"]["host"],$CONFIG["mysql"]["user"],$CONFIG["mysql"]["pass"]);
        $this->db_connected=true;
      }
      if($this->db_selected==false)
      {
        $this->select_db($CONFIG["mysql"]["db"]);
        $this->db_selected==$this->error();
      }
      $this->started=true;
    }
    
  }
  /*protected*/ function user_insert($name,$password)
  {
    $this->query("INSERT INTO users (user,pass) VALUES ('$name','$password');"); $this->err();
    //echo "added user name: $name, password: $password<br>\n";  //DEBUG
    return $this->error();
  }
  /*protected*/ function user_info_insert($id,$email,$active)
  {
    $this->query("INSERT INTO user_info (userid,email,active) VALUES ('$id','$email','$active');"); $this->err();
    //echo "added user_info id: $id, email: $email, active: $active<br>\n";  //DEBUG
    return $this->error();
  }
  function user_info_emailexisting($mail)
  {
    $this->query("SELECT userid FROM user_info WHERE email='$mail';"); $this->err();
    if($this->numrows() <= 0)
      return false;
    return true;
  }
  function user_add($name,$email,$pname)
  {
    global $CONFIG;
    $this->user_insert($name,substr(md5($name."y48fnK0"),2,5));
    $id = $this->user_get_id($name);
    $this->user_info_insert($id,$email,1);
    $planet = $this->planets_find_new_planet();
    while($this->planets_occupied($planet['gal'],$planet['sys'],$planet['plan']))  //Don't get any owned planets
    {
      $planet = $this->planets_find_new_planet();
    }
    $this->planets_owner($id,$planet['gal'],$planet['sys'],$planet['plan'],$pname);
    $res['fe'] = 500; $res['lut'] = 500; $res['h2o'] = 500; $res['h2'] = 0;
    $this->planets_res_set($planet,$res);
    $mod = $CONFIG["planets_info"]["max_dia"]-$CONFIG["planets_info"]["min_dia"];
    $add = $CONFIG["planets_info"]["min_dia"];
    $info['diameter'] = rand()%$mod+$add;
    $mod = $CONFIG["planets_info"]["min_temp"]-$CONFIG["planets_info"]["max_temp"];
    $add = $CONFIG["planets_info"]["min_temp"];
    $info['temp_lo'] = rand()%$mod+$add;
    $info['temp_hi'] = rand()%$mod+$add;
    if($info['temp_lo'] > $info['temp_hi'])
    {
      $tmp = $info['temp_hi'];
      $info['temp_hi'] = $info['temp_lo'];
      $info['temp_lo'] = $tmp;
      unset($tmp); 
    }
    $info['points'] = 0;
    $this->planets_info_set($planet,$info);
    $gal = $planet['gal'];
    $sys = $planet['sys'];
    $plan = $planet['plan'];
    $this->query("INSERT INTO planet_buildings SET gal=$gal,sys=$sys,plan=$plan,buildid=1,level=1;"); $this->err();
  }
  function user_get_id($name)
  {
    $this->query("SELECT id FROM users WHERE user = '$name';");  $this->err();
    if($this->numrows()<=0)
    {
      return -1;
    }
    else
    {
      $row = $this->fetch();
      return $row['id'];
    }
  }
  function user_get_name($id)
  {
    $this->query("SELECT user FROM users WHERE id = '$id';");  $this->err();
    if($this->numrows()<=0)
    {
      return "[unbekannt - nicht gefunden]";
    }
    else
    {
      $row = $this->fetch();
      return $row['user'];
    }
  }
  function user_get_pass($id)
  {
    $this->query("SELECT pass FROM users WHERE id = '$id';");  $this->err();
    if($this->numrows()<=0)
    {
      return "[unbekannt - nicht gefunden]";
    }
    else
    {
      $row = $this->fetch();
      return $row['pass'];
    }
  }
  function user_name_existing($name)
  {
    return !($this->user_get_id($name)==-1);
  }
  function planets_get_userid($gal,$sys,$plan)
  {
    $this->query("SELECT userid FROM planets WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['userid'];
    }
  }
  function planets_get_pname($gal,$sys,$plan)
  {
    $this->query("SELECT pname FROM planets WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['pname'];
    }
  }
  function planets_get_score($gal,$sys,$plan)
  {
    $this->query("SELECT points FROM planets_info WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['points'];
    }
  }
  function planets_info_get_diameter($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT diameter FROM planets_info WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['diameter'];
    }
  }
  function planets_info_get_temp_hi($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT temp_hi FROM planets_info WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['temp_hi'];
    }
  }
  function planets_info_get_temp_lo($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT temp_lo FROM planets_info WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['temp_lo'];
    }
  }
  function planets_info_get_points($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT points FROM planets_info WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['points'];
    }
  }
  /* Kein Bock FIXME!
  function build_points($userid)
  {
    $this->query("SELECT * FROM planets WHERE userid='$userid'");
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT points FROM planets_info WHERE userid='"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['points'];
    }
  }
  */
  function sci_points($userid)
  {
    $this->query("SELECT score_sci FROM users WHERE id='$userid'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row['score_sci'];
    }
  }
  function planets_occupied($gal,$sys,$plan)
  {
    if($this->planets_get_userid($gal,$sys,$plan)==-1)
    {
      return false;
    }
    return true;
  }
  function planets_inthissystem($gal,$sys)
  {
    global $CONFIG;
    $mod = $CONFIG["planets"]["max_plan"]- $CONFIG["planets"]["min_plan"];
    $add = $CONFIG["planets"]["min_plan"];
    srand($sys+$gal);
    $ret = rand()%$mod+$add;
    srand(microtime(1)%rand());
    return $ret;
  }
  function planets_random_occupied()
  {
    global $CONFIG;
    srand(microtime(1)%rand());
    $this->query("SELECT * FROM planets ORDER BY RAND() LIMIT 1;"); $this->err();
    if($this->numrows() <=0)
    {
      $ret['gal'] = rand()%$CONFIG["planets"]["max_gal"]+1;
      $ret['sys'] = rand()%$CONFIG["planets"]["max_sys"]+1;
      $max=$this->planets_inthissystem($ret['gal'],$ret['sys']);
      $ret["plan"] = rand()%$max;
      return $ret;
    }
    else
    {
      $row = $this->fetch();
      //echo "<b>DEBUG (LINE ".__LINE__."):</b> print_r(\$row):<br>"; print_r($row); echo "<br>";
      $ret['gal'] = $row['gal'];
      $ret['sys'] = $row['sys'];
      $ret['plan'] = $row['plan'];
      //echo "found: ".$ret['gal'].":".$ret['sys'].":".$ret['plan']."<br>";
      return $ret;
    }
  }
  function planets_find_new_planet()
  {
    global $CONFIG;
    $range = $CONFIG["planets"]["new_user_range"];
    $ret = $this->planets_random_occupied();
    $ret['sys'] = $ret['sys']+(rand()%($range*2))-$range;
    while($ret['sys'] < 0)
    {
      if($ret['gal'] <= 0)
      {
        $ret['sys'] = abs($ret['sys']);
      }
      else
      {
        $ret['gal'] -= 1;
        $ret['sys'] = $CONFIG["planets"]["max_sys"]+$ret['sys'];
      }
    }
    while($ret['sys'] > $CONFIG["planets"]["max_sys"])
    {
      if($ret['gal'] >=  $CONFIG["planets"]["max_gal"])
      {
        $ret['sys'] = abs($ret['sys']);
      }
      else
      {
        $ret['gal'] += 1;
        $ret['sys'] = $ret['sys']%$CONFIG["planets"]["max_sys"];
      }
    }
    if($ret['gal'] < 0)
      $ret['gal'] = 0;
    if($ret['gal'] > $CONFIG['planets']['max_gal'] )
      $ret['gal'] = $CONFIG['planets']['max_gal'];
    $max=$this->planets_inthissystem($ret['gal'],$ret['sys']);
    $ret['plan'] = rand()%$max+1;
    return $ret;
  }
  function planets_owner($userid,$gal,$sys,$plan,$pname="dontchange")
  {
    if($this->planets_occupied($gal,$sys,$plan))
    {
      //Invasion. *g* *0wn3d* :D
      if($pname == "dontchange")
      {
        $this->query("UPDATE planets SET userid=$userid WHERE gal=$gal AND sys=$sys AND plan=$plan;");
      }
      else
      {
        $this->query("UPDATE planets SET userid=$userid,pname='$pname' WHERE gal=$gal AND sys=$sys AND plan=$plan;");
      }
      $this->err();
    }
    $this->query("INSERT INTO planets (userid,gal,sys,plan,pname) VALUES($userid,$gal,$sys,$plan,'$pname');");
    $this->err();
  }
  function planets_get_coords($id)
  {
    $this->query("SELECT * FROM planets WHERE userid=$id;"); $this->err();
    if($this->numrows() <=0)
    {
      return -1;
    }
    else
    {
      $row = $this->fetch();
      $ret['gal'] = $row['gal'];
      $ret['sys'] = $row['sys'];
      $ret['plan'] = $row['plan'];
      //echo "found: ".$ret['gal'].":".$ret['sys'].":".$ret['plan']."<br>";
      return $ret;
    }
  }
  function planets_res($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT fe,lut,h2,h2o FROM planets_res WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
      return -1;
    else
    {
      $row = $this->fetch();
      return $row;;
    }
  }
  function planet_res_formatted($coords)
  {
  
    $res = $this->planets_res($coords);
    //echo "<b>DEBUG:</b> (Line ".__LINE__."): ---print_r---<br>"; print_r($res); echo "<br>";
    $res['fe']  = $this->format_set_points($res['fe']);
    $res['lut'] = $this->format_set_points($res['lut']);
    $res['h2o'] = $this->format_set_points($res['h2o']);
    $res['h2']  = $this->format_set_points($res['h2']);
    return $res;
  }
  function planets_res_set($coords,$res)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $fe = $res['fe']; $lut = $res['lut']; $h2o = $res['h2o']; $h2 = $res['h2']; 
    $this->query("SELECT fe FROM planets_res WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
    {
      $this->query("INSERT INTO planets_res SET fe=$fe, lut=$lut, h2o=$h2o, h2=$h2, gal='$gal', sys='$sys', plan='$plan', lastupdate='".time()."';"); $this->err();
    }
    else
    {
      $this->query("UPDATE planets_res SET fe=$fe, lut=$lut, h2o=$h2o, h2=$h2 WHERE gal='$gal' AND sys='$sys' AND plan='$plan';"); $this->err();
    }
  }
  function planets_res_update_time($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("UPDATE planets_res SET lastupdate='".time()."' WHERE gal='$gal' AND sys='$sys' AND plan='$plan';"); $this->err();
  }
  
  function planets_info_set($coords,$info)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $dia = $info['diameter']; $temp_lo = $info['temp_lo']; $temp_hi = $info['temp_hi']; $points = $info['points'];
    
    $this->query("SELECT gal FROM planets_info WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    if($this->numrows()<=0)
    {
      $this->query("INSERT INTO planets_info SET diameter='$dia', temp_lo='$temp_lo', temp_hi='$temp_hi', points='$points', gal='$gal', sys='$sys', plan='$plan'"); $this->err();
    }
    else
    {
      $this->query("UPDATE planets_info SET diameter=$dia, temp_lo=$temp_lo, temp_hi=$temp_hi, points=$points WHERE gal='$gal' AND sys='$sys' AND plan='$plan'"); $this->err();
    }
  }
  function planets_building_has($coords,$id,$level)
  {
    //echo "planets_build_has(crd,id:$id,level:$level)<br>";
    if($this->planets_building_level($coords,$id) >= $level)
    {
      
      //echo "building $id $level has<br>";
      return true;
    }
    //echo "building ID: $id Lev:$level has not<br>";
    return false;
  }
  function planets_building_level($coords,$id)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    //echo "<b>DEBUG:</b>Level fuer ID $id Coords: $gal:$sys:$plan...";
    //echo "$gal:$sys:$plan ID:$id-> planets_building_level<br>";
    $db3 = new cl_extended_database;
    $db3->query("SELECT level FROM planet_buildings WHERE gal='$gal' AND sys='$sys' AND plan='$plan' AND buildid='$id'"); $this->err();
    if($db3->numrows() <= 0)
    {
      unset($db3);
      //echo "level 0<br>";
      //echo "Special 0<br>";
      return 0;
    }
    else
    {
      $row = $db3->fetch();
      unset($db3);
     // echo "level is ".$row['level']."<br>";
     //echo $row['level']."<br>";
      return $row['level'];
    }
    //echo "Special -1<br>";
    return -1;
  }
  function user_sci_has($userid,$id,$level)
  {
    //echo "planets_build_has(crd,id:$id,level:$level)<br>";
    if($this->sci_building_level($userid,$id) >= $level)
    {
      
      //echo "building $id $level has<br>";
      return true;
    }
    //echo "building ID: $id Lev:$level has not<br>";
    return false;
  }
  function sci_building_level($userid,$id)
  {
    //echo "$gal:$sys:$plan ID:$id-> planets_building_level<br>";
    $db3 = new cl_extended_database;
    $db3->query("SELECT level FROM user_sci WHERE userid=$userid AND sciid=$id"); $this->err();
    if($db3->numrows() <= 0)
    {
      unset($db3);
      //echo "level 0<br>";
      return 0;
    }
    else
    {
      $row = $db3->fetch();
      unset($db3);
     // echo "level is ".$row['level']."<br>";
      return $row['level'];
    }
    return -1;
  }
  function needs_met($coords,$need_id)
  {
    //echo "cl_ext_db::needs_met(coords,need_id:$need_id)<br>";
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $db4 = new cl_extended_database;
    $db4->query("SELECT * FROM needs WHERE id='$need_id'"); $db4->err();
    $some_hope = true;
    while(($row = $db4->fetch()) && $some_hope)
    {
      if(!$this->planets_building_has($coords,$row['building'],$row['level']))
      {
        $some_hope = false;
      }
    }
    return $some_hope;
    
  }
  function sci_needs_met($owner,$need_id)
  {
    //echo "cl_ext_db::needs_met(coords,need_id:$need_id)<br>";
    if($need_id == -1)
      return true;
    if($need_id == -2)
      return false;
   /* $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $owner = $this->planets_get_userid($gal,$sys,$plan);*/
    $db4 = new cl_extended_database;
    $db4->query("SELECT * FROM sci_needs WHERE id='$need_id'"); $db4->err();
    $some_hope = true;
    while(($row = $db4->fetch()) && $some_hope)
    {
      if(!$this->user_sci_has($owner,$row['sciid'],$row['level']))
      {
        $some_hope = false;
      }
    }
    return $some_hope;
    
  }
  function planet_buildlist($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM buildings;"); $this->err();
    $i=0;
    $need_id = array();
    while($row = $this->fetch())
    {
      $db2 = new cl_extended_database;            
      $ret[$row['id']] = $db2->planets_building_level($coords,$row['id'])+1;
      $need_id[$row['id']] = $row['need_id']; 
      $i++;
      unset($db2);
    }
    $ret2 = array();
    foreach($ret as $id => $level)
    {
      if($need_id[$id] == -1 || $this->needs_met($coords,$need_id[$id]))
      {
        $ret2[$id] = $level;
      }
    }
    $this->reinit();
    return $ret2;
    
  }
  function planet_scilist($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $owner =   $this->planets_get_userid($gal,$sys,$plan);  
    $this->query("SELECT * FROM science;"); $this->err();
    $i=0;
    $need_id = array();
    $ret = array();
    while($row = $this->fetch())
    {
      $db2 = new cl_extended_database;            
      $ret[$row['id']] = $db2->sci_building_level($owner,$row['id'])+1;      
      $need_id[$row['id']] = $row['need_id']; 
      $i++;
      unset($db2);
    }
    $ret2 = array();
    foreach($ret as $id => $level)
    {
      if($need_id[$id] == -1 || $this->sci_needs_met($owner,$need_id[$id]))
      {
        $ret2[$id] = $level;
      }
    }
    $this->reinit();
    return $ret2;
    
  }
  function building_get_name($id)
  {
    $this->query("SELECT name FROM buildings WHERE id=$id"); $this->err();
    $row = $this->fetch();
    return $row['name'];  
  }
  function sci_get_name($id)
  {
    $this->query("SELECT name FROM science WHERE id=$id"); $this->err();
    $row = $this->fetch();
    return $row['name'];  
  }
  function building_get_desc($id)
  {
    //Leave SELECT *, because "desc" is a reserved keyword -> error!
    $this->query("SELECT * FROM buildings WHERE id=$id"); $this->err();
    $row = $this->fetch();
    return $row['desc'];  
  }
  function sci_get_desc($id)
  {
    //Leave SELECT *, because "desc" is a reserved keyword -> error!
    $this->query("SELECT * FROM science WHERE id=$id"); $this->err();
    $row = $this->fetch();
    return $row['desc'];  
  }

  function get_commzentral_level($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM planet_buildings WHERE buildid='1' AND gal=$gal AND sys=$sys AND plan=$plan;"); 
    $this->err();
    $row = $this->fetch();
    return $row['level'];
  }
  function building_get_costs($id,$level)
  {
    $this->query("SELECT * FROM buildings WHERE id='$id'"); $this->err();
    $row = $this->fetch();
    $ret = array();
    //FORMULA (1+(($level+1)^3+10)/10)
    // (1+((Stufe+1)^3+10)/10) 
    // (1+(pow(($level+1),3)+10)/10)
    // ACHTUNG! Teilen wie bc (scale=0) mit abrunden!
    $ret['res1'] = ($row['res1']/2) * (1+floor((pow($level,3)+10)/10));
    $ret['res2'] = ($row['res2']/2) * (1+floor((pow($level,3)+10)/10));
    $ret['res3'] = ($row['res3']/2) * (1+floor((pow($level,3)+10)/10));
    $ret['res4'] = ($row['res4']/2) * (1+floor((pow($level,3)+10)/10));
    //Just for compatibility
    $ret['fe'] = $ret['res1'];
    $ret['lut'] = $ret['res2'];
    $ret['h2o'] = $ret['res3'];
    $ret['h2'] = $ret['res4'];
    return $ret;   
  }
  function sci_get_costs($id,$level)
  {
    $this->query("SELECT * FROM science WHERE id='$id'"); $this->err();
    $row = $this->fetch();
    $ret = array();
    //FORMULA (1+(($level+1)^3+10)/10)
    // (1+((Stufe+1)^3+10)/10) 
    // (1+(pow(($level+1),3)+10)/10)
    // ACHTUNG! Teilen wie bc mit abrunden!
    $ret['res1'] = ($row['res1']/2) * (1+floor((pow($level,3)+10)/10));
    $ret['res2'] = ($row['res2']/2) * (1+floor((pow($level,3)+10)/10));
    $ret['res3'] = ($row['res3']/2) * (1+floor((pow($level,3)+10)/10));
    $ret['res4'] = ($row['res4']/2) * (1+floor((pow($level,3)+10)/10));
    //Just for compatibility
    $ret['fe']  = $ret['res1'];
    $ret['lut'] = $ret['res2'];
    $ret['h2o'] = $ret['res3'];
    $ret['h2']  = $ret['res4'];
    return $ret;   
  }
  function building_get_production($id,$level)
  {
    global $CONFIG;
    $this->query("SELECT * FROM buildings WHERE id=$id;"); $this->err();
    $row = $this->fetch();
    //FORMULA
    /*
      n = Stufe 
      d = n div 5 (Ganzzahlige Division) 
      m = n mod 5 (Rest der Division) 
      p = [ (n + 1) * n + 2dm + 5d (d - 1) + 2 ] 
    */
    //Formula 100% correct!
    $n=$level;
    $d=floor($n/5);
    $m=$n%5;
    $ret['fe'] =  $row['pro1']*(($n+1)*$n+2*$d*$m+5*$d*($d-1)+2);
    $ret['lut'] = $row['pro2']*(($n+1)*$n+2*$d*$m+5*$d*($d-1)+2);
    $ret['h2o'] = $row['pro3']*(($n+1)*$n+2*$d*$m+5*$d*($d-1)+2);
    $ret['h2'] =  $row['pro4']*(($n+1)*$n+2*$d*$m+5*$d*($d-1)+2);
    $ret['fe'] *= $CONFIG['time']['speedfactor'];
    $ret['lut'] *= $CONFIG['time']['speedfactor'];
    $ret['h2o'] *= $CONFIG['time']['speedfactor'];
    $ret['h2'] *= $CONFIG['time']['speedfactor'];
    //Unsinn:
  /*  if($row['pro1'] <0)
    {
      $ret['fe'] = -$ret['fe'];
    }
    if($row['pro2'] <0)
    {
      $ret['lut'] = -$ret['lut'];
    }
    if($row['pro3'] <0)
    {
      $ret['h2o'] = -$ret['h2o'];
    }
    if($row['pro4'] <0)
    {
      $ret['h2'] = -$ret['h2'];
    } */
    return $ret;
  }
  function building_get_time($id,$level,$coords)
  {
    global $CONFIG;
    //FORMULA
    /* Bauzeit_des_Gebäudes_mit_Komm_1 = Bauzeit_auf_Stufe_1_in_Sekunden * [ABRUNDEN(2 + Gewünschte_Stufe_des_Gebäudes^3 / 10) / 2] 
    
 (Endschritt: ) 
 Bauzeit = Bauzeit_des_Gebäudes_mit_Komm_1 * [1 / [ABRUNDEN(Stufe_der_Kommzentrale^2 / 1.667 + 2) * 0.5]] */
//$level--;
     $this->query("SELECT * FROM buildings WHERE id=$id;"); $this->err();
     $row = $this->fetch();
     $comlevel = $this->get_commzentral_level($coords);
  //echo "comlev: $comlevel<br>";
     $bauzeit = $row['time'] * (floor(2+pow($level,3)/10)/2);
  //echo "bauzeit: $bauzeit<br>";
     //$bauzeit = floor($bauzeit * (1/(floor(pow($comlevel,2)/(11/3))/2)));
     $bauzeit = $bauzeit * (1/(floor(pow($comlevel,2)/1.667+2)*0.5));
  //echo "bauzeit: $bauzeit<br>";
 //echo "<b>DBUG:</b> Bauzeit-Anforderung fuer ID:$id LVL:$level -> Bauzeit: $bauzeit<br>";
     return $bauzeit/$CONFIG['time']['speedfactor'];

  }
  function sci_get_time($id,$level,$coords)
  {
    global $CONFIG;
    //FORMULA
    /* Bauzeit_des_Gebäudes_mit_Komm_1 = Bauzeit_auf_Stufe_1_in_Sekunden * [ABRUNDEN(2 + Gewünschte_Stufe_des_Gebäudes^3 / 10) / 2] 
 
 (Endschritt: ) 
 Bauzeit = Bauzeit_des_Gebäudes_mit_Komm_1 * [1 / [ABRUNDEN(Stufe_der_Kommzentrale^2 / 1.667 + 2) * 0.5]] */
     $this->query("SELECT * FROM science WHERE id=$id;"); $this->err();
     $row = $this->fetch();
     $scilevel = $this->planets_building_level($coords,2); //Level Forschung
     $bauzeit = $row['time'] * (floor(2+pow($level,3)/10)/2);
     $bauzeit = $bauzeit * (1/(floor(pow($scilevel,2)/1.667+2)*0.5));
     return $bauzeit/$CONFIG['time']['speedfactor'];

  }
  function formatted_sci_get_time($id,$level,$coords)
  {
    $time = $this->sci_get_time($id,$level,$coords);
    $h = floor($time/3600);
    $time = $time%3600;
    $m = floor($time/60);
    $time = $time%60;
    $s = $time;
    if($h<10)
      $h = "0$h";
    if($m<10)
      $m = "0$m";
    if($s<10)
      $s = "0$s";
    $ret =  "$h:$m:$s";
    //echo $ret."<br>";
    return $ret;
    
  }
  function formatted_building_get_time($id,$level,$coords)
  {
    $time = $this->building_get_time($id,$level,$coords);
    $h = floor($time/3600);
    $time = $time%3600;
    $m = floor($time/60);
    $time = $time%60;
    $s = $time;
    if($h<10)
      $h = "0$h";
    if($m<10)
      $m = "0$m";
    if($s<10)
      $s = "0$s";
    $ret =  "$h:$m:$s";
    //echo $ret."<br>";
    return $ret;    
  }
  function format_time($time)
  {
    $h = floor($time/3600);
    $time = $time%3600;
    $m = floor($time/60);
    $time = $time%60;
    $s = $time;
    if($h<10)
      $h = "0$h";
    if($m<10)
      $m = "0$m";
    if($s<10)
      $s = "0$s";
    $ret =  "$h:$m:$s";
    return $ret;
  }
  function format_set_points($var)
  {
    return number_format($var,0,',','.');
  }
  function format_res($fe,$lut,$h2o,$h2)
  {
    $ret_str = "";
    if($fe > 0)
    {
      $ret_str .= "Eisen: <b>".$this->format_set_points($fe)."</b> ";
    }
    if($lut > 0)
    {
      $ret_str .= "Luthrium: <b>".$this->format_set_points($lut)."</b> ";
    }
    if($h2o > 0)
    {
      $ret_str .= "Wasser: <b>".$this->format_set_points($h2o)."</b> ";
    }
    if($h2 > 0)
    {
      $ret_str .= "Wasserstoff: <b>".$this->format_set_points($h2)."</b>";
    }
    return $ret_str;
  }
  function formatted_building_get_costs($id,$level)
  {
    $cost = $this->building_get_costs($id,$level);
    return $this->format_res($cost['res1'],$cost['res2'],$cost['res3'],$cost['res4']);
  }
  function formatted_sci_get_costs($id,$level)
  {
    $cost = $this->sci_get_costs($id,$level);
    $ret_str = "";
    if($cost['res1'] > 0)
    {
      $ret_str .= "Eisen: <b>".$this->format_set_points($cost['res1'])."</b> ";
    }
    if($cost['res2'] > 0)
    {
      $ret_str .= "Luthrium: <b>".$this->format_set_points($cost['res2'])."</b> ";
    }
    if($cost['res3'] > 0)
    {
      $ret_str .= "Wasser: <b>".$this->format_set_points($cost['res3'])."</b> ";
    }
    if($cost['res4'] > 0)
    {
      $ret_str .= "Wasserstoff: <b>".$this->format_set_points($cost['res4'])."</b>";
    }
    return $ret_str;
  }
  function buildings_can_build($coords,$id)
  {
    //print_r($coords); echo "<br>"; print_r($id);
    $own_db = new cl_extended_database;
    $level_to_build = $own_db->planets_building_level($coords,$id);
   // echo "<br>";
    //echo "level to build: $level_to_build<br>";
    $own_db->reinit();
    $res = $own_db->planets_res($coords);    
    $res_need = $own_db->building_get_costs($id,($level_to_build+1));
    //print_r($res);echo "<br>"; print_r($res_need); echo "<br>--------------<br>";
    if($res['fe'] >= $res_need['fe'] &&
       $res['lut'] >= $res_need['lut'] &&
       $res['h2o'] >= $res_need['h2o'] &&
       $res['h2'] >= $res_need['h2'])
    {
      return true;
    }
    else
    {
      return false;
    }
    return false;
  }
  function sci_can_build($coords,$userid,$id)
  {
    //print_r($coords); echo "<br>"; print_r($id);
    $own_db = new cl_extended_database;
    $level_to_build = $own_db->sci_building_level($userid,$id);
   // echo "<br>";
    //echo "level to build: $level_to_build<br>";
    $own_db->reinit();
    $res = $own_db->planets_res($coords);    
    $res_need = $own_db->sci_get_costs($id,($level_to_build+1));
    //print_r($res);echo "<br>"; print_r($res_need); echo "<br>--------------<br>";
    if($res['fe'] >= $res_need['fe'] &&
       $res['lut'] >= $res_need['lut'] &&
       $res['h2o'] >= $res_need['h2o'] &&
       $res['h2'] >= $res_need['h2'])
    {
      return true;
    }
    else
    {
      return false;
    }
    return false;
  }
  function var_res_negate($var_res)
  {
    $ret['fe']    = -$var_res['fe'];
    $ret['lut']   = -$var_res['lut'];
    $ret['h2o']   = -$var_res['h2o'];
    $ret['h2']    = -$var_res['h2'];
    if(isset($var_res['res1']))
    {
      $ret['res1']  = -$var_res['res1'];
      $ret['res2']  = -$var_res['res2'];
      $ret['res3']  = -$var_res['res3'];
      $ret['res4']  = -$var_res['res4'];
    }
    return $ret;
  }
  function tasks_building_build($userid,$coords,$id,$level,$endtime)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    //FIXED
    //$endtime += 3600; //Can't find the Bug, adding 1h for correct timing
    $var_query = "INSERT INTO tasks SET userid='$userid', gal='$gal', sys='$sys', plan='$plan', typ='1', objectid='$id', objectlevel='$level', endtime='$endtime';";
    //echo $var_query;
    $this->query($var_query); $this->err();
   // echo "after_query<br>";
    $res_need = $this->building_get_costs($id,$level);
   // echo "costs: "; print_r($res_need); echo "<br>";
    $res_need = $this->var_res_negate($res_need);
   // echo "costs_neg: "; print_r($res_need); echo "<br>";
    $this->res_add($coords,$res_need);
  }
  function tasks_sci_build($userid,$coords,$id,$level,$endtime)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    //FIXED
    //$endtime += 3600; //Can't find the Bug, adding 1h for correct gw timing
    $var_query = "INSERT INTO tasks SET userid='$userid', gal='$gal', sys='$sys', plan='$plan', typ='2', objectid='$id', objectlevel='$level', endtime='$endtime';";
    //echo $var_query;
    $this->query($var_query); $this->err();
   // echo "after_query<br>";
    $res_need = $this->sci_get_costs($id,$level);
   // echo "costs: "; print_r($res_need); echo "<br>";
    $res_need = $this->var_res_negate($res_need);
   // echo "costs_neg: "; print_r($res_need); echo "<br>";
    $this->res_add($coords,$res_need);
  }
  function tasks_id_building_on_build($coords,$id)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT taskid FROM tasks WHERE gal=$gal AND sys=$sys AND plan=$plan AND typ=1 AND objectid=$id"); $this->err();
    if($this->numrows() <= 0)
    {
      return -1;
    }
    $row = $this->fetch();
    return $row['taskid'];
  }
  function tasks_id_sci_on_build($coords,$id)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT taskid FROM tasks WHERE gal=$gal AND sys=$sys AND plan=$plan AND typ=2 AND objectid=$id"); $this->err();
    if($this->numrows() <= 0)
    {
      return -1;
    }
    $row = $this->fetch();
    return $row['taskid'];
  }
  function tasks_somethingonbuild($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM tasks WHERE gal=$gal AND sys=$sys AND plan=$plan AND typ=1;"); $this->err();
    if($this->numrows() <= 0)
    {
      return -1;
    }
    else
    {
      return 1;
    }
  }
  function tasks_somethingonsci($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM tasks WHERE gal=$gal AND sys=$sys AND plan=$plan AND typ=2;"); $this->err();
    if($this->numrows() <= 0)
    {
      return -1;
    }
    else
    {
      return 1;
    }
  }
  function tasks_is_building_on_build($coords,$id)
  {
    if($this->tasks_id_building_on_build($coords,$id)==-1)
      return false;
    return true;
  }
  function tasks_endtime($taskid)
  {
    $this->query("SELECT endtime FROM tasks WHERE taskid=$taskid"); $this->err();
    $row = $this->fetch(); return $row['endtime']; 
  }
  function task_kill($taskid)
  {
    $this->query("SELECT * FROM tasks WHERE taskid='$taskid';"); $this->err();
    $row = $this->fetch();
    $typ = $row['typ'];
    if($typ == 1) //Konstruktion
    {
      $level = $row['objectlevel'];
      $buildid = $row['objectid'];
      $coords['gal'] = $row['gal'];
      $coords['sys'] = $row['sys'];
      $coords['plan'] = $row['plan'];
      $costs = $this->building_get_costs($buildid,$level);
      $this->res_add($coords,$costs); //res back!
      $this->query("DELETE FROM tasks WHERE taskid='$taskid'"); $this->err();
    }
    else if($typ == 2) //Forschung
    {
      $level = $row['objectlevel'];
      $buildid = $row['objectid'];
      $coords['gal'] = $row['gal'];
      $coords['sys'] = $row['sys'];
      $coords['plan'] = $row['plan'];
      $costs = $this->sci_get_costs($buildid,$level);
      $this->res_add($coords,$costs); //res back!
      $this->query("DELETE FROM tasks WHERE taskid='$taskid'"); $this->err();
    }
    else
    {
      echo "cl_extended_database::task_kill for tasktype '$typ' unimplemented, look near: File:".__FILE__." Line:".__LINE__."<br>";
    }
    
  }
  function building_set_level($coords,$buildid,$level)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM planet_buildings WHERE gal=$gal AND sys=$sys AND plan=$plan AND buildid=$buildid"); $this->err();
    if($this->numrows() <= 0)
    {
      $this->query("INSERT INTO planet_buildings SET gal=$gal, sys=$sys, plan=$plan, buildid=$buildid, level=$level"); $this->err();
    }
    else
    {
      $this->query("UPDATE planet_buildings SET level=$level WHERE gal=$gal AND sys=$sys AND plan=$plan AND buildid=$buildid;");
      $this->err();
    }    
  }
  function sci_set_level($userid,$sciid,$level)
  {
    $this->query("SELECT * FROM user_sci WHERE userid=$userid AND sciid=$sciid");
    $this->err();
    if($this->numrows() <= 0)
    {
      $this->query("INSERT INTO user_sci SET userid=$userid, sciid=$sciid, level=$level"); $this->err();
    }
    else
    {
      $this->query("UPDATE user_sci SET level=$level WHERE userid=$userid AND sciid=$sciid;");
      $this->err();
    }    
  }
  function tasks_refresh($userid)
  {
    $var_query = "SELECT * FROM tasks WHERE userid='$userid' AND endtime <= ".time().";";
    $this->query($var_query); $this->err();
    $own_db = new cl_extended_database;  //Don't kill the fetch-loop with error in line 297
    while($row = $this->fetch())
    {
      $typ = $row['typ'];
      if($typ == 1) //Ah! a building!
      {
        $level = $row['objectlevel'];
        $buildid = $row['objectid'];
        $coords['gal'] = $row['gal'];
        $coords['sys'] = $row['sys'];
        $coords['plan'] = $row['plan'];
	$taskid = $row['taskid'];
	$own_db->building_set_level($coords,$buildid,$level);
        $own_db->add_build_points($own_db->build_points_for($buildid),$coords);
	$var_query = "DELETE FROM tasks WHERE taskid='$taskid'";
	//echo $var_query."<br>";
        $own_db->query($var_query); $this->err();
        //echo "end of delete<br>";
      }
      else if($typ == 2) //Sci
      {
        $level = $row['objectlevel'];
        $sciid = $row['objectid'];
	$userid = $row['userid'];
	$taskid = $row['taskid'];
	$own_db->sci_set_level($userid,$sciid,$level);
        $own_db->add_sci_points($own_db->sci_points_for($sciid),$userid);
	$var_query = "DELETE FROM tasks WHERE taskid='$taskid'";
	//echo $var_query."<br>";
        $own_db->query($var_query); $this->err();
        //echo "end of delete<br>";
      }
      else
      {
        echo "cl_extended_database::tasks_refresh for tasktype '$typ' unimplemented, look near: File:".__FILE__." Line:".__LINE__."<br>";
      }
    }
    unset($own_db);    
  }
  function sci_points_for($id)
  {
    $this->query("SELECT points FROM science WHERE id='$id'"); $this->err();
    $r = $this->fetch();
    return $r['points'];
  }
  function build_points_for($id)
  {
    $this->query("SELECT points FROM buildings WHERE id='$id'"); $this->err();
    $r = $this->fetch();
    return $r['points'];
  }
  function add_sci_points($points,$userid)
  {
    $this->query("UPDATE users SET score_sci=score_sci+'$points' WHERE id = '$userid';"); $this->err();
  }
  function add_build_points($points,$coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("UPDATE planets_info SET points=points+'$points' WHERE gal = '$gal' AND sys = '$sys' AND plan = '$plan';"); $this->err();
  }
  function res_read($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM planets_res WHERE gal=$gal AND sys=$sys AND plan=$plan;");
    $this->err();
    $row = $this->fetch();
    return $row;
  }
  function res_add($coords,$res)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    //print_r($res);
    //$this->query("UPDATE planets_res SET fe=fe+'".$res['fe']."', lut=lut+'".$res['lut']."', h2o=h2o+'".$res['h2o']."', h2=h2+'".$res['h2']."' WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
    $this->reinit();
    $stor = $this->planet_getstorage($coords);
    $this->reinit();
    $resx = $this->planets_res($coords);
    $this->reinit();
    //BUG in php5: $resx['fe']  += $res['fe']; -> Connection to host broken!
    $resx['fe']  = $resx['fe'] +$res['fe'];
    $resx['lut'] = $resx['lut']+$res['lut'];
    $resx['h2o'] = $resx['h2o']+$res['h2o'];
    $resx['h2']  = $resx['h2'] +$res['h2'];
    
    if($resx['fe'] > $stor['fe'])
    {
      $resx['fe'] = $stor['fe'];
    }
    if($resx['lut'] > $stor['lut'])
    {
      $resx['lut'] = $stor['lut'];
    }
    if($resx['h2o'] > $stor['h2o'])
    {
      $resx['h2o'] = $stor['h2o'];
    }
    else if($resx['h2o'] < 0)
    {
      $resx['h2o'] = 0;
    }
    if($resx['h2'] > $stor['h2'])
    {
      $resx['h2'] = $stor['h2'];
    }
    //print_r($resx);
    $this->query("UPDATE planets_res SET fe='".$resx['fe']."', lut='".$resx['lut']."', h2o='".$resx['h2o']."', h2='".$resx['h2']."' WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
    
  }
  function formula_storage($level)
  {
    //FORMULA
    if($level == 0) { return 100000; } //anti division by zero
    return (pow($level,3)*(1/$level)*2*10000+100000);
  }
  function planet_buildings_production($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM planet_buildings WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
    $ret['fe']  = 0; //init
    $ret['lut'] = 0;
    $ret['h2o'] = 0;
    $ret['h2']  = 0;
    while($row = $this->fetch())
    {
      //print_r($row);
      $own_db = new cl_extended_database;
      $prod = $own_db->building_get_production($row['buildid'],$row['level']);
      $ret['fe']  +=  $prod['fe'];
      $ret['lut'] +=  $prod['lut'];
      $ret['h2o'] +=  $prod['h2o'];
      $ret['h2']  +=  $prod['h2'];
      //echo "PROD-inloop:<br><b>"; print_r($prod); echo "</b><br>";
      unset($own_db);
    }
    $ret['fe']   += 10; //Grundeinkommen
    $ret['lut']  += 10;
    $ret['h2o']  += 10;
    return $ret;
  }
  function res_refresh($coords)
  {
    global $CONFIG;
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $prod = $this->planet_buildings_production($coords);
    $this->reinit();
    $this->query("SELECT * FROM planets_res WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
    $row = $this->fetch();
    $time = time() - $row['lastupdate'];
    //echo "TIME:<br><b>"; print_r($time); echo "</b><br>";
    if($time < (60/$CONFIG['time']['speedfactor']))
    {
      //zu grosse verluste durch rundung -> forget it!
      return 0;
    }
    //echo "PROD:<br><b>"; print_r($prod); echo "</b><br>";
    $res['fe']  = $time*($prod['fe']/3600);
    $res['lut'] = $time*($prod['lut']/3600);
    $res['h2o'] = $time*($prod['h2o']/3600);
    $res['h2']  = $time*($prod['h2']/3600);
    $this->res_add($coords,$res);
    $this->planets_res_update_time($coords);
    //echo "NEWRES:<br><b>"; print_r($newres); echo "</b><br>";
  }
  function planet_getstorage($coords)
  {
    //Level
    $ret['fe']  = $this->planets_building_level(8,$coords);   //Eisenspeicher
    $ret['lut'] = $this->planets_building_level(9,$coords);   //Luthriumspeicher
    $ret['h2o'] = $this->planets_building_level(10,$coords);  //Wassertanks
    $ret['h2']  = $this->planets_building_level(11,$coords);  //Wasserstoffspeicher
    //Res
    $ret['fe']  = $this->formula_storage($ret['fe']);
    $ret['lut'] = $this->formula_storage($ret['lut']); 
    $ret['h2o'] = $this->formula_storage($ret['h2o']); 
    $ret['h2']  = $this->formula_storage($ret['h2']);
    return $ret; 
  }
  function planet_prodlist($coords)
  {
    $gal = $coords['gal'];
    $sys = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM planet_buildings WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
    $buildlist[0]['level'] = 1;
    $i=0;
    while($row=$this->fetch())
    {
      $buildlist[$i]['level'] = $row['level'];
      //$buildlist[$i]['name'] = $row['name'];
      $buildlist[$i]['buildid'] = $row['buildid'];
      $i++;
    }
    $this->reinit();
    $prodlist = array();
    $j=0;
    while($j<$i)
    {
      $this->reinit();
      $prod = $this->building_get_production($buildlist[$j]['buildid'],$buildlist[$j]['level']);
      //echo "<b>DEBUG:</b> print_r prod<br>"; print_r($prod); echo "<br>";
      if($prod['fe'] != 0 || $prod['lut'] != 0 || $prod['h2o'] != 0 || $prod['h2'] != 0 )
      {
        //$prodlist[$j]['name'] = $prod['name'];
	$this->reinit();
	$prodlist[$j]['name'] = $this->building_get_name($buildlist[$j]['buildid']);
	$prodlist[$j]['level'] = $buildlist[$j]['level'];
	$prodlist[$j]['prod'] = $prod;
	$prodlist[$j]['prod_f']['fe']  = $this->format_set_points($prod['fe']);
	$prodlist[$j]['prod_f']['lut'] = $this->format_set_points($prod['lut']);
	$prodlist[$j]['prod_f']['h2o'] = $this->format_set_points($prod['h2o']);
	$prodlist[$j]['prod_f']['h2']  = $this->format_set_points($prod['h2']);
      }
      $j++;
    }
    //echo "<b>DEBUG:</b> print_r prodlist<br>"; print_r($prodlist); echo "<br>";
    return $prodlist; 
  
  }
  function techlist($coords)
  {
    $techlist = array();
    $ptr = 0;
    $this->query("SELECT * FROM buildings"); $this->err();
    while($row=$this->fetch())
    {
      $techlist[$ptr]['id'] = $row['id'];
      $techlist[$ptr]['name'] = $row['name'];
      $techlist[$ptr]['need_id'] = $row['need_id'];
      $ptr++;
    }
    //echo "<b>DEBUG (1st techlist):</b><br>"; print_r($techlist); echo "<br>";
    //echo "ptr: $ptr<br>";   
    $this->reinit();
    $i=0;
    while($i<$ptr)
    {
      //echo "I: $i<br>";
      if($techlist[$i]['need_id'] != -1)
      {
        $this->query("SELECT * FROM needs WHERE id='".$techlist[$i]['need_id']."';"); $this->err();
	$needs = array();
	$ptr2=0;
	while($row = $this->fetch())
	{
	  $needs[$ptr2]['building'] = $row['building'];  
	  $needs[$ptr2]['level'] = $row['level'];
	  
	  $ptr2++;
	}
	$techlist[$i]['nr_needs'] = $ptr2;
	$techlist[$i]['needs'] = $needs;
	$this->reinit();
      }
      $i++;
    }   
    //echo "<b>DEBUG (2nd techlist):</b><br>"; print_r($techlist); echo "<br>"; 
    $this->reinit();
    $i=0;
    while($i<$ptr)
    {
      if($techlist[$i]['need_id'] != -1)
      {
        //there are some needs
	$j=0;
	if (isset($techlist[$i]['nr_needs']))
	{
	  while($j<$techlist[$i]['nr_needs'])
	  {
	    $this->reinit();
	    $this->query("SELECT * FROM buildings WHERE id='".$techlist[$i]['needs'][$j]['building']."';");
	    $this->err();
	    $row = $this->fetch();
	    $techlist[$i]['needs'][$j]['name'] = $row['name'];
	    $this->reinit();
	    if($this->planets_building_has($coords,$techlist[$i]['needs'][$j]['building'],$techlist[$i]['needs'][$j]['level']))
	    {
	      $techlist[$i]['needs'][$j]['met'] = 1;
	    }
	    else
	    {
	      $techlist[$i]['needs'][$j]['met'] = -1;
	    }
	    $j++;
	  }
	}
      }
      $i++;
    }
    //echo "<b>DEBUG (final techlist):</b><br>"; print_r($techlist); echo "<br>";
    return $techlist;
  }
  function techlist_sci($uid)
  {
    $techlist = array();
    $ptr = 0;
    $this->query("SELECT * FROM science"); $this->err();
    while($row=$this->fetch())
    {
      $techlist[$ptr]['id'] = $row['id'];
      $techlist[$ptr]['name'] = $row['name'];
      $techlist[$ptr]['need_id'] = $row['need_id'];
      $ptr++;
    }
   // echo "<b>DEBUG (1st techlist):</b><br>"; print_r($techlist); echo "<br>";
    //echo "ptr: $ptr<br>";   
    $this->reinit();
    $i=0;
    while($i<$ptr)
    {
      //echo "I: $i<br>";
      if($techlist[$i]['need_id'] != -1)
      {
        $this->query("SELECT * FROM sci_needs WHERE id='".$techlist[$i]['need_id']."';"); $this->err();
	$needs = array();
	$ptr2=0;
	while($row = $this->fetch())
	{
	  $needs[$ptr2]['sci'] = $row['sciid'];  
	  $needs[$ptr2]['level'] = $row['level'];
	  
	  $ptr2++;
	}
	$techlist[$i]['nr_needs'] = $ptr2;
	$techlist[$i]['needs'] = $needs;
	$this->reinit();
      }
      $i++;
    }   
   // echo "<b>DEBUG (2nd techlist):</b><br>"; print_r($techlist); echo "<br>"; 
    $this->reinit();
    $i=0;
    while($i<$ptr)
    {
      if($techlist[$i]['need_id'] != -1)
      {
        //there are some needs
	$j=0;
	if (isset($techlist[$i]['nr_needs']))
	{
	  while($j<$techlist[$i]['nr_needs'])
	  {
	    $this->reinit();
	    $this->query("SELECT * FROM science WHERE id='".$techlist[$i]['needs'][$j]['sci']."';");
	    $this->err();
	    $row = $this->fetch();
	    $techlist[$i]['needs'][$j]['name'] = $row['name'];
	    $this->reinit();
	    if($this->user_sci_has($uid,$techlist[$i]['needs'][$j]['sci'],$techlist[$i]['needs'][$j]['level']))
	    {
	      $techlist[$i]['needs'][$j]['met'] = 1;
	    }
	    else
	    {
	      $techlist[$i]['needs'][$j]['met'] = -1;
	    }
	    $j++;
	  }
	}
      }
      $i++;
    }
   // echo "<b>DEBUG (final techlist):</b><br>\n"; print_r($techlist); echo "<br>\n\n";
    return $techlist;
  }
  function techlist_ships($uid)
  {
    $techlist = array();
    $ptr = 0;
    $this->query("SELECT * FROM ships WHERE sci_need != '-2'"); $this->err();
    while($row=$this->fetch())
    {
      $techlist[$ptr]['id'] = $row['id'];
      $techlist[$ptr]['name'] = $row['name'];
      $techlist[$ptr]['need_id'] = $row['sci_need'];
      $ptr++;
    }
  //  echo "<b>DEBUG (1st techlist):</b><br>"; print_r($techlist); echo "<br>";
    //echo "ptr: $ptr<br>";   
    $this->reinit();
    $i=0;
    while($i<$ptr)
    {
      //echo "I: $i<br>";
      if($techlist[$i]['need_id'] != -1)
      {
        $this->query("SELECT * FROM sci_needs WHERE id='".$techlist[$i]['need_id']."';"); $this->err();
	$needs = array();
	$ptr2=0;
	while($row = $this->fetch())
	{
	  $needs[$ptr2]['sci'] = $row['sciid'];  
	  $needs[$ptr2]['level'] = $row['level'];
	  
	  $ptr2++;
	}
	$techlist[$i]['nr_needs'] = $ptr2;
	$techlist[$i]['needs'] = $needs;
	$this->reinit();
      }
      $i++;
    }   
   // echo "<b>DEBUG (2nd techlist):</b><br>"; print_r($techlist); echo "<br>"; 
    $this->reinit();
    $i=0;
    while($i<$ptr)
    {
      if($techlist[$i]['need_id'] != -1)
      {
        //there are some needs
	$j=0;
	if (isset($techlist[$i]['nr_needs']))
	{
	  while($j<$techlist[$i]['nr_needs'])
	  {
	    $this->reinit();
	    $this->query("SELECT * FROM science WHERE id='".$techlist[$i]['needs'][$j]['sci']."';");
	    $this->err();
	    $row = $this->fetch();
	    $techlist[$i]['needs'][$j]['name'] = $row['name'];
	    $this->reinit();
	    if($this->user_sci_has($uid,$techlist[$i]['needs'][$j]['sci'],$techlist[$i]['needs'][$j]['level']))
	    {
	      $techlist[$i]['needs'][$j]['met'] = 1;
	    }
	    else
	    {
	      $techlist[$i]['needs'][$j]['met'] = -1;
	    }
	    $j++;
	  }
	}
      }
      $i++;
    }
   // echo "<b>DEBUG (final techlist):</b><br>\n"; print_r($techlist); echo "<br>\n\n";
    return $techlist;
  }
  function planetlist($gal,$sys)
  {
    $this->query("SELECT * FROM planets WHERE gal=$gal AND sys=$sys;"); $this->err();
    $planet_count = $this->planets_inthissystem($gal,$sys);
    $planetlist = array();
    $occ = 0;
    while($row = $this->fetch())
    {
      $ptr = $row['plan'];
      $planetlist[$ptr]['plan'] = $row['plan']; //Nr of planet (X:X:Nr<--)
      $planetlist[$ptr]['sys'] = $sys;
      $planetlist[$ptr]['gal'] = $gal;
      $planetlist[$ptr]['userid'] = $row['userid'];
      $planetlist[$ptr]['free'] = 0;  
      $occ++;  
    }
    //$occ: No. of occupied planets
    for($i=1;$i<=$planet_count;$i++)
    {
      if(!isset($planetlist[$i]['userid']))
      {
        $planetlist[$i]['plan'] = $i;
	$planetlist[$i]['sys'] = $sys;
	$planetlist[$i]['gal'] = $gal;
	$planetlist[$i]['userid'] = -1;
	$planetlist[$i]['free'] = 1;
      }
    }
    for($i=1;$i<=$planet_count;$i++)
    {
      if($planetlist[$i]['userid'] != -1)
      {
        $userid = $planetlist[$i]['userid'];
        $gal=$planetlist[$i]['gal'];
        $sys=$planetlist[$i]['sys'];
        $plan=$planetlist[$i]['plan'];
        $planetlist[$i]['str_owner'] = $this->user_get_name($userid);
        $planetlist[$i]['name']      = $this->planets_get_pname($gal,$sys,$plan); 
        $planetlist[$i]['score']     = $this->planets_get_score($gal,$sys,$plan);
        $planetlist[$i]['allyid']    = $this->ally_member_of($userid);
        if($planetlist[$i]['allyid'] != -1)
        {
          $planetlist[$i]['allytag'] = $this->ally_get_tag($planetlist[$i]['allyid']);
        }
      }
    }
    //Sortieren, sonst bewohnte Planeten immer _vor_ den unbewohnten in der Anzeige!
   /* $ret_list = array();
    for($i=1;$i<=$planet_count;$i++)
    {
      $ret_list[$i]['plan'] = $planetlist[$i]['plan'];
      $ret_list[$i]['sys'] =  $planetlist[$i]['sys']; 
      $ret_list[$i]['gal'] =  $planetlist[$i]['gal'];
      $ret_list[$i]['free'] =  $planetlist[$i]['free'];
      if($ret_list[$i]['free'] == 0)
      {
        $ret_list[$i]['str_owner'] = $planetlist[$i]['str_owner'];
        $ret_list[$i]['name'] = $planetlist[$i]['name'];
        $ret_list[$i]['score'] = $planetlist[$i]['score'];
	$ret_listt[$i]['userid'] = $planetlist[$i]['userid'];
      }
    }
     */
     $ret_list = $planetlist;
    // rsort($ret_list);
    ksort($ret_list);
    $ret_list['score'] = "-1";
    $ret_list['occ'] = $occ;
    reset($ret_list);
    return $ret_list; 
  }
  function planet_info($coords)
  {
    $ret['gal'] = $coords['gal'];
    $ret['sys'] = $coords['sys'];
    $ret['plan'] = $coords['plan'];
    $ret['owner'] = $this->planets_get_userid($ret['gal'],$ret['sys'],$ret['plan']);
    $ret['str_owner'] = $this->user_get_name($ret['owner']);
    $ret['pname'] = $this->planets_get_pname($ret['gal'],$ret['sys'],$ret['plan']);
    $ret['score'] = $this->planets_get_score($ret['gal'],$ret['sys'],$ret['plan']);
    return $ret;
  }
  //userid: userid. read{0,1}: 0=only new msgs. type{0,1}: 0=msg 1=events -1=all from_to{0,1}: 1=from userid 0=to userid
  
  function msglist($userid,$read,$type,$from_to)
  {
    if($from_to == 0)
    {
      $query = "SELECT * FROM msgs WHERE touid='$userid'";
    }
    else if($from_to == 1)
    {
      $query = "SELECT * FROM msgs WHERE fromuid='$userid'";
    }
    else
    {
      "<b>msglist for from_to $from_to unimplemented!</b>";
    }
    if($read == 0)
    {
      $query .= " AND red='0'";
    }
    if($type == 1 || $type == 0)
    {
      $query .= " AND type='$type'";
    }
    $query .= " ORDER BY date DESC;";
    $this->query($query); $this->err(); 
    $ret = array();
    $ptr = 0;
    while($row = $this->fetch())
    {
      if($row['type'] == 0)
      { 
	$ret[$ptr]['str_date'] = date("D, j.n.Y - H:i:s",$row['date']);
	$ret[$ptr]['fromplanet']['gal']  = $row['fromgal'];
	$ret[$ptr]['fromplanet']['sys']  = $row['fromsys'];
	$ret[$ptr]['fromplanet']['plan'] = $row['fromplan'];
	$ret[$ptr]['toplanet']['gal']    = $row['togal'];
	$ret[$ptr]['toplanet']['sys']    = $row['tosys'];
	$ret[$ptr]['toplanet']['plan']   = $row['toplan'];
	$ret[$ptr]['fromuid']            = $row['fromuid'];
	$ret[$ptr]['touid']              = $row['touid'];
	//$ret[$ptr]['str_fromuser']     = $this->user_get_name($ret['fromuid']); In next loop!!!
	$ret[$ptr]['subject'] = $row['subject'];
	//$ret[$ptr]['text']             = $row['text']; Dont need this
	$ret[$ptr]['id'] = $row['msgid'];
	$ret[$ptr]['type'] = 0;
      }
      else
      {
        $ret[$ptr]['str_date'] = date("D, j.n.Y - H:i:s",$row['date']);
	$ret[$ptr]['fromplanet']['gal']  = $row['fromgal'];
	$ret[$ptr]['fromplanet']['sys']  = $row['fromsys'];
	$ret[$ptr]['fromplanet']['plan'] = $row['fromplan'];
	$ret[$ptr]['toplanet']['gal']    = $row['togal'];
	$ret[$ptr]['toplanet']['sys']    = $row['tosys'];
	$ret[$ptr]['toplanet']['plan']   = $row['toplan'];
	$ret[$ptr]['fromuid']            = $row['fromuid'];
	$ret[$ptr]['touid']              = $row['touid'];
	//$ret[$ptr]['str_fromuser']     = $this->user_get_name($ret['fromuid']); In next loop!!!
	$ret[$ptr]['text'] = $row['text'];
	$ret[$ptr]['subject'] = $row['subject'];
	//$ret[$ptr]['text']             = $row['text']; Dont need this
	$ret[$ptr]['id'] = $row['msgid'];
	$ret[$ptr]['type'] = 1;    
      }
      $ptr++;
    }
    for($i=0;$i<$ptr;$i++)
    {
      if($ret[$i]['type'] == 0)
      {
        $ret[$i]['str_fromuser'] = $this->user_get_name($ret[$i]['fromuid']);
        $ret[$i]['str_touser'] = $this->user_get_name($ret[$i]['touid']);
       }
       else
       {
         $ret[$i]['str_fromuser'] = "system";
         $ret[$i]['str_touser'] = $this->user_get_name($ret[$i]['touid']);
       }
    }
    $this->query("UPDATE msgs SET red=1 WHERE type = 1 AND touid='$userid'"); $this->err();
    return $ret;
  }
  function msg_read($msgid)
  {
    $query = "SELECT * FROM msgs WHERE msgid=$msgid;";
    $this->query($query); $this->err(); 
    $row = $this->fetch();
    $ret['str_date'] = date("D, j.n.Y - H:i:s",$row['date']);
    $ret['fromplanet']['gal']  = $row['fromgal'];
    $ret['fromplanet']['sys']  = $row['fromsys'];
    $ret['fromplanet']['plan'] = $row['fromplan'];
    $ret['toplanet']['gal']    = $row['togal'];
    $ret['toplanet']['sys']    = $row['tosys'];
    $ret['toplanet']['plan']   = $row['toplan'];
    $ret['fromuid']            = $row['fromuid'];
    $ret['touid']              = $row['touid'];
    $ret['subject']            = $row['subject'];
    $ret['text']               = nl2br($row['text']);
    $ret['id']                 = $row['msgid']; 
    $ret['str_fromuser']       = $this->user_get_name($ret['fromuid']);
    $ret['str_touser']         = $this->user_get_name($ret['touid']);
    $this->query("UPDATE msgs SET red=1 WHERE msgid=$msgid"); $this->err(); 
    return $ret;
  }
  function msg_del($msgid, $uid)
  {
    $this->query("DELETE FROM msgs WHERE msgid='$msgid' AND touid='$uid';"); $this->err();
  }
  function msg_write($fromuid,$fromcoords,$tocoords,$subject,$text)
  {
    $fgal  = $fromcoords['gal'];
    $fsys  = $fromcoords['sys'];
    $fplan = $fromcoords['plan'];    
    $tgal = $tocoords['gal'];
    $tsys = $tocoords['sys'];
    $tplan = $tocoords['plan'];
    $touid =  $this->planets_get_userid($tgal,$tsys,$tplan);
    $query = "INSERT INTO msgs SET fromuid=$fromuid, fromgal=$fgal, fromsys=$fsys, fromplan=$fplan, touid=$touid, ";
    $query .= "toplan=$tplan, tosys=$tsys, togal=$tgal, red=0, type=0, date='".time()."', subject='$subject', text='$text'";
    $this->query($query); $this->err();  
  }
  function msg_event_uid($uid,$text)
  {
    $tocoord = $this->planets_get_coords($uid);
    $gal  = $tocoord['gal'];
    $sys  = $tocoord['sys'];
    $plan = $tocoord['plan'];
    $touid = $uid;
    $query  = "INSERT INTO msgs SET fromuid='-1', fromgal='0', fromsys='0', fromplan='0', touid=$touid, ";
    $query .= "togal=$gal,  tosys=$sys,  toplan=$plan, red=0, type=1, date='".time()."', subject='event', text='$text'";
    $this->query($query); $this->err();
  }
  function msg_event($tocoord,$text)
  {
    $gal  = $tocoord['gal'];
    $sys  = $tocoord['sys'];
    $plan = $tocoord['plan'];
    $touid = $this->planets_get_userid($gal,$sys,$plan);
    $query  = "INSERT INTO msgs SET fromuid='-1', fromgal='0', fromsys='0', fromplan='0', touid=$touid, ";
    $query .= "togal=$gal,  tosys=$sys,  toplan=$plan, red=0, type=1, date='".time()."', subject='event', text='$text'";
    $this->query($query); $this->err();
  }
  function msg_new_for($userid)
  {
    $this->query("SELECT * FROM msgs WHERE touid=$userid AND red=0;"); $this->err();
    if($this->numrows() > 0)
    {
      return 1;
    }
    else
    {
      return 0;
    }
  }
  function shiplist($coords,$uid)
  {
    $level_sf = $this->planets_building_level($coords,12); $this->reinit();//Schiffsfabrik: Level
    $this->query("SELECT * FROM ships;"); $this->err();
    $ptr=0;
    $ret = array();
    $owndb = new cl_extended_database;
    while($row = $this->fetch())
    {
      if($row['sci_need'] == -1 || $owndb->sci_needs_met($uid,$row['sci_need']))
      {
        $owndb->reinit();
        $ret[$ptr]['id'] = $row['id'];
        $ret[$ptr]['name'] = $row['name'];
        $ret[$ptr]['desc'] = $row['desc'];
        $ret[$ptr]['res_need'] = $this->format_res($row['res1'],$row['res2'],$row['res3'],$row['res4']);
        $ret[$ptr]['time'] = $this->formula_shiptime($row['time'],$level_sf);
        $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
        $ptr++;
      }
    }
    $this->reinit();
    unset($owndb);
    return $ret; 
  }
  function towerlist($coords,$uid)
  {
    $level_sf = $this->planets_building_level($coords,13); $this->reinit();//OVS: Level
    $this->query("SELECT * FROM towers;"); $this->err();
    $ptr=0;
    $ret = array();
    $owndb = new cl_extended_database;
    while($row = $this->fetch())
    {
      if($row['sci_need'] == -1 || $owndb->sci_needs_met($uid,$row['sci_need']))
      {
        $owndb->reinit();
        $ret[$ptr]['id'] = $row['id'];
        $ret[$ptr]['name'] = $row['name'];
        $ret[$ptr]['desc'] = $row['desc'];
        $ret[$ptr]['res_need'] = $this->format_res($row['res1'],$row['res2'],$row['res3'],$row['res4']);
        $ret[$ptr]['time'] = $this->formula_shiptime($row['time'],$level_sf);
        $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
        $ptr++;
      }
    }
    $this->reinit();
    unset($owndb);
    return $ret; 
  }
  function ship_buildlist($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM ship_build WHERE gal=$gal AND sys=$sys AND plan=$plan ORDER BY `order` ASC;");
    $this->err();

    if($this->numrows() <= 0)
    {
      return -1;
    }
    $ptr=0;
    $ret = array();
    while($row = $this->fetch())
    {
      $ret[$ptr]['count'] = $row['count'];
      if($ptr == 0)
      {
        $ret[$ptr]['status'] = 1;
      }
      else
      {
        $ret[$ptr]['status'] = 0;
      }
      $ret[$ptr]['taskid'] = $row['buildid'];
      //no refresh: (PERFORMANCE)
      //$ret[$ptr]['resttime'] = $row['resttime'];
      //calc (unreal) refresh:
      if($ptr == 0)
      {
        $ret[$ptr]['resttime'] = $row['resttime']-(time()-$row['lastact']);
      }
      else
      {
        $ret[$ptr]['resttime'] = $row['resttime'];
      }
      //real refresh
      //kein back das jetzt zu schreiben... (iblue)
      $ret[$ptr]['id'] = $row['shiptype'];
      $ptr++;
      //if($ship['starttime'])
    }
    for($i=0;$i<$ptr;$i++)
    {
      $x =  $this->ships_select($ret[$i]['id']);
      $ret[$i]['name'] = $x['name'];
      $ret[$i]['str_resttime'] = $this->format_time($ret[$i]['resttime']);
    }
    //print_r($ret);
    return $ret;
  }
  function tower_buildlist($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM tower_build WHERE gal=$gal AND sys=$sys AND plan=$plan ORDER BY `order` ASC;");
    $this->err();

    if($this->numrows() <= 0)
    {
      return -1;
    }
    $ptr=0;
    $ret = array();
    while($row = $this->fetch())
    {
      $ret[$ptr]['count'] = $row['count'];
      if($ptr == 0)
      {
        $ret[$ptr]['status'] = 1;
      }
      else
      {
        $ret[$ptr]['status'] = 0;
      }
      $ret[$ptr]['taskid'] = $row['buildid'];
      //no refresh: (PERFORMANCE)
      //$ret[$ptr]['resttime'] = $row['resttime'];
      //calc (unreal) refresh:
      if($ptr == 0)
      {
        $ret[$ptr]['resttime'] = $row['resttime']-(time()-$row['lastact']);
      }
      else
      {
        $ret[$ptr]['resttime'] = $row['resttime'];
      }
      //real refresh
      //kein bock das jetzt zu schreiben... (iblue)
      $ret[$ptr]['id'] = $row['shiptype'];
      $ptr++;
      //if($ship['starttime'])
    }
    for($i=0;$i<$ptr;$i++)
    {
      $x =  $this->towers_select($ret[$i]['id']);
      $ret[$i]['name'] = $x['name'];
      $ret[$i]['str_resttime'] = $this->format_time($ret[$i]['resttime']);
    }
    //print_r($ret);
    return $ret;
  }
  function ships_select($id)
  {
    $this->query("SELECT * FROM ships WHERE id='$id';"); $this->err();
    if($this->numrows() <= 0)
    {
      return -1;
    }
    $row = $this->fetch();
    return $row;
  }
  function towers_select($id)
  {
    $this->query("SELECT * FROM towers WHERE id='$id';"); $this->err();
    if($this->numrows() <= 0)
    {
      return -1;
    }
    $row = $this->fetch();
    return $row;
  }
  function ship_build_maxorder()
  {
    $this->query("SELECT `order` FROM ship_build ORDER BY `order` DESC;");
    $this->err();
    if($this->numrows() <= 0)
    {
      $ret = 0;
    }
    else
    {
      $row = $this->fetch();
      $ret = $row['order'];
    }
    //echo "DEBUG: maxorder: $ret<br>";
    return $ret;
  }
  function tower_build_maxorder()
  {
    $this->query("SELECT `order` FROM tower_build ORDER BY `order` DESC;");
    $this->err();
    if($this->numrows() <= 0)
    {
      $ret = 0;
    }
    else
    {
      $row = $this->fetch();
      $ret = $row['order'];
    }
    //echo "DEBUG: maxorder: $ret<br>";
    return $ret;
  }
  function fleets_maxid()
  {
    $this->query("SELECT fleetid FROM fleets ORDER BY fleetid DESC;");
    $this->err();
    if($this->numrows() <= 0)
    {
      $ret = 0;
    }
    else
    {
      $row = $this->fetch();
      $ret = $row['fleetid'];
    }
    $this->query("SELECT fleetid FROM planet_orbit ORDER BY fleetid DESC;");
    $this->err();
    if($this->numrows() <= 0)
    {
      //$ret = $ret;
    }
    else
    {
      $row = $this->fetch();
      $ret = max($ret,$row['fleetid']);
    }
    //echo "DEBUG: maxorder: $ret<br>";
    return $ret;
  }
  function get_fleetid($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM planet_orbit WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
    if($this->numrows()<=0)
    {
      $fid = $this->fleets_maxid()+1;
      $this->query("INSERT INTO planet_orbit SET gal=$gal,sys=$sys,plan=$plan,fleetid=$fid");  //res{1,2,3,4} = 0 (standard)
      $this->err();
      return $fid;
    }  
    else
    {
      $r = $this->fetch();
      return $r['fleetid'];
    }
  }
  function ship_insert($coords,$cnt,$typ)
  {
    if($cnt > 0)
    {
      $this->reinit();
      $fid = $this->get_fleetid($coords);
      $this->query("INSERT INTO fleets SET fleetid=$fid, count=$cnt, shiptype=$typ;"); $this->err();
    } 
  }
  function tower_insert($coords,$cnt,$typ)
  {
    if($cnt > 0)
    {
      $this->reinit();
      $fid = $this->get_fleetid($coords);
      $this->query("INSERT INTO fleets_tr SET fleetid=$fid, count=$cnt, shiptype=$typ;"); $this->err();
    } 
  }
  function ships_build_refresh($coords) //FIXME: Verbugt, rewrite!
  {
    
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM ship_build WHERE gal=$gal AND sys=$sys AND plan=$plan ORDER BY `order` ASC;");
    $this->err();
    $own_db = new cl_extended_database;
    $nr1=1;
    $lref=0;
    $tv=0;
    $level_sf = $own_db->planets_building_level($coords,12); //Schiffsfabrik: Level
    while($row = $this->fetch())
    {
   //   echo "DBUG in ships_build_refresh: fetching...<br>";
      $tobuild = 0;
      $ship_select1 = $own_db->ships_select($row['shiptype']); $own_db->err();
      //$own_db->reinit(); //Try FIXME
      $shiptype_rtime = $own_db->formula_shiptime($ship_select1['time'],$level_sf);
      //$own_db->reinit();
      //unset($own_db); $own_db = new cl_extended_database;
      if($nr1==1)
      {
	$nr1 = 0;
        $lref = $row['lastact'];
	$now = time();
	$tv = $now-$lref;	
	//echo "<b>DEBUG:</b> Zeit vergangen:$tv<br>";
	
      }
    //  echo "BP1<br>";
      $rtime = $row['resttime'];
      if($rtime > $tv)
      {
        $new_rt=$rtime-$tv;
        //echo "<b>MySQL:</b>Setze resttime to auf $new_rt und exit...<br>";
	$own_db->query("UPDATE ship_build SET resttime='$new_rt', lastact='$now' WHERE buildid='".$row['buildid']."';"); $own_db->err();
        return;
      }      
      else
      {
        $tv -= $rtime;
	$rtime = $shiptype_rtime; //full time;
	//$cnt = 1;
	//echo "<b>MySQL:</b> Baue 1 schiff<br>";
	$tobuild +=1;
      }
    //  echo "BP2<br>";
      if($rtime > $tv)
      {
        $new_rt=$rtime-$tv;
        //echo "<b>MySQL:</b>Setze resttime to auf $new_rt und exit...<br>";
	if($row['count'] <= 1)
	{
	  $own_db->query("DELETE FROM ship_build WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  //echo "<b>MYSQL:</b> Loesche Thread, keine Schiffe vorhanden...'<br>";
	}
	else
	{
	  $own_db->query("UPDATE ship_build SET resttime='$new_rt', lastact='$now', count=count-1 WHERE buildid='".$row['buildid']."';"); $own_db->err();
	}
	$own_db->refresh_lastact($coords);
	$own_db->ship_insert($coords,$tobuild,$row['shiptype']);
        return;
      }
     // echo "BP3<br>";
      if($tv > 0)
      {
        //echo "TV: $tv, rt: $rtime<br>";
        $cnt = @floor($tv/$rtime);
	if($rtime == 0)
	{
	  $cnt+=1;
	}
	if($cnt == 0)
	{
	  //echo "soll 0 schiffe bauen -> nix da->exit!<br>";
	  return;
	}
	if($cnt > $row['count'])
	  $cnt = $row['count'];
	$rtime = $shiptype_rtime; // full time
	$tv -= $cnt*$rtime;
	/*if($tv < 0 && $cnt==1)
	{
	  echo "baue nur 1 schiff, setze restzeit auf [full time] und dann exit...<br>";
	  $rtime = $shiptype_rtime; // full time
	  $cnt = $row['count']-$cnt;
	  
	  $own_db->query("UPDATE ship_build SET count='$cnt', resttime='$rtime', lastact='$now' WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  return;
	}*/
       // echo "BP4<br>";
	$rtime = $tv;
	$row['count'] -= $cnt;
	//echo "cnt: $cnt<br>";
	//echo "TV: $rtime<br>";
	//echo "<b>MYSQL:</b> Fuege hinzu: $cnt schiffe vom typ '".$row['shiptype']."'<br>";
	$tobuild += $cnt;
	if($row['count'] <=0)
	{
	  $own_db->query("DELETE FROM ship_build WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  //echo "<b>MYSQL:</b> Loesche Thread, keine Schiffe vorhanden...'<br>";
	}
	else
	{
	  $cnt = $row['count'];
	  $own_db->query("UPDATE ship_build SET count='$cnt', resttime='$rtime', lastact='$now' WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  //echo "<b>MYSQL:</b> Set Thread auf: count->$cnt, resttime->$rtime'<br>";
	}
        //echo "BP5<br>";
	$own_db->refresh_lastact($coords);
	$own_db->ship_insert($coords,$tobuild,$row['shiptype']);
	if($tv <= $shiptype_rtime) //full time
	{
	  
	  //echo "Nothing more to build->exit<bR>";
	  return;
	}
	else
	{
	  //echo "Time left: $tv secounds, starting next thread<bR>";
	}
        //echo "BP6<br>";
      }
    }
  }
  function towers_build_refresh($coords)
  {
    
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("SELECT * FROM tower_build WHERE gal=$gal AND sys=$sys AND plan=$plan ORDER BY `order` ASC;");
    $this->err();
    $own_db = new cl_extended_database;
    $nr1=1;
    $lref=0;
    $tv=0;
    $level_sf = $own_db->planets_building_level($coords,13); //OVS: Level
    while($row = $this->fetch())
    {
      //   echo "DBUG in ships_build_refresh: fetching...<br>";
      $tobuild = 0;
      $ship_select1 = $own_db->towers_select($row['shiptype']); $own_db->err();
      //$own_db->reinit(); //Try FIXME
      $shiptype_rtime = $own_db->formula_shiptime($ship_select1['time'],$level_sf);
      //$own_db->reinit();
      //unset($own_db); $own_db = new cl_extended_database;
      if($nr1==1)
      {
	$nr1 = 0;
        $lref = $row['lastact'];
	$now = time();
	$tv = $now-$lref;	
	//echo "<b>DEBUG:</b> Zeit vergangen:$tv<br>";
	
      }
    //  echo "BP1<br>";
      $rtime = $row['resttime'];
      if($rtime > $tv)
      {
        $new_rt=$rtime-$tv;
        //echo "<b>MySQL:</b>Setze resttime to auf $new_rt und exit...<br>";
	$own_db->query("UPDATE tower_build SET resttime='$new_rt', lastact='$now' WHERE buildid='".$row['buildid']."';"); $own_db->err();
        return;
      }      
      else
      {
        $tv -= $rtime;
	$rtime = $shiptype_rtime; //full time;
	//$cnt = 1;
	//echo "<b>MySQL:</b> Baue 1 schiff<br>";
	$tobuild +=1;
      }
    //  echo "BP2<br>";
      if($rtime > $tv)
      {
        $new_rt=$rtime-$tv;
        //echo "<b>MySQL:</b>Setze resttime to auf $new_rt und exit...<br>";
	if($row['count'] <= 1)
	{
	  $own_db->query("DELETE FROM tower_build WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  //echo "<b>MYSQL:</b> Loesche Thread, keine Schiffe vorhanden...'<br>";
	}
	else
	{
	  $own_db->query("UPDATE tower_build SET resttime='$new_rt', lastact='$now', count=count-1 WHERE buildid='".$row['buildid']."';"); $own_db->err();
	}
	$own_db->refresh_lastact_tr($coords);
	$own_db->tower_insert($coords,$tobuild,$row['shiptype']);
        return;
      }
     // echo "BP3<br>";
      if($tv > 0)
      {
        //echo "TV: $tv, rt: $rtime<br>";
        $cnt = @floor($tv/$rtime);
	if($rtime == 0)
	{
	  $cnt+=1;
	}
	if($cnt == 0)
	{
	  //echo "soll 0 schiffe bauen -> nix da->exit!<br>";
	  return;
	}
	if($cnt > $row['count'])
	  $cnt = $row['count'];
	$rtime = $shiptype_rtime; // full time
	$tv -= $cnt*$rtime;
	/*if($tv < 0 && $cnt==1)
	{
	  echo "baue nur 1 schiff, setze restzeit auf [full time] und dann exit...<br>";
	  $rtime = $shiptype_rtime; // full time
	  $cnt = $row['count']-$cnt;
	  
	  $own_db->query("UPDATE ship_build SET count='$cnt', resttime='$rtime', lastact='$now' WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  return;
	}*/
       // echo "BP4<br>";
	$rtime = $tv;
	$row['count'] -= $cnt;
	//echo "cnt: $cnt<br>";
	//echo "TV: $rtime<br>";
	//echo "<b>MYSQL:</b> Fuege hinzu: $cnt schiffe vom typ '".$row['shiptype']."'<br>";
	$tobuild += $cnt;
	if($row['count'] <=0)
	{
	  $own_db->query("DELETE FROM tower_build WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  //echo "<b>MYSQL:</b> Loesche Thread, keine Schiffe vorhanden...'<br>";
	}
	else
	{
	  $cnt = $row['count'];
	  $own_db->query("UPDATE tower_build SET count='$cnt', resttime='$rtime', lastact='$now' WHERE buildid='".$row['buildid']."';"); $own_db->err();
	  //echo "<b>MYSQL:</b> Set Thread auf: count->$cnt, resttime->$rtime'<br>";
	}
        //echo "BP5<br>";
	$own_db->refresh_lastact($coords);
	$own_db->tower_insert($coords,$tobuild,$row['shiptype']);
	if($tv <= $shiptype_rtime) //full time
	{
	  
	  //echo "Nothing more to build->exit<bR>";
	  return;
	}
	else
	{
	  //echo "Time left: $tv secounds, starting next thread<bR>";
	}
        //echo "BP6<br>";
      }
    }
  }
  function refresh_lastact($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("UPDATE ship_build SET lastact='".time()."' WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
  }
  function refresh_lastact_tr($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $this->query("UPDATE tower_build SET lastact='".time()."' WHERE gal=$gal AND sys=$sys AND plan=$plan;"); $this->err();
  }
  function ship_orbit_list($coords)
  {
    $fid = $this->get_fleetid($coords);
    $this->query("SELECT shiptype,SUM(`count`) AS `sum_count` FROM fleets WHERE fleetid='$fid' GROUP BY shiptype;");
    $this->err();
    if($this->numrows() <=0)
      return -1;
    $ptr = 0;
    $ret = array();
    $own_db = new cl_extended_database;
    while($row = $this->fetch())
    {
      $ret[$row['shiptype']]['count'] = $row['sum_count'];
      $ret[$row['shiptype']]['type'] = $row['shiptype'];
      $ret[$row['shiptype']]['id'] = $row['shiptype'];
      $x = $own_db->ships_select($ret[$row['shiptype']]['type']);      
      $ret[$row['shiptype']]['name'] = $x['name'];
      $ptr++;
      /*print_r($row);
      echo "<br>\n";*/
    }
    return $ret;
  }
  function tower_orbit_list($coords)
  {
    $fid = $this->get_fleetid($coords);
    $this->query("SELECT shiptype,SUM(`count`) AS `sum_count` FROM fleets_tr WHERE fleetid='$fid' GROUP BY shiptype;");
    $this->err();
    if($this->numrows() <=0)
      return -1;
    $ptr = 0;
    $ret = array();
    $own_db = new cl_extended_database;
    while($row = $this->fetch())
    {
      $ret[$row['shiptype']]['count'] = $row['sum_count'];
      $ret[$row['shiptype']]['type'] = $row['shiptype'];
      $ret[$row['shiptype']]['id'] = $row['shiptype'];
      $x = $own_db->towers_select($ret[$row['shiptype']]['type']);      
      $ret[$row['shiptype']]['name'] = $x['name'];
      $ptr++;
      /*print_r($row);
      echo "<br>\n";*/
    }
    return $ret;
  }
  function fleet_count_ships($fid,$sid)
  {
    $this->query("SELECT shiptype,SUM(`count`) AS `sum_count` FROM fleets WHERE fleetid='$fid' AND shiptype='$sid' GROUP BY shiptype;"); 
    $this->err();
    if($this->numrows() <= 0)
      return 0;
    else
    {
      $row = $this->fetch();
      return $row['sum_count'];
    }
  }
  function fleet_count_towers($fid,$sid)
  {
    $this->query("SELECT shiptype,SUM(`count`) AS `sum_count` FROM fleets_tr WHERE fleetid='$fid' AND shiptype='$sid' GROUP BY shiptype;"); 
    $this->err();
    if($this->numrows() <= 0)
      return 0;
    else
    {
      $row = $this->fetch();
      return $row['sum_count'];
    }
  }
  function ship_fleet_list($fid)
  {
    $this->query("SELECT shiptype,SUM(`count`) AS `sum_count` FROM fleets WHERE fleetid='$fid' GROUP BY shiptype;");
    $this->err();
    if($this->numrows() <=0)
      return -1;
    $ptr = 0;
    $ret = array();
    while($row = $this->fetch())
    {
      $ret[$ptr]['count'] = $row['sum_count'];
      $ret[$ptr]['type'] = $row['shiptype'];
      $ptr++;
    }
    return $ret;  
  }
  function tower_fleet_list($fid)
  {
    $this->query("SELECT shiptype,SUM(`count`) AS `sum_count` FROM fleets_tr WHERE fleetid='$fid' GROUP BY shiptype;");
    $this->err();
    if($this->numrows() <=0)
      return -1;
    $ptr = 0;
    $ret = array();
    while($row = $this->fetch())
    {
      $ret[$ptr]['count'] = $row['sum_count'];
      $ret[$ptr]['type'] = $row['shiptype'];
      $ptr++;
    }
    return $ret;  
  }
  function ships_res_for($id,$coords)
  {
    $this->reinit();
    $ship_row = $this->ships_select($id);
    $this->reinit();
    $res_row = $this->res_read($coords);
    $ret = 0;
    if($ship_row['res1'] != 0)
    {
      $ret = ($res_row['fe']/$ship_row['res1']);
    }
    if($ship_row['res2'] != 0)
    {
      if($ret == 0)
        $ret = ($res_row['lut']/$ship_row['res2']);
      $ret = min($ret,($res_row['lut']/$ship_row['res2']));
    }
    if($ship_row['res3'] != 0)
    {
      if($ret == 0)
        $ret = ($res_row['h2o']/$ship_row['res3']);
      $ret = min($ret,($res_row['h2o']/$ship_row['res3']));
    }
    if($ship_row['res4'] != 0)
    {
      if($ret == 0)
        $ret = ($res_row['h2']/$ship_row['res4']);
      $ret = min($ret,($res_row['h2']/$ship_row['res4']));
    }
    return (int)$ret;  
  }
  function towers_res_for($id,$coords)
  {
    $this->reinit();
    $ship_row = $this->towers_select($id);
    $this->reinit();
    $res_row = $this->res_read($coords);
    $ret = 0;
    if($ship_row['res1'] != 0)
    {
      $ret = ($res_row['fe']/$ship_row['res1']);
    }
    if($ship_row['res2'] != 0)
    {
      if($ret == 0)
        $ret = ($res_row['lut']/$ship_row['res2']);
      $ret = min($ret,($res_row['lut']/$ship_row['res2']));
    }
    if($ship_row['res3'] != 0)
    {
      if($ret == 0)
        $ret = ($res_row['h2o']/$ship_row['res3']);
      $ret = min($ret,($res_row['h2o']/$ship_row['res3']));
    }
    if($ship_row['res4'] != 0)
    {
      if($ret == 0)
        $ret = ($res_row['h2']/$ship_row['res4']);
      $ret = min($ret,($res_row['h2']/$ship_row['res4']));
    }
    return (int)$ret;  
  }
  function formula_shiptime($time,$i)
  {
    global $CONFIG;
    /*
    (Zitat: GW-Forum)
    Sei i die Stufe der Schiffsfabrik. Sei 
    d = int(i/5) 
    m = i - d*5 
    p1 = i*(i+1)/2 
    p2 = d * m 
    p3 = 5 * d * (d-1) / 2 
    p = (p1 + p2 + p3 + 1 )/2 
    
    Dann ist die Bauzeit eines Schiffes in Sekunden: 
 
    Bauzeit=BauzeitBeiStufe1 / p 
    */
    $d = floor($i/5);
    //$m = $i - $d*5; 
    $m = $i%5;
    $p1 = $i*($i+1)/2;
    $p2 = $d*$m;
    $p3 = 5*$d*($d-1)/2;
    $p = ($p1+$p2+$p3+1)/2;
    $newtime = $time/$p;
    return $newtime/$CONFIG['time']['speedfactor'];
  }
  function ships_build($id, $count, $coords)
  {
    $level = $this->planets_building_level($coords,12); //OVS: Level
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    echo "baue $count -> $id auf $gal:$sys:$plan (mit level $level)<br>";
    //$build_cnt = $this->ships_res_for#
    $count = (int)$count;
    $rfor = $this->ships_res_for($id,$coords);
    if($rfor < $count)
      $count=$rfor;
    if($count <= 0)
      return;
    //echo "building $count of $id (Debug: Ship)<br>";
    $this->reinit();
    $order = $this->ship_build_maxorder($coords)+1;
    $this->reinit();
    $ship_sel = $this->ships_select($id);
    $resttime = $this->formula_shiptime($ship_sel['time'],$level);
    $this->query("INSERT INTO ship_build SET gal=$gal, sys=$sys, plan=$plan, count=$count, `order`=$order, resttime=$resttime, lastact='".time()."', shiptype=$id"); $this->err();
    $this->ships_build_refresh($coords);
    $this->reinit();
    $res = $this->ships_select($id);
    $this->reinit();
    $res['fe']  = -$res['res1']*$count;
    $res['lut'] = -$res['res2']*$count;
    $res['h2o'] = -$res['res3']*$count;
    $res['h2']  = -$res['res4']*$count;
    $this->res_add($coords,$res);
  }
  function towers_build($id, $count, $coords)
  {
    $level = $this->planets_building_level($coords,13); //OVS: Level
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    //$build_cnt = $this->ships_res_for#
    $count = (int)$count;
    $rfor = $this->towers_res_for($id,$coords);
    if($rfor < $count)
      $count=$rfor;
    if($count <= 0)
      return;
    //echo "building $count of $id (Debug: Ship)<br>";
    $this->reinit();
    $order = $this->tower_build_maxorder($coords)+1;
    $this->reinit();
    $ship_sel = $this->towers_select($id);
    $resttime = $this->formula_shiptime($ship_sel['time'],$level);
    $this->query("INSERT INTO tower_build SET gal=$gal, sys=$sys, plan=$plan, count=$count, `order`=$order, resttime=$resttime, lastact='".time()."', shiptype=$id"); $this->err();
    $this->towers_build_refresh($coords);
    $this->reinit();
    $res = $this->towers_select($id);
    $this->reinit();
    $res['fe']  = -$res['res1']*$count;
    $res['lut'] = -$res['res2']*$count;
    $res['h2o'] = -$res['res3']*$count;
    $res['h2']  = -$res['res4']*$count;
    $this->res_add($coords,$res);
  }
  function ships_build_delete($id)
  {
    $this->query("SELECT * FROM ship_build WHERE buildid=$id"); $this->err();
    $row = $this->fetch();
    $cnt= $row['count'];
    $coords['gal']  = $row['gal'];
    $coords['sys']  = $row['sys'];
    $coords['plan'] = $row['plan'];
    $ret = $this->ships_select($row['shiptype']);
    $res_a['fe']  = $ret['res1']*$cnt;
    $res_a['lut'] = $ret['res2']*$cnt;
    $res_a['h2o'] = $ret['res3']*$cnt;
    $res_a['h2']  = $ret['res4']*$cnt;
    
    $this->res_add($coords,$res_a);
    $this->query("DELETE FROM ship_build WHERE buildid=$id"); $this->err();
  }
  function towers_build_delete($id)
  {
    $this->query("SELECT * FROM tower_build WHERE buildid=$id"); $this->err();
    $row = $this->fetch();
    $cnt= $row['count'];
    $coords['gal']  = $row['gal'];
    $coords['sys']  = $row['sys'];
    $coords['plan'] = $row['plan'];
    $ret = $this->towers_select($row['shiptype']);
    $res_a['fe']  = $ret['res1']*$cnt;
    $res_a['lut'] = $ret['res2']*$cnt;
    $res_a['h2o'] = $ret['res3']*$cnt;
    $res_a['h2']  = $ret['res4']*$cnt;
    
    $this->res_add($coords,$res_a);
    $this->query("DELETE FROM tower_build WHERE buildid=$id"); $this->err();
  }
  function ships_build_down($id)
  {
    $order = $this->ship_build_maxorder()+1;
    $this->query("UPDATE ship_build SET `order`=$order WHERE buildid=$id"); $this->err();
  }
  function towers_build_down($id)
  {
    $order = $this->tower_build_maxorder()+1;
    $this->query("UPDATE tower_build SET `order`=$order WHERE buildid=$id"); $this->err();
  }
  function sim_shiplist()
  {
    $this->query("SELECT * FROM ships WHERE sci_need != -2;"); $this->err();
    $ptr=0;
    $ret = array();
    while($row = $this->fetch())
    {
      $ret[$ptr]['id'] = $row['id'];
      $ret[$ptr]['name'] = $row['name'];
      $ptr++;
    }
    return $ret; 
  }
  function sim_towerlist()
  {
    $this->query("SELECT * FROM towers WHERE sci_need != -2;"); $this->err();
    $ptr=0;
    $ret = array();
    while($row = $this->fetch())
    {
      $ret[$ptr]['id'] = $row['id'];
      $ret[$ptr]['name'] = $row['name'];
      $ptr++;
    }
    return $ret; 
  }
  function sim_stderg()
  {
    $ret['ag_a'] = "0";
    $ret['vt_a'] = "0";
    $ret['ag_v'] = "250";
    $ret['vt_v'] = "500";
    $ret['c_ag'] = "0,00";
    $ret['c_vt'] = "100,00";
    $ret['c_spio'] = "0,00";
    $ret['c_inva'] = "0,00";
    return $ret;
  }
  function ks_formula($ag_a,$vt_a,$ag_v,$vt_v)
  {
    $ag = max(($ag_a+$vt_a),1);
    $vt = ($ag_v+$vt_v);
    $x= ($ag-$vt)/(($ag+$vt)*0.0005);
    $ret = 1/(1+pow(2.5,-$x/(200)));
    if(($ag_a+$vt_a) <=0)
    {
      return 0.0;
    }
    return ($ret*100);
  }
  function spy_formula($ag,$vt,$anz_sonden)
  {
    if($anz_sonden==0)
      return 0;
    $x= ($anz_sonden*100)/(($ag+$vt)*0.0010)-((($ag+$vt)/20)/$anz_sonden);
    $ret = 1/(1+pow(2.5,-$x/(200)));
    return ($ret*100);  
  }
  function sim($post)
  {
    //1/(pow(1.8,(-$x)))
    //echo "<br>";
    $ag_a = 0; $vt_a=0;
    $ag_v = 250; $vt_v = 500;
    for($i=0;$i<500;$i++)
    {
      $ag=-1;
      $vt=-1;
      if(isset($post["a$i"]) && $post["a$i"] > 0)
      {
        if($ag==-1 || $vt==-1)
	{
	  $sel = $this->ships_select($i); $this->err();
	  $ag = $sel['ag'];
	  $vt = $sel['vt'];
	}
	$ag_a += $ag*$post["a$i"]; $vt_a += $vt*$post["a$i"];
        //echo "A $i:".$post["a$i"]."<br>";
      }
      if(isset($post["v$i"]) && $post["v$i"] > 0)
      {
        if($ag==-1 || $vt==-1)
	{
	  $sel = $this->ships_select($i); $this->err();
	  $ag = $sel['ag'];
	  $vt = $sel['vt'];
	}
	$ag_v += $ag*$post["v$i"]; $vt_v += $vt*$post["v$i"];
        //echo "V $i:".$post["v$i"]."<br>";
      }
    }
    //number_format(,2,',','.');
    $ret['ag_a'] = $ag_a;
    $ret['vt_a'] = $vt_a;
    $ret['ag_v'] = $ag_v;
    $ret['vt_v'] = $vt_v;
    $ret['c_ag'] = $this->ks_formula($ag_a,$vt_a,$ag_v,$vt_v);
    $ret['c_vt'] = 100-$ret['c_ag'];
    $ret['c_spio'] = $this->spy_formula($ag_v,$vt_v,$post["a103"]);
    $ret['c_inva'] = 0;
    $ret['c_ag'] = number_format($ret['c_ag'],2,',','.');
    $ret['c_vt'] = number_format($ret['c_vt'],2,',','.');
    $ret['c_spio'] = number_format($ret['c_spio'],2,',','.');
    $ret['c_inva'] = number_format($ret['c_inva'],2,',','.');
  //  return $this->sim_stderg();
  return $ret;
  }
  function fleet_disp2($post)
  {
    global $CONFIG;
    $this->reinit();
    $ships = array();
    $h2need = 0;
    $maxspeed = 0;
    $load = 0;
    $ptr=0;
    for($i=0;$i<500;$i++)
    {

      if(isset($post["c$i"]) && $post["c$i"] > 0)
      {
        $sel = $this->ships_select($i);
        $ships[$ptr]['id'] = $i;
	$cnt = $post["c$i"];
        $ships[$ptr]['count'] = $cnt;
	$h2need += $sel['consum']*$cnt;
	$load += $sel['load']*$cnt;
	if($maxspeed == 0)
	{
	  $maxspeed = $sel['speed'];
	}
	else
	  $maxspeed = min($maxspeed,$sel['speed']);
      }
    }
    $h2max = $load;
    $ret['a_fleet']['h2need'] = $h2need;
    $ret['a_fleet']['maxspeed'] = $maxspeed*$CONFIG['time']['speedfactor'];
    $ret['a_fleet']['load'] = $load;
    $ret['a_fleet']['h2max'] = $h2max;
    $ret['a_ships'] = $ships;
    return $ret;
  }
  function fleet_disp3($post)
  {
    $this->reinit();
    $ret['to']['gal']  = $post['ft1'];
    $ret['to']['sys']  = $post['ft2'];
    $ret['to']['plan'] = $post['ft3'];
    
    $tmp = $this->planet_info($ret['to']);
    $ret['to']['pname']= $tmp['pname'];
    $ret['to']['name'] = $tmp['str_owner'];
    $ships = array();
    for($i=0;$i<500;$i++)
    {
      $ptr=0;
      if(isset($post["c$i"]) && $post["c$i"] > 0)
      {
        $ships[$ptr]['id'] = $i;
        $cnt = $post["c$i"];
        $ships[$ptr]['count'] = $cnt;
      }
    }
    $ret['ships'] = $ships;
    return $ret;
  }
  function start_fleet($coords,$post)
  {
    //print_r($post);
    $ptr = 0;
    $ships = array();
    $this->reinit();
    $this->fleet_table_optimize($this->get_fleetid($coords));
//    echo "<br>Flotte:<br>";
    for($i=0;$i<500;$i++)
    {
      if(isset($post["c$i"]) && $post["c$i"] > 0)
      {
   //     echo "Von ID $i ".$post["c$i"]." Stk.<br>";
        $ships[$ptr]['id'] = $i;
        $ships[$ptr]['count'] = $post["c$i"];
        $ptr++;
      }
    }
    $opt=$post['opt'];
    $togal  = $post['ft1'];
    $tosys  = $post['ft2'];
    $toplan = $post['ft3'];
    $fromgal = $coords['gal'];
    $fromsys = $coords['sys'];
    $fromplan = $coords['plan'];
    //echo "$fromgal:$fromsys:$fromplan -> $togal:$tosys:$toplan<br>";
    $fcoords = $coords;
    $tcoords['gal'] = $post['ft1'];
    $tcoords['sys'] = $post['ft2'];
    $tcoords['plan'] = $post['ft3'];
    if($opt == "a")
    {
      //echo "Angreifen!<br>";

      $post['pl'] = 1;
      if(isset($post['pl']))
      {
        /*echo "...und pluendern!<br>";
	echo "reihenfolge:<br>";
        echo "1: Eisen 2: Luthrium 3: Wasser 4: H2<br>";
        echo "Platz 1: ".$post['r1']."<br>";
        echo "Platz 2: ".$post['r2']."<br>";
        echo "Platz 3: ".$post['r3']."<br>";*/
	$opt_pluendern = true;
	if(!isset($post['r1']))
	  $post['r1'] = 1;
	if(!isset($post['r2']))
	  $post['r2'] = 2;
	if(!isset($post['r3']))
	  $post['r3'] = 4;
	$pfolge[1] = $post['r1'];
	$pfolge[2] = $post['r2'];
	$pfolge[3] = $post['r3'];
      }
      else
        $opt_pluendern = false;
      $this->fleet_attack($fcoords,$tcoords,$ships,$opt_pluendern,$pfolge);
      
    }
    else if($opt == "t")
    {
    //  echo "Transport!<br>";
    //echo "<b>BUGBUG:</b> Transport is unimpemented! Script stopped<br>"; die();
      $res['fe']   = $post['t1'];
      $res['lut']  = $post['t2'];
      $res['h2o']  = $post['t3'];
      $res['h2']   = $post['t4'];

      
      //FIXME: check laderaum !
      $this->fleet_transport($fcoords,$tcoords,$ships,$res);
      //echo "$fe $lut $h2o $h2<br>";
      
    }
    else if($opt == "k") //Lecker Kolonisieren...
    {

      $this->fleet_kolo($fcoords,$tcoords,$ships);    
    }
    else
    {
      echo "Kaputt!<br> Bitte Bug im Flottensystem in Zeile ".__LINE__." melden, thx.<br>iBlue";
    }  
  }
  function fleet_kolo($fcoords,$tcoords,$shiplist)
  {
    global $CONFIG;
    $tgal   = $tcoords['gal'];
    $tsys   = $tcoords['sys'];
    $tplan  = $tcoords['plan'];
    
    $fgal    = $fcoords['gal'];
    $fsys    = $fcoords['sys'];
    $fplan   = $fcoords['plan'];
    $maxspeed = 0;
    $h2need = 0;
    $this->reinit();
    foreach($shiplist as $ship)
    {
      $st = $ship['id'];
      $cnt = $ship['count'];
      if($cnt > 0)
      {
        $sel = $this->ships_select($ship['id']);
        $this->reinit();
        $h2need += $sel['consum']*$cnt;
        if($maxspeed == 0)
        {
          $maxspeed = $sel['speed'];
        }
        else
          $maxspeed = min($maxspeed,$sel['speed']);
      }
    }
    $erg = $this->formula_transfer($fcoords,$tcoords,$maxspeed,$h2need);
    $tstart = time();
    $tthere = $tstart + ($erg['time']/$CONFIG['time']['speedfactor']);
    $tback  =  $tthere + ($erg['time']/$CONFIG['time']['speedfactor']);
    $h2need = $erg['h2need'];
    
    $homefid = $this->get_fleetid($fcoords);
    $this->query("UPDATE fleets SET `count`=`count`-1 WHERE fleetid='$homefid' AND shiptype=107;");
    
    $query  = "INSERT INTO transfer SET fleetid='-1', fromgal='$fgal', fromsys='$fsys', ";
    $query .= "fromplan='$fplan', togal='$tgal', tosys='$tsys', toplan='$tplan', `option`='2', ";
    $query .= "tstart='$tstart', tthere='$tthere', tback='$tback';"; 
    $this->query($query); $this->err();
  
  }
  function fleet_transport($fcoords,$tcoords,$shiplist,$res)
  {
    global $CONFIG;
    $this->reinit();
    $fid = $this->fleets_maxid()+1;
    $h2need = 0;
    $maxspeed = 0;
    $xyz = false;
    foreach($shiplist as $ship)
    {
      $st = $ship['id'];
      $cnt = $ship['count'];
      if($cnt > 0)
      {
        $this->query("INSERT INTO fleets SET fleetid='$fid', shiptype='$st', count='$cnt';"); $this->err();
        $homefid = $this->get_fleetid($fcoords);
        $this->query("UPDATE fleets SET count=count-'$cnt'WHERE fleetid='$homefid' AND shiptype='$st';"); $this->err();
        $this->reinit();
        $sel = $this->ships_select($ship['id']);
        $this->reinit();
        $h2need += $sel['consum']*$cnt;
        if($maxspeed == 0)
        {
          $maxspeed = $sel['speed'];
        }
        else
          $maxspeed = min($maxspeed,$sel['speed']);
	$xyz = true;
      }
    }
    $tgal   = $tcoords['gal'];
    $tsys   = $tcoords['sys'];
    $tplan  = $tcoords['plan'];
    
    $fgal    = $fcoords['gal'];
    $fsys    = $fcoords['sys'];
    $fplan   = $fcoords['plan'];
    
    $erg = $this->formula_transfer($fcoords,$tcoords,$maxspeed,$h2need);
    $tstart = time();
    $tthere = $tstart + ($erg['time']/$CONFIG['time']['speedfactor']);
    $tback  =  $tthere + ($erg['time']/$CONFIG['time']['speedfactor']);
    $h2need = $erg['h2need'];
    //echo "unimplemented: h2need: '$h2need'<br>";
    //echo "time:".$this->format_time($erg['time'])."<br>";
    //----Res transaction
    $res_has = $this->planets_res($fcoords);
    $lr1 = $res['fe']  = (int)max(min($res['fe'], $res_has['fe']) ,0);
    $lr2 = $res['lut'] = (int)max(min($res['lut'],$res_has['lut']),0);
    $lr3 = $res['h2o'] = (int)max(min($res['h2o'],$res_has['h2o']),0);
    $lr4 = $res['h2']  = (int)max(min($res['h2'], $res_has['h2']) ,0);
    $this->res_add($fcoords,$this->var_res_negate($res));  //FIXME: Kids! Do NOT try this at home!
    

    //----End of Res transaction
    if($xyz)
    {
      $query  = "INSERT INTO transfer SET fleetid='$fid', fromgal='$fgal', fromsys='$fsys', ";
      $query .= "fromplan='$fplan', togal='$tgal', tosys='$tsys', toplan='$tplan', `option`='1', ";
      $query .= "tstart='$tstart', tthere='$tthere', tback='$tback',"; 
      $query .= " loadres1='$lr1', loadres2='$lr2', loadres3='$lr3', loadres4='$lr4';";
      //Dont need loadres{1,2,3,4}, -> default: 0 
      $this->query($query); $this->err();
      //echo $query;
    }
  }
  function formula_transfer($fcoords, $tcoords, $speed, $h2need)
  {
 /*   echo "<br>---------<br>";
    print_r($fcoords); print_r($tcoords);
    echo "<br>speed: $speed<br>h2need: $h2need<br>";
    echo "---------------<br>"; */
    //look at ./templates/fleets2.thtml
    $a=$tcoords['gal'];
    $b=$tcoords['sys'];
    $c=$tcoords['plan'];
    $p=10;
    $d=-1;
    $en="";
    $fa=$fcoords['gal'];
    $fb=$fcoords['sys'];
    $fc=$fcoords['plan'];
    if($a!=$fa)
    {
      $d=abs(($a-$fa)*20000);
    }
    else if($b!=$fb)
    {
      $d=2700+5*abs(($b-$fb)*19);
    }
    else if($c!=$fc)
    {
      $d=1000+abs(($c-$fc)*5);
    }
    if($a<1|$a>199|$b<1|$b>300|$c<0|$c>199)
    {
      $d=-1;
    }
    $e=round($h2need*$d/35000*(($p/10)+1)*(($p/10)+1))+1;
    $s=round(35000/$p*sqrt($d*10/$speed));
    //$s is time ind secounds
    //$e is h2 needed...
    //$d is distance in Mm (Mega meters) ($d000 km)
    $ret['h2need'] = $e;
    $ret['time']   = $s;
    $ret['dist']   = $d;
    //echo "e: $e, s: $s, d: $d<br>";
    return $ret;
  }
  function delete_fleet($fid)
  {
    $this->query("DELETE FROM fleets WHERE fleetid='$fid';"); $this->err();  
  }
  function delete_fleet_tr($fid)
  {
    $this->query("DELETE FROM fleets_tr WHERE fleetid='$fid';"); $this->err();  
  }
  function delete_transfer($fid)
  {
    $this->query("DELETE FROM transfer WHERE fleetid='$fid';"); $this->err();  
  }
  function fleet_attack($fcoords,$tcoords,$shiplist,$opt_pluendern,$pfolge)
  {
    global $CONFIG;
    $this->reinit();
    $fid = $this->fleets_maxid()+1;
    $h2need = 0;
    $maxspeed = 0;
    $xyz = false;
    foreach($shiplist as $ship)
    {
      $st = $ship['id'];
      $cnt = $ship['count'];
      if($cnt > 0)
      {
        $this->query("INSERT INTO fleets SET fleetid='$fid', shiptype='$st', count='$cnt';"); $this->err();
        $homefid = $this->get_fleetid($fcoords);
        $this->query("UPDATE fleets SET count=count-'$cnt'WHERE fleetid='$homefid' AND shiptype='$st';"); $this->err();
        $this->reinit();
        $sel = $this->ships_select($ship['id']);
        $this->reinit();
        $h2need += $sel['consum']*$cnt;
        if($maxspeed == 0)
        {
          $maxspeed = $sel['speed'];
        }
        else
          $maxspeed = min($maxspeed,$sel['speed']);
	$xyz = true;
      }
    }
    $tgal   = $tcoords['gal'];
    $tsys   = $tcoords['sys'];
    $tplan  = $tcoords['plan'];
    
    $fgal    = $fcoords['gal'];
    $fsys    = $fcoords['sys'];
    $fplan   = $fcoords['plan'];
    
    $erg = $this->formula_transfer($fcoords,$tcoords,$maxspeed,$h2need);
    $tstart = time();
    $tthere = $tstart + ($erg['time']/$CONFIG['time']['speedfactor']);
    $tback  =  $tthere + ($erg['time']/$CONFIG['time']['speedfactor']);
    $h2need = $erg['h2need'];
    //echo "unimplemented: h2need: '$h2need'<br>";
    //echo "time:".$this->format_time($erg['time'])."<br>";
    if($xyz)
    {
      $query  = "INSERT INTO transfer SET fleetid='$fid', fromgal='$fgal', fromsys='$fsys', ";
      $query .= "fromplan='$fplan', togal='$tgal', tosys='$tsys', toplan='$tplan', `option`='0', ";
      $query .= "tstart='$tstart', tthere='$tthere', tback='$tback';"; 
      //Dont need loadres{1,2,3,4}, -> default: 0 
      $this->query($query); $this->err();
      //echo $query;
    }
  }
  function transfer_refresh($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $now = time();
    $query  = "SELECT * FROM transfer WHERE ((togal=$gal AND tosys=$sys AND toplan=$plan) OR";
    $query .= "(fromgal=$gal AND fromsys=$sys AND fromplan=$plan)) AND (tthere <= $now OR tback <= $now);";
    $this->query($query); $this->err();
   // echo "Jetzt: $now<br>";
    
    while($row = $this->fetch())
    {
      //----------------ALLGEMEIN--------------------------------------------------------------
        $f['gal'] = $row['fromgal']; $f['sys'] = $row['fromsys']; $f['plan'] = $row['fromplan'];
        $t['gal'] = $row['togal'];   $t['sys'] = $row['tosys'];   $t['plan'] = $row['toplan'];
        $tgal = $t['gal']; $tsys = $t['sys']; $tplan = $t['plan'];
        $fgal = $f['gal']; $fsys = $f['sys']; $fplan = $f['plan'];
        $owndb = new cl_extended_database;
      //----------------ANGRIFF--------------------------------------------------------------------------------------
      if($row['option'] == 0)
      {        
        $owndb->reinit();

        //print_r($row);
        $bericht = -1;
        //echo "tthere: ".$row['tthere']."<br>";
        //echo "Flotte war da vor: ".($now-$row['tthere'])." Sec<br>";
        if(!$owndb->has_report($row['fleetid']))
        {
          $bericht = $owndb->create_report($row['fleetid'],$f,$t);
          $owndb->reinit();
          $owndb->query("SELECT * FROM reports WHERE fleetid='".$row['fleetid']."';"); $owndb->err();
          $row2 = $owndb->fetch();
          $rid = $row2['id'];
          //echo "Bericht ID: '$rid'<br>";
          
          $owndb->msg_event($f,"Eine Flotte ist an ihrem Ziel angekommen.<br><a href=\"bericht.php5?id=$rid\" target=\"_new\">Zum Bericht</a>");
          $owndb->msg_event($t,"Ihr Planet wurde angegriffen.<br><a href=\"bericht.php5?id=$rid\" target=\"_new\">Zum Bericht</a>");
          $owndb->reinit();
        }
        if($bericht == "vt")
        {
          //Fleet destructed, set fleetid in report to -1 (anti BUGBUG)
          $owndb->query("UPDATE reports SET fleetid='-1' WHERE fleetid='".$row['fleetid']."';"); $owndb->err();
        }
        if(($now-$row['tback']) > 0)
        {
          //echo "Flotte war zurueck vor: ".($now-$row['tback'])." Sec<br>";
          if($bericht != "vt")
          { 
            $text = "Eine Flotte ist zurueckgekehrt.";
            if(isset($bericht['fe']))  //Bericht gerade erst gemacht, res nicht in $row
            {
              $row['loadres1'] = $bericht['fe'];
              $row['loadres2'] = $bericht['lut'];
              $row['loadres3'] = $bericht['h2o'];
              $row['loadres4'] = $bericht['h2'];
            }
    
            if($row['loadres1'] > 0 || $row['loadres2'] > 0 || $row['loadres3'] > 0 || $row['loadres4'] > 0)
            {
              $res['fe']  = $row['loadres1'];
              $res['lut'] = $row['loadres2'];
              $res['h2o'] = $row['loadres3'];
              $res['h2']  = $row['loadres4'];
              $owndb->res_add($f,$res);
              $text .= " Sie brachte folgende Rohstoffe mit:<br>";
              $text .= "Eisen: ".$res['fe']."<br>";
              $text .= "Luthrium: ".$res['lut']."<br>";
              $text .= "Wasser: ".$res['h2o']."<br>";
              $text .= "Wasserstoff: ".$res['h2']."<br>";
            }    
            $homefid = $owndb->get_fleetid($f);
            $owndb->query("UPDATE fleets SET fleetid='$homefid' WHERE fleetid='".$row["fleetid"]."';"); $owndb->err();
            /*$backlist = array();
            $ptr = 0;
            while($row3 = $owndb->fetch())
            {
                    $backlist[$ptr]['type'] = $row3['shiptype'];
                    $backlist[$ptr]['count'] = $row3['count'];
                    $ptr++;
            }*/
            $owndb->reinit();
            $owndb->msg_event($f,$text);
            $owndb->query("DELETE FROM transfer WHERE id = '".$row['id']."';"); $owndb->err();
          }
          $owndb->reinit();
          $owndb->query("DELETE FROM fleets WHERE fleetid='".$row['fleetid']."';"); $owndb->err();
          $owndb->query("UPDATE reports SET fleetid='-1' WHERE fleetid='".$row['fleetid']."';"); $owndb->err();
          
        }
      }
      //-----------------------TRANSPORT---------------------------------------------------------------------
      else if($row['option'] == 1)
      {
        if($row['processed']==0)
        {
          $res['fe'] = $row['loadres1'];
          $res['lut'] = $row['loadres2'];
          $res['h2o'] = $row['loadres3'];
          $res['h2'] = $row['loadres4'];
          $owndb->res_add($t,$res);
          $owndb->query("UPDATE transfer SET loadres1=0, loadres2=0, loadres3=0, loadres4=0, processed=1 WHERE id='".$row['id']."';");
          $owndb->err(); 
          
          $text  = "Eine Flotte transportiere Rohstoffe zu ihnen:";
          $text .= "<br>Eisen: ".$res['fe'];
          $text .= "<br>Luthrium: ".$res['lut'];
          $text .= "<br>Wasser: ".$res['h2o'];
          $text .= "<br>Wasserstoff: ".$res['h2'];
          $owndb->msg_event($t,$text);
          $owndb->msg_event($f,"Eine Flotte (Transport) ist an ihrem Ziel angekommen.");
        }
        if(($now-$row['tback']) > 0)
        {
          
          $homefid = $owndb->get_fleetid($f);
          //echo "DEBUG: homefid : $homefid<br>";
          $owndb->query("DELETE FROM transfer WHERE id = '".$row['id']."';"); $owndb->err();
          $owndb->query("UPDATE fleets SET fleetid='$homefid' WHERE fleetid='".$row["fleetid"]."';"); $owndb->err();
          $owndb->reinit();
          $owndb->msg_event($f,"Eine Flotte ist zurueckgekehrt.");
        }
      //$owndb->reinit();      
      }
      //------------------------KOLO-------------------------------------------------------------------------------
      else if($row['option'] == 2 && $row['processed'] == 0)
      {
        global $CONFIG;
        $owndb->reinit();
        if($owndb->planets_get_userid($tgal,$tsys,$tplan) != -1)
        {
          $owndb->query("DELETE FROM transfer WHERE id='".$row['id']."';"); $this->err();
          $owndb->msg_event($f,"Die Kolonisierung ist fehlgeschlagen, der Planet $tgal:$tsys:$tplan ist bereits besidelt!");
        }
        else
        {
          $owndb->reinit();
          $planet['gal'] = $tgal; $planet['sys'] = $tsys; $planet['plan'] = $tplan;
          $fuid = $owndb->planets_get_userid($fgal,$fsys,$fplan);
          $owndb->planets_owner($fuid,$tgal,$tsys,$tplan,"Planet");
          $res['fe'] = 500; $res['lut'] = 500; $res['h2o'] = 500; $res['h2'] = 0;
          $owndb->planets_res_set($planet,$res);
          $mod = $CONFIG["planets_info"]["max_dia"]-$CONFIG["planets_info"]["min_dia"];
          $add = $CONFIG["planets_info"]["min_dia"];
          $info['diameter'] = rand()%$mod+$add;
          $mod = $CONFIG["planets_info"]["min_temp"]-$CONFIG["planets_info"]["max_temp"];
          $add = $CONFIG["planets_info"]["min_temp"];
          $info['temp_lo'] = rand()%$mod+$add;
          $info['temp_hi'] = rand()%$mod+$add;
          if($info['temp_lo'] > $info['temp_hi'])
          {
            $tmp = $info['temp_hi'];
            $info['temp_hi'] = $info['temp_lo'];
            $info['temp_lo'] = $tmp;
            unset($tmp); 
          }
          $info['points'] = 0;
          $owndb->planets_info_set($planet,$info);
          $gal = $planet['gal'];
          $sys = $planet['sys'];
          $plan = $planet['plan'];
          $owndb->query("INSERT INTO planet_buildings SET gal=$tgal,sys=$tsys,plan=$tplan,buildid=1,level=1;"); $owndb->err();
          $owndb->query("DELETE FROM transfer WHERE id='".$row['id']."';"); $this->err();
          $owndb->msg_event($f,"Ein Neuer Planet wurde kolonisiert: $tgal:$tsys:$tplan Bitte loggen sie sich neu ein um ihn zu nutzen.");
        }
      }
    }
    $this->reinit();
    $query  = "DELETE FROM transfer WHERE ((toplan=$gal AND tosys=$sys AND toplan=$plan) OR";
    $query .= " (fromplan=$gal AND fromsys=$sys AND fromplan=$plan)) AND tback <= $now;";
    //echo "trying this: <b>$query</b>";
    $this->query($query); $this->err();
  }
  function transfer_list($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $now = time();
    $query  = "SELECT * FROM transfer WHERE ((togal=$gal AND tosys=$sys AND toplan=$plan) OR";
    $query .= "(fromgal=$gal AND fromsys=$sys AND fromplan=$plan));";
    $this->query($query); $this->err();
    $ret = array();
    $ptr = 0;
    while($row = $this->fetch())
    {
      
      //echo "<br>-----------NEW-FETCH---------<br>";
      //echo "print_r(\$row):<br>"; print_r($row); echo "<br>";
      $fgal = $row['fromgal']; $fsys = $row['fromsys']; $fplan = $row['fromplan'];
      $tgal = $row['togal']; $tsys = $row['tosys']; $tplan = $row['toplan'];
      //echo "$fgal:$fsys:$fplan -> $tgal:$tsys:$tplan (user: $gal:$sys:$plan)<br>";
      if($tsys == $sys && $tgal == $gal && $tplan == $plan)
      {
        
	//echo "Flotte-->User<br>";
        //Flotte fliegt zu User
        if($row['tthere'] > $now)
	{
	  //aha, flotte im anflug
	  if($row['option'] == 0)
	  {
	    //angriff
	    $ret[$ptr]['msg'] = "<font color='#FF0000'>Eine feindliche Flotte von $fgal:$fsys:$fplan befindet sich im Anflug</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
	  else if($row['option'] == 1)
	  {
	    //transport
	    $ret[$ptr]['msg'] = "<font color='#00FF00'>Eine Flotte von $fgal:$fsys:$fplan transportiert Rohstoffe zu ihnen</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
          else if($row['option'] == 2)
	  {
	    //transport
	    $ret[$ptr]['msg'] = "<font color='#FF00FF'>Eine Flotte von $fgal:$fsys:$fplan versucht ihren Planten zu kolonisieren (LOL?)</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
	  else
	  {
	    //transport
	    $ret[$ptr]['msg'] = "<font color='#00FF00'>Eine Flotte von $fgal:$fsys:$fplan fliegt an. Absicht unbekannt (ERROR: ".__LINE__." in ".__FILE__.")</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
	}
	else
	{
	  //flotte war da, nix machen...
	}
	
      }
      else if($fsys == $sys && $fgal == $gal && $fplan == $plan)
      {
        //echo "User-->Flotte<br>";
        //User fliegt zu Flotte *g*
	//Nene, Flotte fliegt von User weg :)
	
        //Flotte fliegt zu User
        if($row['tthere'] > $now)
	{
	  //aha, flotte im anflug
	  if($row['option'] == 0 && $row['tthere'] > $now)
	  {
	    //angriff
	    $ret[$ptr]['msg'] = "<font color='#FFFF00'>Ihre angreifende Flotte erreicht $tgal:$tsys:$tplan</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
	  else if($row['option'] == 1)
	  {
	    //transport
	    $ret[$ptr]['msg'] = "<font color='#00FF00'>Ihr Rohstofftransport erreicht $tgal:$tsys:$tplan</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
          else if($row['option'] == 2)
	  {
	    //transport
	    $ret[$ptr]['msg'] = "<font color='#00FF00'>Ihr Kolonisationskommando erreicht $tgal:$tsys:$tplan</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
	  else
	  {
	    //transport
	    $ret[$ptr]['msg'] = "<font color='#00FF00'>Eine Flotte erreicht $tgal:$tsys:$tplan. Absicht unbekannt (ERROR: ".__LINE__." in ".__FILE__.")</font>";
	    $ret[$ptr]['time'] = ($row['tthere']-$now);
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  }
	}
	else
	{
	  //flotte war da, rueckflug...
	  //Option egal
	  //transport
	  $ret[$ptr]['msg'] = "<font color='#00FF00'>Ihre Flotte kehrt zurueck von $tgal:$tsys:$tplan</font>";
	  $ret[$ptr]['time'] = ($row['tback']-$now);
	  if($ret[$ptr]['time']  >= 0)
	    $ret[$ptr]['str_time'] = $this->format_time($ret[$ptr]['time']);
	  else
	    $ret[$ptr]['str_time'] = "--";
	}
	      
      }
      $ptr++;
    }
    //print_r($ret);
    return $ret;
  }
  function fleetmenu_list($coords)
  {
    $gal  = $coords['gal'];
    $sys  = $coords['sys'];
    $plan = $coords['plan'];
    $now = time();
    $query  = "SELECT * FROM transfer WHERE fromgal=$gal AND fromsys=$sys AND fromplan=$plan;";
  //  echo "Query for <b>$query</b><br>";
    $this->query($query); $this->err();
    $ret = array();
    $ptr = 0;
    while($row = $this->fetch())
    {
      
      //echo "<br>-----------NEW-FETCH---------<br>";
      //echo "print_r(\$row):<br>"; print_r($row); echo "<br>";
      $fgal = $row['fromgal']; $fsys = $row['fromsys']; $fplan = $row['fromplan'];
      $tgal = $row['togal']; $tsys = $row['tosys']; $tplan = $row['toplan'];
      //echo "$fgal:$fsys:$fplan -> $tgal:$tsys:$tplan (user: $gal:$sys:$plan)<br>";
     if($fsys == $sys && $fgal == $gal && $fplan == $plan)
      {
        //echo "User-->Flotte<br>";
        //User fliegt zu Flotte *g*
	//Nene, Flotte fliegt von User weg :)
	
        //Flotte fliegt zu User
        if($row['tthere'] > $now)
	{
	  //aha, flotte im anflug
	  if($row['option'] == 0 && $row['tthere'] > $now)
	  {
	    //angriff
	    $ret[$ptr]['str_typ'] = "Angriff auf $tgal:$tsys:$tplan";

	  }
	  else if($row['option'] == 1)
	  {
	    //transport
	    $ret[$ptr]['str_typ'] = "Rohstofftransport";

	  }
          else if($row['option'] == 2)
	  {
	    //transport
	    $ret[$ptr]['str_typ'] = "Kolonisation";

	  }
	  else
	  {
	    //transport
	    $ret[$ptr]['str_typ'] = "Unbekannt (Ist ein BUG! Bitte melden!)";
	  }
	  
	}
	else
	{
	  $ret[$ptr]['str_typ'] = "Rueckkehr";
	}
	$ret[$ptr]['str_typ'] .= "<br>(FID: ".$row['fleetid']."/ID: ".$row['id'].")";
	$ret[$ptr]['str_from'] = "$fgal:$fsys:$fplan";
	$ret[$ptr]['str_to'] = "$tgal:$tsys:$tplan";
	$ret[$ptr]['str_tstart'] = date("D, j.n.Y - H:i:s",$row['tstart']);
	$ret[$ptr]['str_tthere'] = date("D, j.n.Y - H:i:s",$row['tthere']);
	      
      }
      $ptr++;
    }
    //print_r($ret);
    return $ret;
  }
  function has_report($fid)
  {
    $this->query("SELECT * FROM reports WHERE fleetid='$fid';");
    $this->err();
 //   echo "<b>DEBUG:</b> Teste ob Flotte mit der ID $fid einen Bericht hat...";
    if($this->numrows() <=0)
    {
   //   echo "nein<br>";
      return false;
    }
    else
    {
   //   echo "ja<br>";
      return true;
    }
  }
  function get_agvt($fid)
  {
    //1/(pow(1.8,(-$x)))
    //echo "<br>";
    $ag=0;$vt=0; $load=0;
    $spys = 0;
    $this->query("SELECT * FROM fleets WHERE fleetid = '$fid';"); $this->err();
    $owndb = new cl_extended_database;
    while($row = $this->fetch())
    {
      $shipid = $row['shiptype'];
      if($shipid == 103) // sonde
        $spys += $row['count'];
      $sel = $owndb->ships_select($shipid);
      $ag += $sel['ag']*$row['count'];
      $vt += $sel['vt']*$row['count'];
      $load += $sel['load']*$row['count'];
    }
   // echo "<b>DEBUG:</b> AG: $ag, VT: $vt (for fid: $fid)<br>";
    //number_format(,2,',','.');
    $ret['ag'] = $ag; $ret['vt'] = $vt; $ret['load'] = $load;
    $ret['spys'] = $spys;
  //  return $this->sim_stderg();
  return $ret;
  }
  function get_agvt_tr($fid)
  {
    //1/(pow(1.8,(-$x)))
    //echo "<br>";
    $ag=0;$vt=0; $load=0;
    $spys = 0;
    $this->query("SELECT * FROM fleets_tr WHERE fleetid = '$fid';"); $this->err();
    $owndb = new cl_extended_database;
    while($row = $this->fetch())
    {
      $shipid = $row['shiptype'];
 //     if($shipid == 103) // sonde  FIXME: Same for EMP
 //       $spys += $row['count'];
      $sel = $owndb->towers_select($shipid);
      $ag += $sel['ag']*$row['count'];
      $vt += $sel['vt']*$row['count'];
      //$load += $sel['load']*$row['count'];
    }
   // echo "<b>DEBUG:</b> AG: $ag, VT: $vt (for fid: $fid)<br>";
    //number_format(,2,',','.');
    $ret['ag'] = $ag; $ret['vt'] = $vt; $ret['load'] = $load;
    $ret['spys'] = $spys;
  //  return $this->sim_stderg();
  return $ret;
  }
  function fleet_put_res($fid,$res)
  {
    $fe  = $res['fe'];
    $lut = $res['lut'];
    $h2o = $res['h2o'];
    $h2  = $res['h2'];
    $query = "UPDATE transfer SET loadres1='$fe', loadres2='$lut', loadres3='$h2o', loadres4='$h2' WHERE fleetid='$fid';";
    $this->query($query); $this->err();
  }
  function create_report($fid,$fcoords=-1,$tcoords=-1)
  {
    //
    if($fcoords==-1 || $tcoords==-1)
    {
      echo "ARGH! Ich bin ein Bug, bitte melde mich! (".__LINE__." in ".__FILE__.") <br>";    
    }
    //1st get {ag,vt}_{a,v}
    $tgal  = $tcoords['gal'];
    $tsys  = $tcoords['sys'];
    $tplan = $tcoords['plan'];
    
    $fgal  = $fcoords['gal'];
    $fsys  = $fcoords['sys'];
    $fplan = $fcoords['plan'];
    
    //1.1 deffer
    $this->reinit();
    $tofid = $this->get_fleetid($tcoords);
  //  echo "<b>DEBUG:</b> Tofleetid: $tofid<br>"; 
    $vt_all = $this->get_agvt($tofid);
    $this->reinit();
    $vt_all_tr = $this->get_agvt_tr($tofid);
    $vt_a = $vt_all['ag']+$vt_all_tr['ag']+250; //FIXME: insert values from config.inc.php here...
    $vt_v = $vt_all['vt']+$vt_all_tr['vt']+500;
    
 //   echo "<b>DEBUG:</b> Deffer->AG: $vt_a ->VT: $vt_v<br>";
    //1.2 attacker
    $fromfid = $fid;
//    echo "<b>DEBUG:</b> Fromfleetid: $fromfid<br>"; 
    $this->reinit();
    $ag_all = $this->get_agvt($fromfid);
    $ag_a = $ag_all['ag'];
    $ag_v = $ag_all['vt'];
    //echo "<b>DEBUG:</b> Atacker->AG: $ag_a ->VT: $ag_v<br>";
    //2nd Calc
    $c_ag = $this->ks_formula($ag_a,$ag_v,$vt_a,$vt_v);
    //echo "<b>DEBUG:</b> Atacker->AG: $ag_a ->VT: $ag_v<br>";
    $ct = floor(100*$c_ag); //A number between 0-10000
    $rand = rand()%10000;
    //echo "C: $ct Rand: $rand<br>";
    $winner = -1;
    if($ct > $rand)
    {
     // echo "DEBUG: AG wins!<br>";
      $winner = "ag";
    }
    else
    {
      //echo "DEBUG: VT wins!<br>";
      $winner = "vt";
    }
    $spy_ok = 0;
    if($ag_all['spys'] > 0)
    {
      $c_spio = $this->spy_formula($vt_a,$vt_v,$ag_all['spys']);
      //echo "<b>DEBUG:</b> Sonden:".$ag_all['spys']." c_spio: $c_spio<br>";
      $cs = floor(100*$c_spio); //A number between 0-10000
      $rand = rand()%10000;
     // echo "C_spio: $cs Rand: $rand<br>";
      if($cs > $rand)
      {
       // echo "DEBUG: AG wins!<br>";
        //echo "spy ok!<br>";
        $spy_ok = 1;
      }
    }
    $this->reinit();
    //3rd Get ships of atacker and deffer
    //3.1 attacker
    $ships_a = $this->ship_fleet_list($fromfid);
    if($ships_a == -1)
    {
      echo "Hmmm... Atacker has no Ships?! -> Must be a BUG!!! Look at Line: ".__LINE__." File: [top secret]/mysql.inc.php5 <br>";
    }
    $this->reinit();
    //3.2 deffer
    $ships_v = $this->ship_fleet_list($tofid);
    $this->reinit();
    $towers_v = $this->tower_fleet_list($tofid);
    
    //calc lost ships (FIXME: implement this!)
       
    //FIXME: 4th if atacker has noch ships -> end
    $raided = array();
    //else calc raided res and put into loadres[1-4]
    $tores = $this->planets_res($tcoords);
    if($winner == "ag")
    {
      $this->res_refresh($tcoords); //We want to raid new res, even if farm is offline
      $load = $ag_all['load'];
    //  echo "Ladekapazitaet: $load<br>";
      
      //FIXME: priority
      if($load > 0)
      {
        $raided['fe']  = min($load,$tores['fe']);
	$load -= $raided['fe'];
      }
      else
      {
        $raided['fe'] = 0;
      }
      if($load > 0)
      {
        $raided['lut'] = min($load,$tores['lut']);
        $load -= $tores['lut'];
      }
      else
      {
        $raided['lut'] = 0;
      }
      if($load > 0)
      {
        $raided['h2']  = min($load,$tores['h2']);
        $load -= $tores['h2'];
      }
      else
      {
        $raided['h2'] = 0;
      }
      if($load > 0)
      {
        $raided['h2o'] = min($load,$tores['h2o']);
        $load -= $tores['h2o'];
      }
      else
      {
        $raided['h2o'] = 0;
      }
//      echo "raided!:<br>";
      $raided['fe']  = floor($raided['fe']);
      $raided['lut'] = floor($raided['lut']);
      $raided['h2o'] = floor($raided['h2o']);
      $raided['h2']  = floor($raided['h2']);
 /*     echo "FE: ".$raided['fe']."<br>";
      echo "LUT: ".$raided['lut']."<br>";
      echo "H2O: ".$raided['h2o']."<br>";
      echo "H2: ".$raided['h2']."<br>";
  */  $tores['fe']  -=$raided['fe']; //Spy report uses $tores['x'], this makes correct values
      $tores['lut'] -=$raided['lut'];
      $tores['h2o'] -=$raided['h2o'];
      $tores['h2']  -=$raided['h2'];
      $this->fleet_put_res($fid,$raided);
      $nraided = $this->var_res_negate($raided);
      $this->res_add($tcoords,$nraided);      
    }
    
    //FIXME: Put Spy and Recycler in here
    //5th put report into database 
    $time = time();
    $tcoords = "$tgal:$tsys:$tplan";
    $fcoords = "$fgal:$fsys:$fplan";
    $str_ships_a = "";
    $str_ships_v = "";
    $str_towers_v = "";
    if($winner == "ag")
    {
      if($ships_a != -1)
      foreach($ships_a as $ship)
      {
        $str_ships_a .= $ship['type']."!".$ship['count']."!".(0)."%"; //FIXME: Put destructed ships in here!
      }
      if($ships_v != -1)
      foreach($ships_v as $ship)
      {
        $str_ships_v .= $ship['type']."!".$ship['count']."!".$ship['count']."%"; //FIXME: Put destructed ships in here!
      }
      if($towers_v != -1)
      foreach($towers_v as $ship)
      {
        $str_towers_v .= $ship['type']."!".$ship['count']."!".$ship['count']."%"; //FIXME: Put destructed towers in here
      }   
    }
    else if($winner == "vt")
    {
      if($ships_a != -1)
      foreach($ships_a as $ship)
      {
        $str_ships_a .= $ship['type']."!".$ship['count']."!".$ship['count']."%"; //FIXME: Put destructed ships in here!
      }
      if($ships_v != -1)
      foreach($ships_v as $ship)
      {
        $str_ships_v .= $ship['type']."!".$ship['count']."!".(0)."%"; //FIXME: Put destructed ships in here!
      }
      if($towers_v != -1)
      foreach($towers_v as $ship)
      {
        $str_towers_v .= $ship['type']."!".$ship['count']."!".(0)."%"; //FIXME: Put destructed towers in here
      }    
    }
    $spy = $spy_ok;
    $str_res_raided = "none";
    if($winner == "ag")
    {
      $str_res_raided = $raided['fe']."x".$raided['lut']."x".$raided['h2o']."x".$raided['h2'];
    }
    $res_recycled = "none"; //FIXME
    $res_spy = "";
    $buildings = "";
    $sci = "";
    if($spy == 1)
    {
      
      $res_spy = floor($tores['fe'])."x".floor($tores['lut'])."x".floor($tores['h2o'])."x".floor($tores['h2']);
 //     echo "selecte buildinbgs von $tgal:$tsys:$tplan<br>";
      $this->query("SELECT * FROM planet_buildings WHERE gal=$tgal AND sys=$tsys AND plan=$tplan;"); $this->err();
      
      while($row = $this->fetch())
      {
        $buildings .= $row['buildid']."!".$row['level']."%";
    //    echo "found: $buildings<br>";
      }
      $tuid = $this->planets_get_userid($tgal,$tsys,$tplan);
  //    echo "selecte sci mit uid = $tuid...<br>";
      $this->query("SELECT * FROM user_sci WHERE userid='$tuid';"); $this->err();
      
      while($row = $this->fetch())
      {
        $sci .= $row['sciid']."!".$row['level']."%";
      //  echo "found '$sci'...<br>";
      }
    }
    $bfid = $fid;
/*    if($winner == "vt")
    {
      $bfid = -1;
    }
    */ //do this in transfer_refresh! da wird nach fid selected, wenn die -1 ist wird nichts gefunden -> kaputter berichtlink ;(
    $query  = "INSERT INTO reports SET time = '$time', tcoords = '$tcoords', fcoords = '$fcoords',";
    $query .= " ships_a = '$str_ships_a', ships_v = '$str_ships_v', towers_v = '$str_towers_v', spy = '$spy', res_raided = '$str_res_raided',";
    $query .= " res_recycled = '$res_recycled', res_spy = '$res_spy', fleetid='$bfid', buildings='$buildings', sci='$sci';";
 //   echo "Query fuer report: '$query'<br>";
    $this->query($query); $this->err();
    //Destruct Ships of Looser. Destruct a few ships of winner (unimplemented! FIXME)
    if($winner == "vt")
    {
      $this->delete_fleet($fromfid);
      $this->delete_transfer($fid);
      return "vt";
    }
    if($winner == "ag")
    {
      $this->delete_fleet($tofid);
      $this->delete_fleet_tr($tofid);
      return $raided;
    }
    
  }
  function planet_count($uid)
  {
    $this->query("SELECT * FROM planets WHERE userid='$uid';"); $this->err();
    return $this->numrows();
  }
  function planet_list($uid,$c)
  {
    $this->query("SELECT * FROM planets WHERE userid='$uid';"); $this->err();
    $ret = array();
    $ptr = 0;
    while($row = $this->fetch())
    {
      $ret[$ptr]['gal'] = $row['gal'];
      $ret[$ptr]['sys'] = $row['sys'];
      $ret[$ptr]['plan'] = $row['plan'];
      $ret[$ptr]['pname'] = $row['pname'];
      if($row['gal'] == $c['gal'] && $row['sys'] == $c['sys'] && $row['plan'] == $c['plan'])
        $ret[$ptr]['sel'] = " selected";
      else
        $ret[$ptr]['sel'] = ""; 
      $ptr++;
    }
    return $ret;
  }
  function fleet_table_optimize($fid)
  {
    $this->query("DELETE FROM fleets WHERE `count`='0';"); $this->err();
    $this->query("SELECT shiptype,SUM(`count`) AS `sum_count` FROM fleets WHERE fleetid='$fid' GROUP BY shiptype;");
    $this->err();
    $owndb = new cl_extended_database;
    while($row = $this->fetch())
    {
      $owndb->query("DELETE FROM fleets WHERE fleetid='$fid' AND shiptype='".$row['shiptype']."';");
      $owndb->err();
      $owndb->query("INSERT INTO fleets SET fleetid='$fid', shiptype='".$row['shiptype']."', `count`='".$row['sum_count']."';");
    }
  }
  function ally_found($tag,$name,$fuid) //fuid = _F_ounder _U_ser _ID_
  {
    $this->query("INSERT INTO allys SET name='$name', `tag`='$tag', `desc`='', `url`='', `score`='0', `memberc`='1'");
    $this->err();
    $alid = mysql_insert_id(); //Last auto_increment value
    $this->query("INSERT INTO ally_members SET userid='$fuid',allyid='$alid',rank='0'"); //rank 0 = admin
    $this->err();
  }
  function ally_member_of($uid)
  {
    $this->query("SELECT * FROM ally_members WHERE userid='$uid';");
    if($this->numrows() <= 0)
      return -1;
    $row = $this->fetch();
    return $row['allyid'];
  }
  function ally_select($alid)
  {
    $this->query("SELECT * FROM allys WHERE id='$alid'");
    if($this->numrows() <=0)
      return -1;
    $r = $this->fetch();
    $r['memberc'] = $this->ally_member_count($alid);
    return $r;
  }
  function ally_get_rank($alid,$uid)
  {
    $this->query("SELECT * FROM ally_members WHERE userid='$uid' AND allyid='$alid';");
    if($this->numrows() <= 0)
      return -1;
    $row = $this->fetch();
    return $row['rank'];
  }
  function ally_get_tag($alid)
  {
    $this->query("SELECT tag FROM allys WHERE id='$alid'"); $this->err();
    $r = $this->fetch();
    return $r['tag'];
  }
  function ally_setdesc($allyid,$desc)
  {
    $this->query("UPDATE allys SET `desc`='$desc' WHERE id='$allyid'"); $this->err();  
  }
  function ally_seturl($allyid,$url)
  {
    $this->query("UPDATE allys SET url='$url' WHERE id='$allyid'"); $this->err();  
  }
  function ally_del($alid)
  {
    $this->query("DELETE FROM ally_members WHERE allyid='$alid'"); $this->err();
    $this->query("DELETE from allys WHERE id='$alid';"); $this->err();
  }
  function ally_leave($alid,$uid)
  {
    $this->query("DELETE FROM ally_members WHERE allyid='$alid' AND userid='$uid'");
    $this->err();
  }
  function ally_app($alid,$uid,$text)
  {
    $this->query("INSERT INTO ally_app SET allyid='$alid', userid='$uid', txt='$text';");
    $this->err();
  }
  function ally_new_apps($alid)
  {
    $this->query("SELECT * FROM ally_app WHERE allyid='$alid';");
    $this->err();
    if($this->numrows() <= 0)
      return 0;
    return 1;
  }
  function ally_app_list($alid)
  {
    $this->query("SELECT * FROM ally_app WHERE allyid='$alid';");
    $this->err();
    $ret = array();
    $ptr = 0;
    $owndb = new cl_extended_database;
    while($row = $this->fetch())
    {
      $ret[$ptr]['name'] = $owndb->user_get_name($row['userid']);
      $ret[$ptr]['userid'] = $row['userid'];
      $ret[$ptr]['text'] = $row['txt'];
      $ptr++;
    }
    return $ret;
  }
  function ally_join($alid,$uid)
  {
    $this->msg_event_uid($uid,"Ihre Bewerbung wurde angenommen.");
    $this->query("INSERT INTO ally_members SET allyid='$alid', userid='$uid', rank='1';");
    $this->query("DELETE FROM ally_app WHERE userid='$uid';");
    $this->err();
  }
  function ally_dont_join($alid,$uid)
  {
    $this->msg_event_uid($uid,"Ihre Bewerbung wurde abgelehnt.");
    $this->query("DELETE FROM ally_app WHERE userid='$uid' AND allyid='$alid';");
    $this->err();
  }
  function search_user($uname)
  {
    $this->query("SELECT * FROM users WHERE user LIKE '%$uname%'"); $this->err();
    $ret = array();
    $ptr = 0;
    if($this->numrows() <=0)
      return -1;
    while($row = $this->fetch())
    {
      $ret[$ptr]['name'] = $row['user'];
      $ret[$ptr]['score'] = $row['score_sci'];
      $ptr++;
    }
    return $ret;
  }
  function ally_member_count($alid)
  {
    $this->query("SELECT * FROM ally_members WHERE allyid='$alid';");
    $this->err();
    return $this->numrows();
  }
};
?>
