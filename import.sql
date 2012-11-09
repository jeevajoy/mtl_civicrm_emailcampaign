
CREATE TABLE IF NOT EXISTS `mtl_civicrm_emailcampaign_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `activity_type_1` int(11) NOT NULL,
  `activity_type_2` int(11) NOT NULL,
  `activity_type_3` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  ;
