<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%week}}".
 *
 * @property integer $id
 * @property integer $number
 * @property string $name
 * @property string $image
 * @property string $description_1
 * @property string $description_2
 * @property integer $status
 *
 * @property Post[] $posts
 * @property UserWeekScore[] $userWeekScores
 */
class Week extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_WAITING = 1;
    const STATUS_ACTIVE = 5;
    const STATUS_FINISHED = 9;

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%week}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'name'], 'required'],
            [['number', 'status'], 'integer'],
            [['description_1', 'description_2'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 255],
            [['number'], 'unique'],
            
            [['imageFile'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Порядковый номер',
            'name' => 'Имя',
            'image' => 'Изображение',
            'description_1' => 'Описание 1',
            'description_2' => 'Описание 2',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['week_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserWeekScores()
    {
        return $this->hasMany(UserWeekScore::className(), ['week_id' => 'id']);
    }

    public static function getStatusArray() {
        return [
            self::STATUS_INACTIVE => 'Неактивна',
            self::STATUS_WAITING => 'В ожидании',
            self::STATUS_ACTIVE => 'Активна',
            self::STATUS_FINISHED => 'Закончена',
        ];
    }

    public function getStatusLabel() {
        return self::getStatusArray()[$this->status];
    }

    public static function getCurrent() {
        return self::find()/*->where(['status' => self::STATUS_ACTIVE])*/->one();
    }
}
