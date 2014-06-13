<?php

use yii\db\Schema;

class m131225_164215_create_nested_menu_tree_config extends \yii\db\Migration
{
	public function up()
	{
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('tbl_nested_menu_tree_config', [
            'id' => Schema::TYPE_PK."(11) NOT NULL AUTO_INCREMENT COMMENT 'ID'",
            'tree_id' => Schema::TYPE_INTEGER."(11) NOT NULL COMMENT 'Menu Tree'",
            'menu_url' => Schema::TYPE_STRING."(355) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Url'",
            'guest_allow' => Schema::TYPE_INTEGER."(11) NOT NULL DEFAULT '0' COMMENT 'Versteckt nein / ja'",
            'active' => Schema::TYPE_INTEGER."(11) DEFAULT NULL COMMENT 'Aktiv nein/ja'",
            'url_target' => Schema::TYPE_STRING."(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '_self' COMMENT 'Im Fenster öffnen'",
            'icon_id' => Schema::TYPE_INTEGER."(11) DEFAULT NULL COMMENT 'Icons'"
        ], $tableOptions);
	}

	public function down()
	{
		echo "m131225_164215_create_nested_menu_tree_config cannot be reverted.\n";
		return false;
	}
}
