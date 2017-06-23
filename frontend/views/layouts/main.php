<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=Yii::$app->homeUrl?>">云上搜索</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?=Url::to(['category/index','id' => 0])?>">视频</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 1])?>">图片</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 2])?>">文档</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 3])?>">音乐</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 4])?>">压缩包</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 5])?>">软件</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => 6])?>">种子</a></li>
                    <li><a href="<?=Url::to(['category/index','id' => -1])?>">其他</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?=$content;?>
<?php $this->endBody() ?>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" >
var jiathis_config={
    siteNum:10,
    sm:"cqq,weixin,tsina,tqq,qzone,tieba,douban,ishare",
    summary:"",
    boldNum:6,
    showClose:true,
    shortUrl:false,
    hideMore:false
}
</script>
<!-- <script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?btn=r.gif&move=1" charset="utf-8"></script> -->
<!-- JiaThis Button END -->
</body>
</html>
<?php $this->endPage() ?>
