<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

class Post extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 5;

    const IMAGE_SQUARE = 1;
    const IMAGE_HORIZONTAL = 2;
    const IMAGE_VERTICAL = 3;

    public $frontImageFile;
    public $backImageFile;

    public $front_x;
    public $front_y;
    public $front_w;
    public $front_h;
    public $front_scale;
    public $front_angle;
    public $back_x;
    public $back_y;
    public $back_w;
    public $back_h;
    public $back_scale;
    public $back_angle;

    public $image;

    public $_lastUserActions;
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
            [['user_id', 'score', 'status', 'created_at', 'updated_at', 'is_from_ig', 'ig_parse_data_id', 'image_orientation'], 'integer'],
            [['front_image', 'back_image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['front_x', 'front_y', 'front_w', 'front_h', 'front_scale', 'front_angle', 'back_x', 'back_y', 'back_w', 'back_h', 'back_scale', 'back_angle'], 'safe'],
            [['frontImageFile'], 'file', 'skipOnEmpty' => false, 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            [['backImageFile'], 'file', 'skipOnEmpty' => false, 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }  

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['parse'] = ['ig_parse_data_id'];
        return $scenarios;
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'week_id' => 'Неделя',
            'front_image' => 'Фото с фронтальной камеры',
            'back_image' => 'Фото с тыловой камеры',
            'frontImageFile' => 'Фото с фронтальной камеры',
            'backImageFile' => 'Фото с тыловой камеры',
            'score' => 'Баллы',
            'status' => 'Статус',
            'is_from_ig' => 'Из инстаграма',
            'image' => 'Изображение',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
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

    public function getWeek()
    {
        return $this->hasOne(Week::className(), ['id' => 'week_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostActions()
    {
        return $this->hasMany(PostAction::className(), ['post_id' => 'id']);
    }

    public function getUrl() {
        return Url::toRoute(['/site/post', 'id'=>$this->id]);
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

    public function getIgImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/post/'.$this->user_id.'/'.$this->ig_image);
    }

    public function getGluedImageUrl() {
        return Url::toRoute(['site/image', 'id'=>$this->id]);
    }

    public static function getImageUrl($user_id, $image) {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/post/'.$user_id.'/'.$image);
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

    public function getLastUserActions() {
        if($this->_lastUserActions === null) {
            $this->_lastUserActions = PostAction::find()
                ->select(['MAX(id) as last_user_action_id', 'MAX(created_at) as last_user_action_time', 'type'])
                ->where(['user_id'=>Yii::$app->user->id, 'post_id'=>$this->id])
                ->groupBy('type, post_id')
                ->orderBy('id DESC, type')
                ->indexBy('type')
                ->asArray()
                ->all();
        }
        return $this->_lastUserActions;
    }

    public function userCan($type) {
        if(isset($this->lastUserActions[$type]) && !PostAction::userCanDo($this->lastUserActions[$type]['last_user_action_time'])) {
            return false;
        }

        return true;
    }

    public function getCssClass() {
        if($this->is_from_ig) {
            switch ($this->image_orientation) {
                case self::IMAGE_SQUARE:
                    $class = 'w280-h280';
                    break;
                case self::IMAGE_HORIZONTAL:
                    $class = 'w600-h280';
                    break;
                case self::IMAGE_VERTICAL:
                    $class = 'w280-h600';
                    break;
            }

            return $class;
        }
    }
}
