<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="col-md-12 comment-block">
    <div class="col-md-12 npad">
        <div class="comment-gravatar">
            <img class="img-circle" src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png" />
        </div>
        <p class="comment-usename"><?= $model->username ?></p>
        <p class="comment-time-ago"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $model->timeago ?></p>
    </div>
    <div class="col-md-12 npad comment-comment">
        <p ><?= $model->comment ?></p>
    </div>
    <div class="col-md-12 npad comment-footer">
        <ul class="comment-link-container">
            <li class="comment-link"><a href="javascript:void(0)" class="comment-reply-btn" data-parent-id="<?= $model->id ?>" style="color: #cc0000;">Reply</a></li>
            <li class="comment-link"><a>Share</a></li>
            <li class="comment-link-last"><a>Report</a></li>
        </ul>
    </div>
      
     <div class="comment-reply-div-<?= $model->id ?>" style="display:none;">
        <?php echo $this->render('_reply',["model" => $model]); ?> 
    </div>
</div>
