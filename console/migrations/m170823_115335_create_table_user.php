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
            'ig_id' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'full_name' => $this->string(),
            'profile_picture' => $this->string(),
            'bio' => $this->string(),
            'website' => $this->string(),
            'status' => $this->integer(1)->notNull()->defaultValue(1),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%user}}', ['ig_id', 'username', 'full_name', 'created_at', 'updated_at'], [
            [123, 'ya.jamaker', 'ivan ivanov', time(), time()],
        ]);
    }

    public function safeDown() {
        $this->dropTable('{{%user}}');
    }
}
