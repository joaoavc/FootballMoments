CREATE TABLE `fm`.`images-config` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `destination` VARCHAR( 1024 ) NOT NULL,
  `maxFileSize` INT NOT NULL,
  `thumbType` VARCHAR(8) NOT NULL,
  `thumbWidth` INT NOT NULL,
  `thumbHeight` INT NOT NULL,
  `numColls` INT NOT NULL,
  `cellspacing` INT NOT NULL,
  PRIMARY KEY ( `id` )  
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `fm`.`images-details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fileName` VARCHAR( 1024 ) NOT NULL,
  `mimeFileName` VARCHAR( 32 ) NOT NULL,
  `typeFileName` VARCHAR( 16 ) NOT NULL,
  `imageFileName` VARCHAR( 1024 ) NOT NULL,
  `imageMimeFileName` VARCHAR( 32 ) NOT NULL,
  `imageTypeFileName` VARCHAR( 16 ) NOT NULL,
  `thumbFileName` VARCHAR( 1024 ) NOT NULL,
  `thumbMimeFileName` VARCHAR( 32 ) NOT NULL,
  `thumbTypeFileName` VARCHAR( 16 ) NOT NULL,
  `latitude` VARCHAR( 32 ) NOT NULL,
  `longitude` VARCHAR( 32 ) NOT NULL,
  `title` VARCHAR( 32 ) NOT NULL,
  `description` VARCHAR( 512 ) NOT NULL,
  `private` tinyint(4) NOT NULL,
  `idUser`	int(11)	 NOT NULL,
   FOREIGN KEY ( `idUser` ) REFERENCES `fm`.`auth-basic` (`idUser`),
  PRIMARY KEY ( `id` ) 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `fm`.`images-counters` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `counterValue` INT NOT NULL,
  PRIMARY KEY ( `id` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO `fm`.`images-config`
	(`destination`, `maxFileSize`, `thumbType`, `thumbWidth`, `thumbHeight`, `numColls`, `cellspacing`) VALUES 
	('upload', '52428800', 'png', '80', '80', '3', '10' );

INSERT INTO `fm`.`images-counters` ( `counterValue` ) VALUES ( '0' );

