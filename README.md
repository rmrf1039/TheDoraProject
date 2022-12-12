# TheDoraProject

Users SQL:
CREATE TABLE `users` (
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

Blogs SQL:
CREATE TABLE `blogs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `cover_img` varchar(255) NOT NULL DEFAULT '',
  `tag_color` char(10) NOT NULL DEFAULT '',
  `sections` longtext DEFAULT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
