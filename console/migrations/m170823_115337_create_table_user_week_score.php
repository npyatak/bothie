<?php

use yii\db\Migration;

class m170823_115337_create_table_user_week_score extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_week_score}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'week_id' => $this->integer()->notNull(),
            'score' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        
        $this->addForeignKey("{user_week_score}_user_id_fkey", '{{%user_week_score}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey("{user_week_score}_week_id_fkey", '{{%user_week_score}}', 'week_id', '{{%week}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {

        $this->dropTable('{{%user_week_score}}');
    }
}
