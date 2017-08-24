<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_week_score}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $week_id
 * @property integer $score
 *
 * @property User $user
 * @property Week $week
 */
class UserWeekScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_week_score}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'week_id'], 'required'],
            [['user_id', 'week_id', 'score'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['week_id'], 'exist', 'skipOnError' => true, 'targetClass' => Week::className(), 'targetAttribute' => ['week_id' => 'id']],
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
            'week_id' => 'Week ID',
            'score' => 'Score',
        ];
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
    public function getWeek()
    {
        return $this->hasOne(Week::className(), ['id' => 'week_id']);
    }
}
