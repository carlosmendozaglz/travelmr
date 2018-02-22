ALTER TABLE `travel_agenci`.`travel` 
CHANGE COLUMN `fecha_salida` `date_departure` DATE NOT NULL ,
CHANGE COLUMN `hora_salida` `date_return` TIME NOT NULL ,
CHANGE COLUMN `fecha_regreso` `time_departure` DATE NOT NULL ,
CHANGE COLUMN `hora_regreso` `time_return` TIME NOT NULL ,
CHANGE COLUMN `precio_adulto` `adult_price` DOUBLE NOT NULL ,
CHANGE COLUMN `precio_menor` `minor_price` DOUBLE NOT NULL ,
CHANGE COLUMN `precio_infante` `infant-price` DOUBLE NOT NULL ,
CHANGE COLUMN `notes` `coments` VARCHAR(500) NULL DEFAULT NULL ,
CHANGE COLUMN `porcentaje_adelanto` `percent` DOUBLE NULL DEFAULT NULL ,
CHANGE COLUMN `coments` `notes` VARCHAR(400) NULL DEFAULT NULL ,
CHANGE COLUMN `millas` `miles` INT(11) NOT NULL ,
CHANGE COLUMN `clave` `key` VARCHAR(45) NOT NULL ;

ALTER TABLE `travel` ADD `location` VARCHAR(60) NOT NULL AFTER `travel_key`;
ALTER TABLE `travel_agenci`.`travel` 
CHANGE COLUMN `infant-price` `infant_price` DOUBLE NOT NULL ;

ALTER TABLE `travel_agenci`.`travel` 
CHANGE COLUMN `date_return` `date_return` DATE NOT NULL ,
CHANGE COLUMN `time_departure` `time_departure` TIME NOT NULL ;
