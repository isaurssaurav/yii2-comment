<?php
/**
 * CommentWidgetAsset.php
 * @author isaurssaurav
 *
 */
namespace isaurssaurav\yii\comment\widgets;
/**
 * Class CommentWidgetAsset
 * @package isaurssaurav\yii\comments\widgets
 */
class CommentWidgetAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@vendor/isaurssaurav/yii2-comment/widgets/assets';
    public $css = [
        'comment.css',
    ];
    public $js = [
        'comment.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
      public $publishOptions = [
        'forceCopy'=>true,
      ];
}
