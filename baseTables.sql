SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `date`, `ip`) VALUES
(1, 'tester', 'test@testing.org', 'test', '2017-09-26 09:54:47', '127.0.0.1');

CREATE TABLE `html` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `html` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `html` (`id`, `title`, `html`) VALUES
(1, 'HomePage', '<div class="content">\n  <h1>HOME PAGE</h1>\n</div>'),
(2, 'AboutPage', '<div class="content">\n  <h1>ABOUT PAGE</h1>\n</div>'),
(3, 'Contact form', '<div class="content">\n  <h1>Napisz do nas</h1>\n  ${formMessages}\n  ${formHTML}\n</div>\n');

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
(3, 'Contact', 'contact', 'Contact/ContactController', '{"email":"admin@localhost", "page_id":3}');

ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `html`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `registry`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `router`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `html`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `registry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `router`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;