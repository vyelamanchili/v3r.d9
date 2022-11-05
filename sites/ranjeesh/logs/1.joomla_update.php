#
#<?php die('Forbidden.'); ?>
#Date: 2016-02-20 02:43:09 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2016-02-20T02:43:09+00:00	INFO 70.106.243.159	update	Update started by user Super User (10). Old version is 3.3.6.
2016-02-20T02:43:09+00:00	INFO 70.106.243.159	update	Downloading update file from https://github.com/joomla/joomla-cms/releases/download/3.4.8/Joomla_3.4.8-Stable-Update_Package.zip.
2016-02-20T02:43:10+00:00	INFO 70.106.243.159	update	File Joomla_3.4.8-Stable-Update_Package.zip successfully downloaded.
2016-02-20T02:43:10+00:00	INFO 70.106.243.159	update	Starting installation of new version.
2016-02-20T02:43:13+00:00	INFO 70.106.243.159	update	Finalising installation.
2016-02-20T02:43:13+00:00	INFO 70.106.243.159	update	Deleting removed files and folders.
2016-02-20T02:43:16+00:00	INFO 70.106.243.159	update	Cleaning up after installation.
2016-02-20T02:43:16+00:00	INFO 70.106.243.159	update	Update to version 3.4.8 is complete.
2022-10-30T23:48:45+00:00	INFO 192.168.1.250	update	Update started by user Super User (10). Old version is 3.9.8.
2022-10-30T23:48:45+00:00	INFO 192.168.1.250	update	Downloading update file from https://downloads.joomla.org/cms/joomla3/3-10-11/Joomla_3.10.11-Stable-Update_Package.zip.
2022-10-30T23:48:47+00:00	INFO 192.168.1.250	update	File Joomla_3.10.11-Stable-Update_Package.zip downloaded.
2022-10-30T23:48:47+00:00	INFO 192.168.1.250	update	Starting installation of new version.
2022-10-30T23:48:54+00:00	INFO 192.168.1.250	update	Finalising installation.
2022-10-30T23:48:54+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.8-2019-06-15. Query text: ALTER TABLE `#__template_styles` DROP INDEX `idx_home`;.
2022-10-30T23:48:54+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.8-2019-06-15. Query text: ALTER TABLE `#__template_styles` ADD INDEX `idx_client_id` (`client_id`);.
2022-10-30T23:48:55+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.8-2019-06-15. Query text: ALTER TABLE `#__template_styles` ADD INDEX `idx_client_id_home` (`client_id`, `h.
2022-10-30T23:48:55+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.10-2019-07-09. Query text: ALTER TABLE `#__template_styles` MODIFY `home` char(7) NOT NULL DEFAULT '0';.
2022-10-30T23:48:56+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__categories` MODIFY `description` mediumtext;.
2022-10-30T23:48:57+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__categories` MODIFY `params` text;.
2022-10-30T23:48:57+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__fields` MODIFY `default_value` text;.
2022-10-30T23:48:58+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__fields_values` MODIFY `value` text;.
2022-10-30T23:48:58+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__finder_links` MODIFY `description` text;.
2022-10-30T23:48:59+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__modules` MODIFY `content` text;.
2022-10-30T23:49:00+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_body` mediumtext;.
2022-10-30T23:49:01+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_params` text;.
2022-10-30T23:49:02+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_images` text;.
2022-10-30T23:49:04+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_urls` text;.
2022-10-30T23:49:06+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metakey` text;.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-02-15. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_metadesc` text;.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-03-04. Query text: ALTER TABLE `#__users` DROP INDEX `username`;.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.16-2020-03-04. Query text: ALTER TABLE `#__users` ADD UNIQUE INDEX `idx_username` (`username`);.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.19-2020-05-16. Query text: ALTER TABLE `#__ucm_content` MODIFY `core_title` varchar(400) NOT NULL DEFAULT '.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.19-2020-06-01. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.21-2020-08-02. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.22-2020-09-16. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.26-2021-04-07. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.9.27-2021-04-20. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.10.0-2020-08-10. Query text: ALTER TABLE `#__template_styles` ADD COLUMN `inheritable` tinyint NOT NULL DEFAU.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.10.0-2020-08-10. Query text: ALTER TABLE `#__template_styles` ADD COLUMN `parent` varchar(50) DEFAULT '';.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.10.0-2021-05-28. Query text: INSERT INTO `#__extensions` (`package_id`, `name`, `type`, `element`, `folder`, .
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.10.7-2022-02-20. Query text: DELETE FROM `#__postinstall_messages` WHERE `title_key` = 'COM_ADMIN_POSTINSTALL.
2022-10-30T23:49:07+00:00	INFO 192.168.1.250	update	Ran query from file 3.10.7-2022-03-18. Query text: ALTER TABLE `#__users` ADD COLUMN `authProvider` VARCHAR(100) NOT NULL DEFAULT '.
2022-10-30T23:49:08+00:00	INFO 192.168.1.250	update	Deleting removed files and folders.
2022-10-30T23:49:17+00:00	INFO 192.168.1.250	update	Cleaning up after installation.
2022-10-30T23:49:17+00:00	INFO 192.168.1.250	update	Update to version 3.10.11 is complete.
