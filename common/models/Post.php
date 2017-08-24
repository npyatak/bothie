<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $front_image
 * @property string $back_image
 * @property integer $score
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property PostAction[] $postActions
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 5;

    public $frontImageFile;
    public $backImageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'frontImageFile', 'backImageFile'], 'required'],
            [['user_id', 'score', 'status', 'created_at', 'updated_at'], 'integer'],
            [['front_image', 'back_image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['frontImageFile'], 'file', 'skipOnEmpty' => false, 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            [['backImageFile'], 'file', 'skipOnEmpty' => false, 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
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
            'front_image' => 'Front Image',
            'back_image' => 'Back Image',
            'score' => 'Score',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterDelete() {
        $path = $this->imageSrcPath;
        if(file_exists($path.$this->front_image) && is_file($path.$this->front_image)) {
            unlink($path.$this->front_image);
        }
        if(file_exists($path.$this->back_image) && is_file($path.$this->back_image)) {
            unlink($path.$this->back_image);
        }
        return parent::afterDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostActions()
    {
        return $this->hasMany(PostAction::className(), ['post_id' => 'id']);
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/post/'.$this->user_id.'/';
    }

    public function getFrontImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/post/'.$this->user_id.'/'.$this->front_image);
    }

    public function getBackImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/post/'.$this->user_id.'/'.$this->back_image);
    }

    public static function getStatusArray() {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_BANNED => 'Забанен',
        ];
    }

    public function getStatusLabel() {
        return self::getStatusArray()[$this->status];
    }
}
