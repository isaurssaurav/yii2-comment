<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['id' => 'pjax-comment-div','enablePushState' => false]); ?>
<div class="col-md-12 npad">
    <?php ActiveForm::begin(["id" => "postCommentForm"]);  ?>
    
        <div class="postComment col-md-12 " >
            <div class="comment-header">
                <p><span><?= $totalComment ?></span> Comments</p>
            </div>
            <div class="comment-editor col-md-12 npad">
                <textarea rows="3" placeholder="write a comment" name="comment"></textarea>
                <div class="showable">
                    <input class="form-control comment-input" type="text" name="username" placeholder="username">
                    <input class="form-control comment-input" type="email" name="email" placeholder="email">
                    <a class="post-button"  
                        data-post-url = "<?= Url::to(['comment/default/add-comment']) ?>"
                        data-recognize-schema = "<?= $recognize_schema ?>">POST</a>
                    <p class="comment-message"></p>
                </div>
            </div>
        </div>
        <div class="postcomment-footer col-md-12 npad">
            <div class="dropdown">
                <a data-toggle="dropdown">Sort Comments</a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href = "#" 
                        data-url = "<?= Url::to(['comment/default/set-sort']) ?>"
                        data-sort = "DESC"
                         class="sort-comment">Most Recent</a></li>
                    <li><a href="#" 
                        data-url = "<?= Url::to(['comment/default/set-sort']) ?>"
                        data-sort = "ASC"
                         class="sort-comment">Oldest</a></li>
                </ul>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    <div id="commentdiv" class="col-md-12 npad">
        <?= $result ?>
    </div>
</div>

<?php if($limit < $totalComment){ ?>
        <a id="loadMoreComment" data-limit="<?= $limit ?>"
            data-url = "<?= $recognize_schema ?>"
            data-sort = "<?= $sort ?>"
            data-totalcomment = "<?= $totalComment ?>"
            data-post-url = "<?= Url::to(['comment/default/load-more']) ?>" style="display: block">load more</a>
<?php } ?>
<?php Pjax::end(); ?>
