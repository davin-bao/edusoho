INSERT INTO `category` (`id`, `code`, `name`, `icon`, `path`, `weight`, `groupId`, `parentId`, `description`, `orgId`, `orgCode`) VALUES (1,'default','默认分类','','',0,1,0,NULL,1,'1.'),(2,'classroomdefault','默认分类','','',0,2,0,NULL,1,'1.');
INSERT INTO `category_group` (`id`, `code`, `name`, `depth`) VALUES (1,'course','课程分类',3),(2,'classroom','班级分类',3);
INSERT INTO `cloud_app` (`id`, `name`, `code`, `type`, `protocol`, `description`, `icon`, `version`, `fromVersion`, `developerId`, `developerName`, `installedTime`, `updatedTime`, `edusohoMinVersion`, `edusohoMaxVersion`) VALUES (1,'EduSoho主系统','MAIN','core',3,'<p>EduSoho主系统</p>\r\n','MAIN/MAIN_icon.png','8.3.1','8.3.0',1,'EduSoho官方',1515723926,1533519204,'8.2.37','up');
INSERT INTO `content` (`id`, `title`, `editor`, `type`, `alias`, `summary`, `body`, `picture`, `template`, `status`, `categoryId`, `tagIds`, `hits`, `featured`, `promoted`, `sticky`, `userId`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `field9`, `field10`, `publishedTime`, `createdTime`) VALUES (1,'关于我们','richeditor','page','aboutus',NULL,'','','default','published',0,NULL,0,0,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1515719362,1515719362),(2,'常见问题','richeditor','page','questions',NULL,'','','default','published',0,NULL,0,0,1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1515719362,1515719362);
