<?php

use yii\db\Schema;

class m131225_144539_nested_menu_tree extends \yii\db\Migration
{
    public function up()
    {
        // MySQL-specific table options. Adjust if you plan working with another DBMS
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('tbl_nested_menu_tree', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING.'(255) NOT NULL',
            'root' => Schema::TYPE_INTEGER . ' NOT NULL',
            'lft' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rgt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'level' => Schema::TYPE_SMALLINT . ' NOT NULL'
        ], $tableOptions);
    }


    public function down()
    {
        echo "m131225_144539_nested_menu_tree cannot be reverted.\n";
        return false;
    }
}
