<?php

use yii\db\Schema;
use yii\db\Query;
use yii\helpers\Inflector;
use console\components\Migration;

class m140918_054349_add_slug_column_to_topic extends Migration
{
    public function up()
    {
        $this->addColumn('{{%topic}}', 'slug', Schema::TYPE_STRING . ' NOT NULL');

        $topics = (new Query())->select('id, title')->from('{{%topic}}')->all();
        foreach ($topics as $topic) {
            $this->update('{{%topic}}', array('slug' => Inflector::slug($topic['title'])), 'id = :id',
                array(':id' => $topic['id']));
        }
    }

    public function down()
    {
        $this->dropColumn('{{%topic}}', 'slug');
    }
}
