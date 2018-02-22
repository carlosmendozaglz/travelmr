ALTER TABLE `travel_agenci`.`airline` 
CHANGE COLUMN `name` `airline_name` VARCHAR(45) NOT NULL ;
ALTER TABLE `travel_agenci`.`airline` 
CHANGE COLUMN `description` `airline_description` VARCHAR(400) NOT NULL ;


ALTER TABLE `travel_agenci`.`client` 
RENAME TO  `travel_agenci`.`customer` ;

