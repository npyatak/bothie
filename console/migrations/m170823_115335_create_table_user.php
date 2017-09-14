<?php

use yii\db\Migration;

class m170823_115335_create_table_user extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'soc' => $this->string(2),
            'sid' => $this->bigInteger(),
            'ig_id' => $this->bigInteger(),
            'ig_username' => $this->string(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'image' => $this->string(),
            'status' => $this->integer(1)->notNull()->defaultValue(1),
            'ip' => $this->string(),
            'browser' => $this->string(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%user}}', ['name', 'surname', 'ig_username', 'ig_id', 'created_at', 'updated_at'], [
            ['ivan', 'ivanov', 'test', '12345', time(), time()],
        ]);
    }

    public function safeDown() {
        $this->dropTable('{{%user}}');
    }
}
