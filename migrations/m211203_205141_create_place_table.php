<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%place}}`.
 */
class m211203_205141_create_place_table extends Migration {

    private $tableName = 'place';

    public function up() {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'placeId' => $this->string(45)->notNull(),
            'lat' => $this->string(45)->notNull(),
            'lng' => $this->string(45)->notNull(),
            'countryCode' => $this->string(2)->notNull(),
            'isCountry' => $this->boolean()->notNull()
        ]);
    }

    public function down() {
        $this->dropTable($this->tableName);
    }

}
