<?php
namespace isaurssaurav\comment\components;
use yii;

/**
 * Class CommentHelper
 */
class CommentHelper {

    /**
    * Generate Comment and Its child comment in list.
    * @param model $parents get its child and get view format.
    * @return view format of comment.
    */
    public static function generateComment($parents){
        $out = '<ul class="nature">';
        foreach($parents as $parent) {
            $out.= '<li>';
            $childs=$parent->childs;
            if ($childs) {
                $out.= Yii::$app->view->renderFile('@isaurssaurav/comment/views/default/_list.php',['model' => $parent]) . self::generateComment($childs);
            } else {
                $out.= Yii::$app->view->renderFile('@isaurssaurav/comment/views/default/_list.php',['model' => $parent]);
            }
            $out.= '</li>';
        }
        $out.= '</ul>';
        return $out;
    }



}
?>