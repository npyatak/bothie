<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%post_action}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $post_id
 * @property integer $type
 * @property integer $score
 * @property integer $created_at
 *
 * @property Post $post
 * @property User $user
 */
class PostAction extends \yii\db\ActiveRecord
{
    const TYPE_LIKE = 1;
    const TYPE_SHARE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_action}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id', 'type'], 'required'],
            [['user_id', 'post_id', 'type', 'score', 'created_at'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            
            ['type', 'in', [self::TYPE_LIKE, self::TYPE_SHARE]],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
            'type' => 'Type',
            'score' => 'Score',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getScoreArray() {
        return [
            self::TYPE_LIKE => 1,
            self::TYPE_SHARE => 2,
        ];
    }

    public function getScoreInitial() {
        return self::getScoreArray()[$this->type];
    }

    public function create($post_id, $type) {
        $model = new self;
        $model->user_id = Yii::$app->user->id;
        $model->post_id = $post_id;
        $model->type = $type;
        $model->score = $model->scoreInitial;

        $model->save();
    }
}
