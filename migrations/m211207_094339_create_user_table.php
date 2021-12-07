<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m211207_094339_create_user_table extends Migration {

    private $tableName = 'user';

    public function up() {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
            'uId' => $this->string(60)->notNull(),
            'userName' => $this->string(45)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(60)->notNull(),
            'status' => $this->tinyInteger(4)->notNull()->defaultValue(0),
            'contactEmail' => $this->boolean()->notNull()->defaultValue(false),
            'contactPhone' => $this->boolean()->notNull()->defaultValue(false),
            'createdAt' => $this->timestamp()->notNull()->defaultValue(date('Y-m-d h:i:s')),
            'updatedAt' => $this->timestamp()->notNull()->defaultValue(date('Y-m-d h:i:s'))
        ]);
    }

    public function down() {
        $this->dropTable($this->tableName);
    }

}
