<?php

use yii\db\Schema;
use console\components\Migration;

class m140916_184547_create_category_hierarchy extends Migration
{
    public function up()
    {
        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,

            'title' => Schema::TYPE_STRING . ' NOT NULL',

            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createTable('{{%section}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',

            'title' => Schema::TYPE_STRING . ' NOT NULL',

            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('fk__section__category', '{{%section}}', 'category_id');
        $this->addForeignKey('fk__section__category', '{{%section}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk__section__category', '{{%section}}');
        $this->dropIndex('fk__section__category', '{{%section}}');

        $this->dropTable('{{%section}}');

        $this->dropTable('{{%category}}');
    }
}
