<?php
/**
 * CommentWidget.php
 * @author isaurssaurav
 *
 */
namespace isaurssaurav\yii\comment\widgets;

use yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use isaurssaurav\comment\models\Comment;
use isaurssaurav\comment\components\CommentHelper;
use yii\widgets\Pjax;

/**
 * Class CommentWidget
 */
class CommentWidget extends Widget
{
    /** @var integer */
    public $limit = 2;

    /** @var string */
    public $sort = "ASC";

    /** @var string */
    public $recognize_schema;

    /** @var integer */
    public $totalShownComment;

    /** @var string */
    public $view = "comment-view";

    public function init()
    {
        parent::init();
        $totalShownComment = $this->limit;
        if ($this->recognize_schema === null) {
            $this->recognize_schema = Yii::$app->urlManager->createUrl(Yii::$app->request->getPathInfo())  ;
        } 
        $session = Yii::$app->session;
        $session->open();
        $session_ = $session->get('comment_view_type');
        if($session_){
            $this->sort = $session_;
        }else{
            $session->set('comment_view_type','ASC');
        }

        //$this->setSort($this->sort);

    }

    /**
    * Register asset bundle.
    */
    protected function registerAssets()
    {
        CommentWidgetAsset::register($this->getView());
    }


    public function setSort($sort){
        $this->sort = $sort;
    }

    /**
    * Get remaning comment.
    * @return  comment object model.
    */
    // public static function remainingComment(){
    //     $remainingModels=Review::find()->where(['parent_id'=>0])->orderBy('id '.$this->sort)->limit($this->limit)->all();
    //     return $this->generate($remainingModels);
    // }


    protected function getTotalComment(){
        $models=Comment::find()->where(['parent_id'=>0])->andWhere(['recognize_schema' => $this->recognize_schema])->all();
        return count($models);
    }


    public function run()
    {
        $this->registerAssets();
        $parentReview = Comment::find()->where(['parent_id' => 0])
            ->andWhere(['recognize_schema' => $this->recognize_schema])
            ->orderBy('id '.$this->sort)
            ->limit($this->limit)
            ->all();
        $result = CommentHelper::generateComment($parentReview);
        return $this->render($this->view,[
            'result' => $result,
            'limit' => $this->limit,
            'totalShownComment' => $this->totalShownComment,
            'totalComment' => $this->getTotalComment(),
            'sort' => $this->sort,
            'recognize_schema' => $this->recognize_schema
         ]);
    }
}
