<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m211207_095806_create_message_table extends Migration {

    private $tableName = 'message';

    public function up() {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'fromUserId' => $this->integer(11)->unsigned()->notNull(),
            'toUserId' => $this->integer(11)->unsigned()->notNull(),
            'tripId' => $this->integer(11)->unsigned()->notNull(),
            'text' => $this->text()->notNull(),
            'createdAt' => $this->timestamp()->notNull()->defaultValue(date('Y-m-d h:i:s'))
        ]);
            
        $this->createIndex('idx_message_fromUserId_user', 'message', 'fromUserId');
        $this->addForeignKey('fk_message_fromUserId_user', $this->tableName, 'fromUserId', 'user', 'id');

        $this->createIndex('idx_message_toUserId_user', 'message', 'toUserId');
        $this->addForeignKey('fk_message_toUserId_user', $this->tableName, 'toUserId', 'user', 'id');

        $this->createIndex('idx_message_tripId_trip', 'message', 'tripId');
        $this->addForeignKey('fk_message_tripId_trip', $this->tableName, 'tripId', 'trip', 'id');
    }

    public function down() {
        $this->dropForeignKey('fk_message_tripId_trip', $this->tableName);
        $this->dropIndex('idx_message_tripId_trip', $this->tableName);

        $this->dropForeignKey('fk_message_toUserId_user', $this->tableName);
        $this->dropIndex('idx_message_toUserId_user', $this->tableName);

        $this->dropForeignKey('fk_message_fromUserId_user', $this->tableName);
        $this->dropIndex('idx_message_fromUserId_user', $this->tableName);
        
        $this->dropTable($this->tableName);
    }

}
