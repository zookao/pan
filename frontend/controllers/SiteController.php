<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ShareFile;
use common\models\ShareUsers;
use common\models\Keyword;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $newVideos = ShareFile::find()->where(['file_type' => 0])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $newImages = ShareFile::find()->where(['file_type' => 1])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $newDocuments = ShareFile::find()->where(['file_type' => 2])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $newMusics = ShareFile::find()->where(['file_type' => 3])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $newPackages = ShareFile::find()->where(['file_type' => 4])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $newSoftwares = ShareFile::find()->where(['file_type' => 5])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $newTorrents = ShareFile::find()->where(['file_type' => 6])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $newOthers = ShareFile::find()->where(['file_type' => 7])->with('user')->orderBy(['fid' => SORT_DESC])->limit(50)->all();
        $topFxUsers = ShareUsers::find()->orderBy(['fetched' => SORT_DESC])->limit(14)->all();
        // $topFsUsers = ShareUsers::find()->orderBy(['fens_count' => SORT_DESC,'fetched' => SORT_DESC])->limit(14)->all();
        // $topGzzUsers = ShareUsers::find()->orderBy(['follow_count' => SORT_DESC,'fetched' => SORT_DESC])->limit(14)->all();
        $topSearchAll = Keyword::find()->orderBy(['times' => SORT_DESC])->limit(30)->all();
        $topSearchYesterday = Keyword::find()->orderBy(['yesterday' => SORT_DESC])->limit(30)->all();
        $topSearchToday = Keyword::find()->orderBy(['today' => SORT_DESC])->limit(30)->all();
        return $this->render('index',[
            'newVideos' => $newVideos,
            'newImages' => $newImages,
            'newDocuments' => $newDocuments,
            'newMusics' => $newMusics,
            'newPackages' => $newPackages,
            'newSoftwares' => $newSoftwares,
            'newTorrents' => $newTorrents,
            'newOthers' => $newOthers,
            'topFxUsers' => $topFxUsers,
            // 'topFsUsers' => $topFsUsers,
            // 'topGzzUsers' => $topGzzUsers,
            'topSearchAll' => $topSearchAll,
            'topSearchYesterday' => $topSearchYesterday,
            'topSearchToday' => $topSearchToday,
        ]);
    }
}
