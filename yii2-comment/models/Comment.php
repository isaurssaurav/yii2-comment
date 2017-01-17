<?php

namespace isaurssaurav\yii\comment\models;

use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $recognize_schema
 * @property integer $parent_id
 * @property string $username
 * @property string $email
 * @property string $comment
 * @property integer $up_vote
 * @property integer $down_vote
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at


 */
class Comment extends \yii\db\ActiveRecord
{

        public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recognize_schema', 'username', 'email', 'comment','created_at','updated_at'], 'required'],
            [['recognize_schema', 'comment'], 'string'],
            [['parent_id', 'up_vote', 'down_vote', 'status'], 'integer'],
            [['username', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recognize_schema' => 'Recognize Schema',
            'parent_id' => 'Parent ID',
            'username' => 'Username',
            'email' => 'Email',
            'comment' => 'Comment',
            'up_vote' => 'Up Vote',
            'down_vote' => 'Down Vote',
            'status' => 'Status',
        ];
    }

      public function getChilds()
    {
        return $this->hasMany(Comment::className(),['parent_id' => 'id']);
    }

     public function getTimeago()
    {
        $estimate_time = time() - $this->updated_at;

        if ($estimate_time < 1) {
            return 'a second ago';
        }

        $condition = [
                    12 * 30 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        ];

        foreach ($condition as $secs => $str) {
            $d = $estimate_time / $secs;

            if ($d >= 1) {
                $r = round($d);
                return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }

}
