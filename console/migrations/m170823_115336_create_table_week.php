<?php

use yii\db\Migration;

class m170823_115336_create_table_week extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%week}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
            'image' => $this->string(),
            'description_1' => $this->text(),
            'description_2' => $this->text(),
            'status' => $this->integer(1)->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->batchInsert('{{%week}}', ['number', 'name', 'image', 'description_1', 'description_2'], [
            [1, 'foodporn', '', 'С 15 по 22 сентября', 'С 15 по 22 сентября 2'],
            [2, 'beauty', '', 'С 23 по 30 сентября', 'С 23 по 30 сентября 2'],
            [3, 'wellness', '', 'С 1 по 8 октября', 'С 1 по 8 октября 2'],
            [4, 'moms&kids', '', 'С 9 по 16 октября', 'С 9 по 16 октября 2'],
        ]);
    }

    public function safeDown() {

        $this->dropTable('{{%week}}');
    }
}
