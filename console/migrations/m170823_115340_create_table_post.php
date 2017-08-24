<?php

use yii\db\Migration;

class m170823_115340_create_table_post extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'week_id' => $this->integer()->notNull(),
            'front_image' => $this->string(),
            'back_image' => $this->string(),
            'score' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->integer(1)->notNull()->defaultValue(1),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{post}_user_id_fkey", '{{%post}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey("{post}_week_id_fkey", '{{%post}}', 'week_id', '{{%week}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
        $this->dropForeignKey('post}_week_id_fkey', '{{%post}}');
        $this->dropForeignKey('post}_user_id_fkey', '{{%post}}');

        $this->dropTable('{{%post}}');
    }
}
