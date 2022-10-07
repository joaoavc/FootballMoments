#
# Run command /opt/lampp/bin/mysql_upgrade
#
# Before running this script
#

SET GLOBAL event_scheduler = 1;

CREATE EVENT IF NOT EXISTS `fm`.`cleanAccounts`
ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 DAY
ON COMPLETION PRESERVE
DO
	DELETE `fm`.`auth-basic`, `fm`.`auth-challenge` FROM `fm`.`auth-basic` INNER JOIN `fm`.`auth-challenge` ON `fm`.`auth-basic`.`iduser` = `fm`.`auth-challenge`.`idUser` WHERE `fm`.`auth-basic`.`active`=0 AND DATE_ADD( `fm`.`auth-challenge`.`registerDate`, INTERVAL 2 DAY) < NOW();


SHOW PROCESSLIST;
