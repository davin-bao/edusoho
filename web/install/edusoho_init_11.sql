INSERT INTO `course_chapter` (`id`, `courseId`, `type`, `number`, `seq`, `title`, `createdTime`, `updatedTime`, `copyId`, `status`, `isOptional`, `migrateLessonId`, `migrateCopyCourseId`, `migrateRefTaskId`, `mgrateCopyTaskId`, `migrate_task_id`) VALUES (1,1,'lesson',1,1,'如何创建课程？',1516008405,0,0,'published',0,0,0,0,0,0),(2,1,'lesson',2,2,'如何设置课程教师和课程价格？',1516008430,0,0,'published',0,0,0,0,0,0),(3,1,'lesson',3,3,'如何上传视频让学员学习？',1516008459,0,0,'published',0,0,0,0,0,0),(4,1,'lesson',4,4,'如何添加作业练习和考试？',1516008485,0,0,'published',0,0,0,0,0,0),(5,1,'lesson',5,5,'如何添加学习资料让学员下载？',1516008522,0,0,'published',0,0,0,0,0,0),(6,1,'lesson',6,6,'管理员如何管理课程和设置教师权限？',1516008543,0,0,'published',0,0,0,0,0,0),(7,1,'lesson',7,7,'如何查看课程订单和营收？',1516008568,0,0,'published',0,0,0,0,0,0),(8,1,'lesson',8,8,'关闭课程与删除课程',1516008595,0,0,'published',0,0,0,0,0,0);
INSERT INTO `course_draft` (`id`, `title`, `summary`, `courseId`, `content`, `userId`, `activityId`, `createdTime`) VALUES (5,'',NULL,1,'<p>关闭课程与删除课程路径都在网站后台，需管理员以上权限才能操作，教师无权操作。</p>\n\n<p><strong>关闭课程：</strong></p>\n\n<p>路径：【管理后台】-【课程】-【课程管理】-【关闭课程】；</p>\n\n<p>只有已发布的课程，才有关闭的概念，关闭后还可以再次发布。</p>\n\n<p>关闭后，未加入课程的学员访问将提示课程未发布无法加入；已经加入课程的学员，可以继续学习课程内容，如果不希望学员继续学习，可在课程的学员管理中移除学员。</p>\n\n<p><strong>删除课程：</strong></p>\n\n<p>路径：【管理后台】-【课程】-【课程管理】-【删除课程】；</p>\n\n<p>删除后与课程相关的学习记录都将无法恢复，学员无法访问课程，<span style=\"color:#e74c3c;\"><strong>删除操作不可逆</strong></span>，请慎重操作，删除时需要输入登陆密码再次确认。</p>\n\n<p>&nbsp;</p>\n',1,0,1516008597);
INSERT INTO `course_member` (`id`, `courseId`, `classroomId`, `joinedType`, `userId`, `orderId`, `deadline`, `refundDeadline`, `levelId`, `learnedNum`, `learnedCompulsoryTaskNum`, `credit`, `noteNum`, `noteLastUpdateTime`, `isLearned`, `finishedTime`, `seq`, `remark`, `isVisible`, `role`, `locked`, `deadlineNotified`, `createdTime`, `lastLearnTime`, `updatedTime`, `lastViewTime`, `courseSetId`) VALUES (1,1,0,'course',1,0,0,0,0,0,0,0,0,0,0,0,0,'',1,'teacher',0,0,1516008196,1516151792,1516775968,1516775968,1);
