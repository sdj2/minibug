GRANT USAGE ON *.* TO 'minibug'@'localhost' IDENTIFIED BY 'TgsuRFPrbjxfCD3u';
GRANT SELECT ON `minibug`.`bug_status` TO 'minibug'@'localhost';
GRANT SELECT, INSERT, UPDATE ON `minibug`.`bugs` TO 'minibug'@'localhost';
GRANT SELECT ON `minibug`.`bug_status_history` TO 'minibug'@'localhost';
