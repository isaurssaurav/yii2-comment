<?php

namespace isaurssaurav\yii\comment\controllers;

use yii\web\Controller;
use yii\helpers\Json;
use isaurssaurav\yii\comment\components\CommentHelper;
use isaurssaurav\yii\comment\models\Comment;
use Yii;

/**
 * Default controller for the `comment` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


     /**
     * Load Remaining Comment
     * @return list view of comment
     */
    public function actionLoadMore(){
        $offset = $_POST['offset'];
        $recognize_schema = $_POST['recognize_schema'];
        $sort = $_POST['sort'];
        $limit = $_POST['limit'];
        $nextModel = $this->findComment($offset, $recognize_schema, $sort,$limit);
       // print_r($nextModel);exit();
        $nextComment = CommentHelper::generateComment($nextModel);
        if(!empty($nextModel)){
            return $nextComment;
        }
    }

    protected static function validateform($comment,$username,$email){
        if(empty($comment) || empty($username) || empty($email)){
            return Json::encode(["status" => false, "message" => "*please fill the complete form" ]);
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return Json::encode(["status" => false, "message" => "*email seems invalid" ]);
        }
        return Json::encode(["status" => true ,"message" => "validation complete" ]);
    }

    public function actionSetSort(){
        if(Yii::$app->request->isAjax){
            $session = Yii::$app->session;
            $session->open();
            $session['comment_view_type'] = $_POST["sort"];
            return true;
        }

    }

    public function actionReplyComment(){
         if(Yii::$app->request->isAjax){
             //print_r($_POST);exit();
           $comment = $_POST["comment"];
           $username = $_POST["username"];
           $email = $_POST["email"];
           $recognize_schema = $_POST["recognize_schema"];
           $parent_id = $_POST["parent_id"];
           $validate = Json::decode(self::validateform($comment, $username, $email));
           if($validate["status"] == 1){
                $model= new Comment();
                $model->comment = $comment;
                $model->username = $username;
                $model->email = $email;
                $model->recognize_schema = $recognize_schema;
                $model->parent_id = $parent_id; 
                $model->save(false);
                return Json::encode(["status" => true, "message" => $validate["message"]]);
           }else{
               return Json::encode(["status" => false, "message" => $validate["message"]]);
           }
       } 
    }

    public function actionAddComment(){
       
       if(Yii::$app->request->isAjax){
           $comment = $_POST["comment"];
           $username = $_POST["username"];
           $email = $_POST["email"];
           $recognize_schema = $_POST["recognize_schema"];
           $validate = Json::decode(self::validateform($comment, $username, $email));
           if($validate["status"] == 1){
                $model= new Comment();
                $model->comment = $comment;
                $model->username = $username;
                $model->email = $email;
                $model->recognize_schema= $recognize_schema;
                $model->save(false);
                return Json::encode(["status" => true, "message" => $validate["message"]]);
           }else{
               return Json::encode(["status" => false, "message" => $validate["message"]]);
           }
       } 
  }



     /**
     *  find a comment model with params to be filtered
     * @param $offset
     * @param $url
     * @param $sort
     * @param $olimit
     * @return comment model
     */
    protected function findComment($offset,$recognize_schema,$sort,$limit){
        $model = Comment::find()->where(['parent_id'=> 0, 'recognize_schema' => $recognize_schema])->offset($offset)->orderBy('id '.$sort)->limit($limit)->all();
        return $model;
    }
}
