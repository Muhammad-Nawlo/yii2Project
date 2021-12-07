<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phone_number}}`.
 */
class m211207_100632_create_phone_number_table extends Migration
{
    private $tableName = 'phone_number';

    public function up() {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'userId' => $this->integer(11)->notNull()->unsigned(),
            'countryId' => $this->integer(11)->notNull()->unsigned(),
            'number' => $this->string(45)->notNull()->unique(),
            'verificationCode' => $this->string(45)->notNull(),
            'verified' => $this->boolean()->notNull()->defaultValue(false),
            'active' => $this->boolean()->notNull()->defaultValue(false),
            'createdAt' => $this->timestamp()->notNull()->defaultValue(date('Y-m-d h:i:s')),
        ]);
        
        
        $this->createIndex('idx_phone_number_userId_user', 'phone_number', 'userId');
        $this->addForeignKey('fk_phone_number_userId_user', $this->tableName, 'userId', 'user', 'id');

        $this->createIndex('idx_phone_number_countyId_country', 'phone_number', 'countryId');
        $this->addForeignKey('fk_phone_number_countyId_country', $this->tableName, 'countryId', 'country', 'id');
    }

    public function down() {
        
        $this->dropForeignKey('fk_phone_number_countryId_country', $this->tableName);
        $this->dropIndex('idx_phone_number_countryId_country', $this->tableName);

        $this->dropForeignKey('fk_phone_number_userId_user', $this->tableName);
        $this->dropIndex('idx_phone_number_userId_user', $this->tableName);
        
        $this->dropTable($this->tableName);
    }
}
