<?php

namespace common\models;

use Yii;

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
            [['sid', 'ig_id', 'status', 'created_at', 'updated_at'], 'integer'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_BANNED]],
            [['surname', 'name', 'image', 'ip', 'ig_username'], 'string', 'max' => 255],
            ['soc', 'string', 'max' => 2],
            ['ig_username', 'required', 'on'=>'missing_fields'],
            ['ig_username', 'checkIfIgProfileExists'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'soc' => 'Соц.сеть',
            'sid' => 'ID соц.сети',
            'ig_id' => 'ID инстаграма',
            'ig_username' => 'Логин инстаграма',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'status' => 'Статус',
            'image' => 'Аватар',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
            'ip' => 'IP адрес',
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    public function checkIfIgProfileExists($attribute, $model) {
        $url = 'https://www.instagram.com/'.$this->$attribute.'/?__a=1';

        $headers = get_headers($url);
        if(substr($headers[0], 9, 3) != "200"){
            $this->addError($attribute, 'Указанный логин инстаграма не существует');
        }
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['missing_fields'] = ['ig_username'];
        return $scenarios;
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

    public static function findByService($soc, $sid) {
        return static::findOne(['soc' => $soc, 'sid' => $sid]);
    }

    public function getPosts() {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    public function getPostActions() {
        return $this->hasMany(PostAction::className(), ['user_id' => 'id']);
    }

    // public function getImageUrl() {
    //     return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/user/'.$this->image);
    // }

    public function getFullName() {
        return $this->name.' '.$this->surname;
    }
}
