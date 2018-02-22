Drop Table sale_detail;
Drop Table sale_head;

ALTER TABLE `travel_agenci`.`customer` 
CHANGE COLUMN `client_key` `customer_key` INT(11) NOT NULL ;

CREATE TABLE `sale_head` (
  `sale_head_key` int(11) NOT NULL,
  `customer_key` int(11) NOT NULL,
  `travel_key` int(11) NOT NULL,
  `date_register` datetime NOT NULL,
  `last_modify` datetime NOT NULL,
  `tipo_abono` varchar(45) DEFAULT NULL,
  `user_key` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `coments` varchar(500) DEFAULT NULL,
  `millas` int(11) DEFAULT NULL,
  `folio` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`sale_head_key`),
  KEY `fk_sale_head_customer1_idx` (`customer_key`),
  KEY `fk_sale_head_travel1_idx` (`travel_key`),
  KEY `fk_sale_head_user1_idx` (`user_key`),
  CONSTRAINT `fk_sale_head_customer1` FOREIGN KEY (`customer_key`) REFERENCES `customer` (`customer_key`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_head_travel1` FOREIGN KEY (`travel_key`) REFERENCES `travel` (`travel_key`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_head_user1` FOREIGN KEY (`user_key`) REFERENCES `user` (`user_key`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `sale_detail` (
  `sale_detail_key` int(11) NOT NULL,
  `sale_head_key` int(11) NOT NULL,
  `adulto` varchar(1) NOT NULL,
  `menor` varchar(1) NOT NULL,
  `infante` varchar(1) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `date_register` datetime NOT NULL,
  `last_modify` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `bus_place_col` varchar(10) DEFAULT NULL,
  `bus_place_row` varchar(10) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`sale_detail_key`),
  KEY `fk_sale_detail_sale_head1_idx` (`sale_head_key`),
  CONSTRAINT `fk_sale_detail_sale_head1` FOREIGN KEY (`sale_head_key`) REFERENCES `sale_head` (`sale_head_key`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `travel_agenci`.`customer` 
CHANGE COLUMN `registration_key` `last_modify` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `travel_agenci`.`customer` 
CHANGE COLUMN `customer_key` `customer_key` INT(11) NOT NULL AUTO_INCREMENT ;
