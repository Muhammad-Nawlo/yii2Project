<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trip}}`.
 */
class m211207_101320_create_trip_table extends Migration {

    private $tableName = 'trip';

    public function up() {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'userId' => $this->integer(11)->notNull()->unsigned(),
            'from' => $this->integer(11)->notNull()->unsigned(),
            'to' => $this->integer(11)->notNull()->unsigned(),
            'date' => $this->dateTime()->notNull(),
            'seatCounts' => $this->tinyInteger(4)->notNull(),
            'duration' => $this->decimal(10, 1)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'currencyId' => $this->integer(11)->notNull()->unsigned(),
            'status' => $this->tinyInteger(4)->notNull()->defaultValue(1),
            'createdAt' => $this->timestamp()->notNull()->defaultValue(date('Y-m-d h:i:s')),
            'updatedAt' => $this->timestamp()->notNull()->defaultValue(date('Y-m-d h:i:s'))
        ]);
        
        $this->createIndex('idx_trip_userId_user', 'trip', 'userId');
        $this->addForeignKey('fk_trip_userId_user', $this->tableName, 'userId', 'user', 'id');
        
        $this->createIndex('idx_trip_from_place', 'trip', 'from');
        $this->addForeignKey('fk_trip_from_place', $this->tableName, 'from', 'place', 'id');
        
        $this->createIndex('idx_trip_to_place', 'trip', 'to');
        $this->addForeignKey('fk_trip_to_place', $this->tableName, 'to', 'place', 'id');
        $this->createIndex('idx_trip_currencyId_trip', 'trip', 'currencyId');
        $this->addForeignKey('fk_idx_trip_currencyId_trip', $this->tableName, 'currencyId', 'currency', 'id');
    }

    public function down() {

        $this->dropForeignKey('fk_idx_trip_currencyId_trip', $this->tableName);
        $this->dropIndex('idx_trip_currencyId_trip', $this->tableName);

        $this->dropForeignKey('fk_trip_to_place', $this->tableName);
        $this->dropIndex('idx_trip_to_place', $this->tableName);

        $this->dropForeignKey('fk_trip_from_place', $this->tableName);
        $this->dropIndex('idx_trip_from_place', $this->tableName);

        $this->dropForeignKey('fk_trip_userId_user', $this->tableName);
        $this->dropIndex('idx_trip_userId_user', $this->tableName);

        $this->dropTable($this->tableName);
    }

}
