<?php

use yii\db\Migration;

class m170918_133934_alter_table_index_advice extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%index_advice}}", 'link', $this->string());
    }

    public function safeDown() {
        $this->dropColumn("{{%index_advice}}", 'link');
    }
}
