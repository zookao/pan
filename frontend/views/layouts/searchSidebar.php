<?php
use yii\helpers\Url;
use frontend\helpers\CheckMobileHelper;
use frontend\widgets\KeywordWidget;

?>
<div class="col-md-4">
    <div class="well">
        <h4>云上搜索</h4>
        <form action="<?=Url::to(['search/index'])?>">
        <div class="input-group">
            <input type="text" class="form-control" name="k" id="k" baiduSug="2" placeholder="暂只支持英文和中文搜索">
            <span class="input-group-btn">
                <button class="btn btn-info" id="searchButton" type="submit">
                    <i class="fa fa-fw fa-search"></i>
            </button>
            </span>
        </div>
        </form>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">热搜关键词</div>
        <?php echo KeywordWidget::widget() ?>
    </div>
    <center>
        <!-- 广告位 -->
        <img src="/images/ggwzz.png" class="img-responsive">
        <br />
        <!-- 广告位 -->
        <?php if (CheckMobileHelper::isMobile()): ?>
            <center></center>
        <?php else: ?>
            <center></center>
        <?php endif ?>
    </center>
</div>
<script type="text/javascript">
    $("#searchButton").click(function(){
        var key = $("#k").val();
        // var regu = "^[^a-zA-Z0-9\u4e00-\u9fa5]$";
        // var reg = new RegExp(regu);
        // var key = key.replace(reg, '');
        // if (!key) {return false;}
        window.location.href="/s-"+encodeURIComponent(key);
        return false;
    });
</script>
