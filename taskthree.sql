CREATE TABLE IF NOT EXISTS `insly_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `ssn` varchar(32) NOT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `insly_employees` (`id`, `first_name`, `last_name`, `birthday`, `ssn`, `is_current`, `email`, `phone`, `address`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Anselm', 'Mba', '1984-06-06', '123-45-6789', 1, 'anselmmba@insly.com', '+0123456789', '33 Bode Thomas, Lagos, Nigeria', 'Anselm', '2020-07-10 10:35:02', 'Anselm', '2020-07-10 11:38:23');

CREATE TABLE IF NOT EXISTS `insly_employee_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL DEFAULT '1',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `info_type_id` int(11) NOT NULL DEFAULT '1',
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `language_id` (`language_id`),
  KEY `info_type_id` (`info_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

INSERT INTO `insly_employee_info` (`id`, `employee_id`, `language_id`, `info_type_id`, `text`) VALUES
(1, 1, 1, 1, 'Introduction'),
(2, 1, 3, 1, 'Introduction'),
(3, 1, 2, 1, 'Introducción'),
(4, 1, 1, 2, 'Previous work experience'),
(5, 1, 2, 2, 'Experiencia de trabajo previa'),
(6, 1, 3, 2, 'Précédente expérience professionnelle'),
(7, 1, 1, 3, 'Education information'),
(8, 1, 2, 3, 'Información sobre Educación'),
(9, 1, 3, 3, 'Informations sur l''éducation');

CREATE TABLE IF NOT EXISTS `insly_info_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `insly_info_type` (`id`, `title`) VALUES
(1, 'Introduction'),
(2, 'Previous work experience'),
(3, 'Education information');

CREATE TABLE IF NOT EXISTS `insly_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) CHARACTER SET latin1 NOT NULL,
  `code` varchar(4) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `insly_languages` (`id`, `title`, `code`) VALUES
(1, 'English', 'en'),
(2, 'Spanish', 'es'),
(3, 'French', 'fr');

ALTER TABLE `insly_employee_info`
  ADD CONSTRAINT `insly_employee_info_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `insly_employees` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `insly_employee_info_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `insly_languages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `insly_employee_info_ibfk_5` FOREIGN KEY (`info_type_id`) REFERENCES `insly_info_type` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;