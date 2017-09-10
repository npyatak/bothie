<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $ig_id
 * @property string $username
 * @property string $full_name
 * @property string $image
 * @property string $bio
 * @property string $website
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 5;
    /**
     * @var array EAuth attributes
     */
    public $profile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ig_id'], 'required'],
            [['ig_id', 'status', 'created_at', 'updated_at'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_BANNED]],
            [['username', 'full_name', 'image', 'bio', 'website'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ig_id' => 'ID инстаграмма',
            'username' => 'Username',
            'status' => 'Статус',
            'full_name' => 'Имя',
            'image' => 'Аватар',
            'bio' => 'Bio',
            'website' => 'Сайт',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
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

    public function getId() {
        return $this->id;
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getAuthKey() {}
    
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param \nodge\eauth\ServiceBase $service
     * @return User
     * @throws ErrorException
     */
    // public static function findByEAuth($service) {
    //     if (!$service->getIsAuthenticated()) {
    //         throw new ErrorException('EAuth user should be authenticated before creating identity.');
    //     }

    //     $id = $service->getServiceName().'-'.$service->getId();
    //     $attributes = [
    //         'id' => $id,
    //         'username' => $service->getAttribute('name'),
    //         'authKey' => md5($id),
    //         'profile' => $service->getAttributes(),
    //     ];
    //     $attributes['profile']['service'] = $service->getServiceName();
    //     Yii::$app->getSession()->set('user-'.$id, $attributes);
    //     return new self($attributes);
    // }

    public static function findByService($serviceId) {
        return self::find()->where(['ig_id' => $serviceId])->one();
    }

    public function getPosts() {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    public function getPostActions() {
        return $this->hasMany(PostAction::className(), ['user_id' => 'id']);
    }

    public function getImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/user/'.$this->image);
    }

    public function getName() {
        return $this->full_name ? $this->full_name : $this->username;
    }
}
