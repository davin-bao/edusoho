<?php
namespace Topxia\Service\Order\Tests;

use Topxia\Service\Common\BaseTestCase;
use Topxia\Service\Common\ServiceKernel;
use Topxia\Service\Order\OrderProcessor\OrderProcessorFactory;

class OrderProcessorTest extends BaseTestCase
{
    public function testGetSummary()
    {
        $course = array(
            'title' => 'online test course 1',
            'about' => '测试'
        );
        $createCourse = $this->getCourseService()->createCourse($course);
        $processor    = OrderProcessorFactory::create('course');
        $summary      = $processor->getSummary(1);
        $this->assertEquals('测试', $summary);

        $classroom = array(
            'title'      => 'test',
            'id'         => 1,
            'categoryId' => 1,
            'status'     => 'published',
            'about'      => '测试班级'
        );
        $classroom = $this->getClassroomService()->addClassroom($classroom);
        $processor = OrderProcessorFactory::create('classroom');
        $summary   = $processor->getSummary(1);
        $this->assertEquals('测试班级', $summary);

        $level = array(
            'name'        => 'vip',
            'description' => '测试vip'
        );
        $level     = $this->getLevelService()->createLevel($level);
        $processor = OrderProcessorFactory::create('vip');
        $summary   = $processor->getSummary(1);
        $this->assertEquals('测试vip', $summary);
    }

    public function testGetTitle()
    {
        $course = array(
            'title' => 'online test course 1',
            'about' => '测试'
        );
        $createCourse = $this->getCourseService()->createCourse($course);
        $processor    = OrderProcessorFactory::create('course');
        $title        = $processor->getTitle(1);
        $this->assertEquals('online test course 1', $title);
        $classroom = array(
            'title'      => 'test',
            'id'         => 1,
            'categoryId' => 1,
            'status'     => 'published',
            'about'      => '测试班级'
        );
        $classroom = $this->getClassroomService()->addClassroom($classroom);
        $processor = OrderProcessorFactory::create('classroom');
        $title     = $processor->getTitle(1);
        $this->assertEquals('test', $title);

        $level = array(
            'name'        => 'vip',
            'description' => '测试vip'
        );
        $level     = $this->getLevelService()->createLevel($level);
        $processor = OrderProcessorFactory::create('vip');
        $title     = $processor->getTitle(1);
        $this->assertEquals('vip', $title);
    }

    protected function getCourseService()
    {
        return ServiceKernel::instance()->createService('Course.CourseService');
    }

    protected function getClassroomService()
    {
        return $this->getServiceKernel()->createService('Classroom:Classroom.ClassroomService');
    }

    protected function getLevelService()
    {
        return $this->getServiceKernel()->createService('Vip:Vip.LevelService');
    }
}
