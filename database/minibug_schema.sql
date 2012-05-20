DROP TABLE IF EXISTS `bug_status_history`;
DROP TABLE IF EXISTS `bugs`;
DROP TABLE IF EXISTS `bug_status`;

--
-- Table structure for table `bug_status`
--

CREATE TABLE `bug_status` (
  `status` varchar(64) NOT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `bugs`
--

DROP TABLE IF EXISTS `bugs`;
CREATE TABLE `bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text,
  `status` varchar(64) CHARACTER SET latin1 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `name` (`name`(255)),
  KEY `created` (`created`),
  CONSTRAINT `bugs_ibfk_1` FOREIGN KEY (`status`) REFERENCES `bug_status` (`status`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Table structure for table `bug_status_history`
--

DROP TABLE IF EXISTS `bug_status_history`;
CREATE TABLE `bug_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bug_id` int(11) NOT NULL,
  `new_status` varchar(64) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `new_status` (`new_status`),
  KEY `bug_id` (`bug_id`),
  KEY `changed` (`changed`),
  CONSTRAINT `bug_status_history_ibfk_1` FOREIGN KEY (`new_status`) REFERENCES `bug_status` (`status`) ON UPDATE CASCADE,
  CONSTRAINT `bug_status_history_ibfk_2` FOREIGN KEY (`bug_id`) REFERENCES `bugs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

DELIMITER $$
CREATE TRIGGER update_bug_status_hist_ins AFTER INSERT ON bugs 
FOR EACH ROW 
	INSERT INTO bug_status_history (bug_id,new_status) VALUES (NEW.id, NEW.status); $$

CREATE TRIGGER update_bug_status_hist_upd BEFORE UPDATE ON bugs 
FOR EACH ROW 
BEGIN 
	IF OLD.status != NEW.status THEN 
		INSERT INTO bug_status_history (bug_id,new_status) VALUES (NEW.id, NEW.status);
	END IF;
END $$
DELIMITER ;
