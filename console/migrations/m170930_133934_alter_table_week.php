<?php

use yii\db\Migration;

class m170930_133934_alter_table_week extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%week}}", 'winners', $this->text());
    }

    public function safeDown() {
        $this->dropColumn("{{%week}}", 'winners');
    }
}
