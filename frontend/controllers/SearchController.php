<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ShareFile;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/**
 * Site controller
 */
class SearchController extends Controller
{
    public function actionIndex()
    {
        $key = Yii::$app->request->get('k');
        if (!$key) {
            return $this->redirect(['site/index']);
        }
        $pageSize = 20;
        $currentPage = Yii::$app->request->get('page');
        if (!isset($currentPage)) {
            $currentPage = 1;
        }
        $sphinx = new \SphinxClient();
        $sphinx->SetServer ('localhost',9312);
        $sphinx->SetArrayResult (true);
        //$sphinx->SetSortMode(SPH_SORT_ATTR_DESC, "id");
        $sphinx->SetLimits((($currentPage - 1) * $pageSize),$pageSize,1000);
        $sphinx->SetMaxQueryTime(10);
        $index = 'pan';
        $results = $sphinx->query ($key, $index);
        //判断sphinx中是否取出数据，如果为空，再从mysql通过like取数据
        if ($results['total'] != 0) {
            $pagination = new Pagination(['totalCount' => $results['total'],'pageSize' => $pageSize]);
            $ids = [];
            foreach ($results['matches'] as $value) {
                $ids[] = $value['id'];
            }
            $datas = ShareFile::find()->where(['in','fid',$ids])->all();
            return $this->render('search',['pagination' => $pagination,'datas' => $datas,'k' => $key,'type' => '快速']);
        }else{
            $query = ShareFile::find()->where(['like','title',$key])->orderBy(['fid' => SORT_DESC]);
            $count = $query->count();
            $pagination = new Pagination([
                'totalCount' => $count,
                'pageSize' => $pageSize,
                'pageSizeParam' => false,
            ]);
            $datas = $query->offset($pagination->offset)->limit($pagination->limit)->all();
            $linkPager = LinkPager::widget([
                                'pagination' => $pagination,
                                'nextPageLabel' => '下一页',
                                'prevPageLabel' => '上一页',
                                'firstPageLabel' => '首页',
                                'lastPageLabel' => '尾页',
                                'maxButtonCount' => 5,
                            ]);
            $linkPager = preg_replace('/href="(.*)\?(.*)page=(\d+)/', "href='$1-$3'", $linkPager);
            return $this->render('index',['datas' => $datas,'k' => $key,'type' => '慢速','linkPager' => $linkPager]);
        }
    }
}
