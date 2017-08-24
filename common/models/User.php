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
 * @property string $profile_picture
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
            [['ig_id', 'username', 'status', 'created_at', 'updated_at'], 'required'],
            [['ig_id', 'status', 'created_at', 'updated_at'], 'integer'],
            ['status', 'in', [self::STATUS_ACTIVE, self::STATUS_BANNED]],
            [['username', 'full_name', 'profile_picture', 'bio', 'website'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ig_id' => 'Ig ID',
            'username' => 'Username',
            'full_name' => 'Full Name',
            'profile_picture' => 'Profile Picture',
            'bio' => 'Bio',
            'website' => 'Website',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public static function findByEAuth($service) {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }

        $id = $service->getServiceName().'-'.$service->getId();
        $attributes = [
            'id' => $id,
            'username' => $service->getAttribute('name'),
            'authKey' => md5($id),
            'profile' => $service->getAttributes(),
        ];
        $attributes['profile']['service'] = $service->getServiceName();
        Yii::$app->getSession()->set('user-'.$id, $attributes);
        return new self($attributes);
    }

    public function getPosts() {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    public function getUserWeekScores() {
        return $this->hasMany(UserWeekScore::className(), ['user_id' => 'id']);
    }

    public function getPostActions() {
        return $this->hasMany(PostAction::className(), ['user_id' => 'id']);
    }
}
