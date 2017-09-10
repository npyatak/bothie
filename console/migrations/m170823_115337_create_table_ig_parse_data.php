<?php

use yii\db\Migration;

class m170823_115337_create_table_ig_parse_data extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ig_parse_data}}', [
            'id' => $this->primaryKey(),
            'ig_user_id' => $this->bigInteger()->notNull(),
            'ig_post_id' => $this->bigInteger()->notNull()->unique(),
            'ig_caption' => $this->text(),
            'image' => $this->string(),
            'status' => $this->integer(1)->notNull()->defaultValue(1),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('{{%ig_parse_data}}');
    }
}
