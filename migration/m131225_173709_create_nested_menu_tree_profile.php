<?php

use yii\db\Schema;

class m131225_173709_create_nested_menu_tree_profil extends \yii\db\Migration
{
    /**
     *CREATE TABLE `menu_tree` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `info` text COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;


     * @return bool|void
     *
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable(
            'tbl_nested_menu_tree_profile',
            [
                'id' => Schema::TYPE_PK."(11) NOT NULL AUTO_INCREMENT COMMENT 'ID'",
                'title' => Schema::TYPE_STRING."(355) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Titel'",
                'slug' => Schema::TYPE_STRING."(125) CHARACTER SET utf8 DEFAULT NULL  COMMENT 'Intern Slug'",
                'description' => Schema::TYPE_TEXT." DEFAULT NULL COMMENT 'Beschreibung'"
            ],
            $tableOptions
        );
        $this->db->createCommand('ALTER TABLE `tbl_nested_menu_tree_profile` ADD UNIQUE(`slug`);')->execute();
        $this->db->createCommand('ALTER TABLE `tbl_nested_menu_tree_profile` ADD INDEX(`tree_id`);')->execute();
        $this->db->createCommand('ALTER TABLE `tbl_nested_menu_tree_profile` ADD FOREIGN KEY (`tree_id`) REFERENCES `yiipress`.`tbl_nested_menu_tree`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;');

    }

	public function down()
	{
//        echo "m131225_173709_create_nested_menu_tree_profil cannot be reverted.\n";
        $this->db->createCommand()->dropTable('tbl_nested_menu_tree_profile')->execute();
		return false;
	}
}
