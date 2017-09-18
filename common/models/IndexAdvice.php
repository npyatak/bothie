<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%index_advice}}".
 *
 * @property integer $id
 * @property string $image_1
 * @property string $image_2
 * @property string $title
 * @property string $text
 * @property string $question
 * @property integer $status
 * @property integer $order
 */
class IndexAdvice extends \yii\db\ActiveRecord
{
    public $imageFile1;
    public $imageFile2;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 5;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%index_advice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order'], 'required'],
            [['text', 'question', 'link'], 'string'],
            [['status', 'order'], 'integer'],
            [['image_1', 'image_2', 'title'], 'string', 'max' => 255],
        ];
    }

    public function afterDelete() {
        $path = $this->imageSrcPath;
        if($this->image_1 && file_exists($path.$this->image_1) && is_file($path.$this->image_1)) {
            unlink($path.$this->image_1);
        }
        if($this->image_2 && file_exists($path.$this->image_2) && is_file($path.$this->image_2)) {
            unlink($path.$this->image_2);
        }
        return parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_1' => 'Картинка 1',
            'image_2' => 'Картинка 2',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'question' => 'Вопрос',
            'status' => 'Статус',
            'order' => 'Номер',
            'link' => 'Ссылка',
        ];
    }

    public static function getStatusArray() {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_INACTIVE => 'Не активен',
        ];
    }

    public function getStatusLabel() {
        return self::getStatusArray()[$this->status];
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/index-advice/';
    }

    public function getImage1Url() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/index-advice/'.$this->image_1);
    }

    public function getImage2Url() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/index-advice/'.$this->image_2);
    }
}
