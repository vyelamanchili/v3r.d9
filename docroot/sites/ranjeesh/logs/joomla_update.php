#
#<?php die('Forbidden.'); ?>
#Date: 2016-08-10 18:49:37 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2016-08-10T18:49:37+00:00	INFO 164.82.32.13	update	Update started by user Super User (10). Old version is 3.4.8.
2016-08-10T18:49:38+00:00	INFO 164.82.32.13	update	Downloading update file from https://github.com/joomla/joomla-cms/releases/download/3.6.0/Joomla_3.6.0-Stable-Update_Package.zip.
2016-08-10T18:49:38+00:00	INFO 164.82.32.13	update	File Joomla_3.6.0-Stable-Update_Package.zip successfully downloaded.
2016-08-10T18:49:38+00:00	INFO 164.82.32.13	update	Starting installation of new version.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Finalising installation.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-07-01. Query text: ALTER TABLE `#__session` MODIFY `session_id` varchar(191) NOT NULL DEFAULT '';.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-07-01. Query text: ALTER TABLE `#__user_keys` MODIFY `series` varchar(191) NOT NULL;.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-10-13. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-10-26. Query text: ALTER TABLE `#__contentitem_tag_map` DROP INDEX `idx_tag`;.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-10-26. Query text: ALTER TABLE `#__contentitem_tag_map` DROP INDEX `idx_type`;.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-10-30. Query text: UPDATE `#__menu` SET `title` = 'com_contact_contacts' WHERE `client_id` = 1 AND .
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-11-04. Query text: DELETE FROM `#__menu` WHERE `title` = 'com_messages_read' AND `client_id` = 1;.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-11-04. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-11-05. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2015-11-05. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2016-02-26. Query text: CREATE TABLE IF NOT EXISTS `#__utf8_conversion` (   `converted` tinyint(4) NOT N.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2016-02-26. Query text: INSERT INTO `#__utf8_conversion` (`converted`) VALUES (0);.
2016-08-10T18:49:42+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` DROP INDEX `idx_link_old`;.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` MODIFY `old_url` VARCHAR(2048) NOT NULL;.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` MODIFY `new_url` VARCHAR(2048);.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` MODIFY `referer` VARCHAR(2048) NOT NULL;.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.0-2016-03-01. Query text: ALTER TABLE `#__redirect_links` ADD INDEX `idx_old_url` (`old_url`(100));.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.1-2016-03-25. Query text: ALTER TABLE `#__user_keys` MODIFY `user_id` varchar(150) NOT NULL;.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.5.1-2016-03-29. Query text: UPDATE `#__utf8_conversion` SET `converted` = 0  WHERE (SELECT COUNT(*) FROM `#_.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `name` = 'Joomla! Core' WHERE `name` = 'Joomla Core.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `name` = 'Joomla! Extension Directory' WHERE `name`.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/core/list.x.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/jed/list.xm.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/language/tr.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-01. Query text: UPDATE `#__update_sites` SET `location` = 'https://update.joomla.org/core/extens.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-06. Query text: ALTER TABLE `#__redirect_links` MODIFY `new_url` VARCHAR(2048);.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-08. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-08. Query text: UPDATE `#__update_sites_extensions` SET `extension_id` = 802 WHERE `update_site_.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-04-09. Query text: ALTER TABLE `#__menu_types` ADD COLUMN `asset_id` INT(11) NOT NULL AFTER `id`;.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-05-06. Query text: DELETE FROM `#__extensions` WHERE `type` = 'library' AND `element` = 'simplepie'.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-05-06. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-06-01. Query text: UPDATE `#__extensions` SET `protected` = 1, `enabled` = 1  WHERE `name` = 'com_a.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Ran query from file 3.6.0-2016-06-05. Query text: ALTER TABLE `#__languages` ADD COLUMN `asset_id` INT(11) NOT NULL AFTER `lang_id.
2016-08-10T18:49:43+00:00	INFO 164.82.32.13	update	Deleting removed files and folders.
2016-08-10T18:49:49+00:00	INFO 164.82.32.13	update	Cleaning up after installation.
2016-08-10T18:49:49+00:00	INFO 164.82.32.13	update	Update to version 3.6.0 is complete.
2016-08-10T18:53:23+00:00	INFO 164.82.32.13	update	Update started by user Super User (10). Old version is 3.6.0.
2016-08-10T18:53:23+00:00	INFO 164.82.32.13	update	Downloading update file from https://github.com/joomla/joomla-cms/releases/download/3.6.2/Joomla_3.6.2-Stable-Update_Package.zip.
2016-08-10T18:53:23+00:00	INFO 164.82.32.13	update	File Joomla_3.6.2-Stable-Update_Package.zip successfully downloaded.
2016-08-10T18:53:23+00:00	INFO 164.82.32.13	update	Starting installation of new version.
2017-01-18T03:12:11+00:00	INFO 173.67.201.64	update	Update started by user Super User (10). Old version is 3.6.2.
2017-01-18T03:12:11+00:00	INFO 173.67.201.64	update	Downloading update file from https://downloads.joomla.org/cms/joomla3/3-6-5/Joomla_3.6.5-Stable-Update_Package.zip.
2017-01-18T03:12:16+00:00	INFO 173.67.201.64	update	File Joomla_3.6.5-Stable-Update_Package.zip successfully downloaded.
2017-01-18T03:12:16+00:00	INFO 173.67.201.64	update	Starting installation of new version.
2017-01-18T03:12:20+00:00	INFO 173.67.201.64	update	Finalising installation.
2017-01-18T03:12:21+00:00	INFO 173.67.201.64	update	Ran query from file 3.6.3-2016-08-15. Query text: ALTER TABLE `#__newsfeeds` MODIFY `link` VARCHAR(2048) NOT NULL;.
2017-01-18T03:12:21+00:00	INFO 173.67.201.64	update	Ran query from file 3.6.3-2016-08-16. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2017-01-18T03:12:21+00:00	INFO 173.67.201.64	update	Deleting removed files and folders.
2017-01-18T03:12:22+00:00	INFO 173.67.201.64	update	Cleaning up after installation.
2017-01-18T03:12:22+00:00	INFO 173.67.201.64	update	Update to version 3.6.5 is complete.
