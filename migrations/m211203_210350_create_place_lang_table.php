<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place_lang}}`.
 */
class m211203_210350_create_place_lang_table extends Migration {

    private $tableName = 'place_lang';

    public function up() {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'placeId' => $this->integer(11)->unsigned()->notNull(),
            'locality' => $this->string(45)->notNull(),
            'country' => $this->string(45)->notNull(),
            'lang' => $this->string(2)->notNull()
        ]);
        $this->createIndex('idx_place_lang_placeId_place', 'place_lang', 'placeId');
        $this->addForeignKey('fk_place_lang_placeId_place', $this->tableName, 'placeId', 'place', 'id');
    }

    public function down() {
        $this->dropForeignKey('fk_place_lang_placeId_place', $this->tableName);
        $this->dropIndex('idx_place_lang_placeId_place', $this->tableName);
        $this->dropTable($this->tableName);
    }

}
