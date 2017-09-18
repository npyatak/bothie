<?php

use yii\db\Migration;

class m170918_123934_alter_table_week extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%week}}", 'hint_1', $this->string());
        $this->addColumn("{{%week}}", 'hint_2', $this->string());
    }

    public function safeDown() {
        $this->dropColumn("{{%week}}", 'hint_1');
        $this->dropColumn("{{%week}}", 'hint_2');
    }
}
