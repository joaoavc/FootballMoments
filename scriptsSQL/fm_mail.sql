CREATE TABLE `fm`.`email-accounts` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`accountName` VARCHAR( 32 ) NOT NULL ,
	`smtpServer` VARCHAR( 32 ) NOT NULL ,
	`port` INT NOT NULL ,
	`useSSL` TINYINT NOT NULL ,
	`timeout` INT NOT NULL ,
	`loginName` VARCHAR( 128 ) NOT NULL ,
	`password` VARCHAR( 128 ) NOT NULL ,
	`email` VARCHAR( 128 ) NOT NULL ,
	`displayName` VARCHAR( 128 ) NOT NULL ,
	PRIMARY KEY ( `id` ) 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;



INSERT INTO `fm`.`email-accounts`
	(`accountName`, `smtpServer`, `port`, `useSSL`, `timeout`, `loginName`, `password`, `email`, `displayName`) values
	('Gmail - FM', 'smtp.gmail.com', '465', '1', '30', 'football.moments.isel@gmail.com', 'kegwzqcbwaujiyil', 'football.moments.isel@gmail.com', 'Football Manager');

