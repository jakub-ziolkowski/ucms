SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `template` varchar(64) NOT NULL,
  `html` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `content` (`id`, `title`, `template`, `html`) VALUES
(1, 'HomePage', 'MainTemplate.html', 'HOME PAGE CONTENT'),
(2, 'AboutPage', 'MainTemplate.html', 'ABOUT PAGE CONTENT');

CREATE TABLE `registry` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `router` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `requestMask` varchar(64) NOT NULL,
  `controllerClass` varchar(64) NOT NULL,
  `params` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `router` (`id`, `title`, `requestMask`, `controllerClass`, `params`) VALUES
(1, 'Main page', '', 'Content/ContentController', '{"page_id":1}'),
(2, 'About', 'about', 'Content/ContentController', '{"page_id":2}'),
(3, 'Contact', 'contact', 'Contact/EmailFormController', '{"email": \'admin@localhost\'}');

ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `registry`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `router`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `router`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
