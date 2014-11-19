<?php 
namespace Topxia\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Topxia\Common\Paginator;
use Topxia\Service\Util\CCVideoClientFactory;

class CoursewareController extends BaseController
{
    public function manageAction(Request $request, $categoryId, $type)
    {
        $fields = $request->query->all();
        if(!empty($fields)){
            if($fields['method'] == 'tag'){
                $conditions = array(
                    'tagIds' => $fields['tagIds'],
                    'knowledgeId' => $fields['knowledgeId'],
                    'categoryId' => $categoryId
                );
            } else {
                $conditions = array(
                    'title' => $fields['title'],
                    'knowledgeId' => $fields['knowledgeId'],
                    'categoryId' => $categoryId
                );
            }
        } else {
            $conditions = array('categoryId' => $categoryId);
        }

        $coursewaresCount = $this->getCoursewareService()->searchCoursewaresCount($conditions);

        $paginator = new Paginator($this->get('request'), $coursewaresCount, 8);

        $coursewares = $this->getCoursewareService()->searchCoursewares(
            $conditions, 
            array('createdTime','desc'),
            $paginator->getOffsetCount(),  
            $paginator->getPerPageCount()
        );

        $category = $this->getCategoryService()->getCategory($categoryId);

        if ($type == 'list') {
            return $this->render('TopxiaAdminBundle:Courseware:list-view.html.twig',array(
                'category' => $category,
                'coursewares' => $coursewares
            ));
        } else {
            return $this->render('TopxiaAdminBundle:Courseware:thumb-view.html.twig',array(
                'category' => $category,
                'coursewares' => $coursewares,
                'coursewaresCount' => $coursewaresCount
            ));
        }
    }

    public function createAction(Request $request, $categoryId)
    {
        $category = $this->getCategoryService()->getCategory($categoryId);

        if (empty($category)) {
            throw $this->createNotFoundException("分类(#{$categoryId})不存在，创建课件失败！");
        }

        if ($request->getMethod() == 'POST') {
            $courseware = $request->request->all();
            $videoMeta = $this->getVideoMeta($courseware['url']);
            $courseware = $this->filterVideoField($videoMeta,$courseware);
            $courseware['categoryId'] = $categoryId;
            $courseware = $this->getCoursewareService()->createCourseware($courseware);

            return $this->redirect($this->generateUrl('admin_courseware_manage',array('categoryId'=>$categoryId)));
        }

        return $this->render('TopxiaAdminBundle:Courseware:modal.html.twig',array(
            'category' => $category
        ));
    }

    public function deleteAction(Request $request)
    {
        $ids = $request->request->get('ids', array());
        $id = $request->query->get('id', null);

        if ($id) {
            array_push($ids, $id);
        }
        $result = $this->getCoursewareService()->deleteCoursewaresByIds($ids);
        if($result){
            return $this->createJsonResponse(array("status" =>"success"));
        } else {
            return $this->createJsonResponse(array("status" =>"failed"));
        }
    }

    public function editAction(Request $request, $categoryId, $id)
    {
        $category = $this->getCategoryService()->getCategory($categoryId);

        if (empty($category)) {
            throw $this->createNotFoundException("分类(#{$categoryId})不存在，编辑课件失败！");
        }

        $courseware = $this->getCoursewareService()->getCourseware($id);
        if (empty($courseware)) {
            throw $this->createNotFoundException('课件已经删除或者不存在.');
        }

        $courseware['relatedKnowledgeIds'] = implode(",", $courseware['relatedKnowledgeIds']);
        $courseware['tagIds'] = implode(",", $courseware['tagIds']);

        if ($request->getMethod() == 'POST') {
            $courseware = $this->request->all();
            $videoMeta = $this->getVideoMeta($courseware['url']);
            $courseware = $this->filterVideoField($videoMeta,$courseware);
            $courseware = $this->getCoursewareService()->updateCourseware($id,$courseware);

            return $this->redirect($this->generateUrl('admin_courseware_manage',array('categoryId'=>$categoryId)));
        }

        return $this->render('TopxiaAdminBundle:Courseware:modal.html.twig',
            array(
                'courseware' => $courseware,
                'category' => $category,
            )
        );
    }

    private function filterVideoField($videoMeta,$courseware)
    {
        $courseware['title'] = $videoMeta['title'];
        $courseware['image'] = $videoMeta['image'];
        $courseware['knowledgeIds'] = $courseware['relatedKnowledgeIds'].",".$courseware['tagIds'];
        $courseware['knowledgeIds'] = array_filter(explode(',', $courseware['knowledgeIds']));
        $courseware['relatedKnowledgeIds'] = array_filter(explode(',', $courseware['relatedKnowledgeIds']));
        $courseware['tagIds'] = array_filter(explode(',', $courseware['tagIds']));
        return $courseware;
    }

    private function getVideoMeta($videoUrl)
    {
        $factory = new CCVideoClientFactory();
        $client = $factory->createClient();
        $userIdAndVideoId = $this->getUserIdAndVideoId($videoUrl);
        $videoInfo = $client->getVideoInfo($userIdAndVideoId['userId'],$userIdAndVideoId['videoId']);
        $videoInfo = json_decode($videoInfo);
        return array(
            'title' => $videoInfo->video->title,
            'image' => $videoInfo->video->image
        );
    }

    private function getUserIdAndVideoId($url)
    {
        $query = parse_url($url);
        $querys = $this->convertUrlQuery($query['query']);
        $queryArr = explode('_', $querys['videoID']);
        return array(
            'userId' => $queryArr[0],
            'videoId' => $queryArr[1]
        );
    }

    private function getCoursewareService()
    {
        return $this->getServiceKernel()->createService('Courseware.CoursewareService');
    }

    private function convertUrlQuery($query)
    {
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param)
        {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }

    private function getCategoryService()
    {
        return $this->getServiceKernel()->createService('Taxonomy.CategoryService');
    }
}