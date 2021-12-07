<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m211207_093842_create_currency_table extends Migration
{
    private $tableName = 'currency';

    public function up() {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'code' => $this->string(3)->unique()->notNull(),
            'signFormat' => $this->string(45)->notNull(),
        ]);
    }

    public function down() {
        $this->dropTable($this->tableName);
    }
}
