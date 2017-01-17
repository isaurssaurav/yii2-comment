<?php

use yii\db\Migration;

class m170117_084242_create_table_comment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%comment}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'recognize_schema' => $this->text()->notNull(),
            'parent_id' => $this->integer(11)->notNull()->defaultValue('0'),
            'username' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'comment' => $this->text()->notNull(),
            'up_vote' => $this->integer(11),
            'down_vote' => $this->integer(11),
            'status' => $this->smallInteger(4)->notNull()->defaultValue('0'),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);
        
    }
    
    public function safeDown()
    {
        echo "m170117_084242_create_table_comment cannot be reverted.\n";
        return false;
    }
}