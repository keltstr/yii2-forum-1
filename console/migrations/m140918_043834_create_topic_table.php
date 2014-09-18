<?php

use yii\db\Schema;
use console\components\Migration;

class m140918_043834_create_topic_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%topic}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'section_id' => Schema::TYPE_INTEGER . ' NOT NULL',

            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'text' => Schema::TYPE_TEXT . ' NOT NULL',

            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->createIndex('fk__topic__category', '{{%topic}}', 'category_id');
        $this->addForeignKey('fk__topic__category', '{{%topic}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('fk__topic_section', '{{%topic}}', 'section_id');
        $this->addForeignKey('fk__topic_section', '{{%topic}}', 'section_id', '{{%section}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk__topic__category', '{{%topic}}');
        $this->dropIndex('fk__topic__category', '{{%topic}}');

        $this->dropForeignKey('fk__topic_section', '{{%topic}}');
        $this->dropIndex('fk__topic_section', '{{%topic}}');

        $this->dropTable('{{%topic}}');
    }
}
