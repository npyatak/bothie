<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ig_parse_data}}".
 *
 * @property integer $id
 * @property integer $ig_user_id
 * @property integer $ig_post_id
 * @property string $ig_caption
 * @property string $image
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class IgParseData extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 1;
    const STATUS_PROCESSED = 5;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ig_parse_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ig_user_id', 'ig_post_id'], 'required'],
            [['ig_user_id', 'ig_post_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['image'], 'string', 'max' => 255],
            ['ig_caption', 'safe'],
            [['ig_post_id'], 'unique'],
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
            'ig_user_id' => 'Ig User ID',
            'ig_post_id' => 'Ig Post ID',
            'ig_caption' => 'Ig Caption',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
