
<?php 
use yii\widgets\ActiveForm;
?>
<div class="arrow-up"></div>
<?php ActiveForm::begin(["id" => "postCommentReplyForm".$model->id]);  ?>
<div class="postCommentReply col-md-12 " >
    <div class="reply-comment-header">
        <p><span>Relpy to </span><?= $model->username ?></p>
    </div>
    <div class="comment-editor col-md-12 npad">
        <textarea rows="3" placeholder="write a comment" name="comment"></textarea>
        <div class="showable">
            <input class="form-control comment-input" type="text" name="username" placeholder="username">
            <input class="form-control comment-input" type="email" name="email" placeholder="email">
            <a class="post-reply-button"  
                data-post-url = "<?= Yii::$app->urlManager->createUrl(['comment/default/reply-comment']) ?>"
                data-parent-id = "<?= $model->id ?>"
                data-recognize-schema = "<?= $recognize_schema ?>">POST</a>
            <p class="reply-comment-message"></p>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>