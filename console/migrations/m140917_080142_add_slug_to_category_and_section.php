<?php

use yii\db\Schema;
use yii\db\Query;
use yii\helpers\Inflector;
use console\components\Migration;

class m140917_080142_add_slug_to_category_and_section extends Migration
{
    public function up()
    {
        $this->addColumn('{{%category}}', 'slug', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('{{%section}}', 'slug', Schema::TYPE_STRING . ' NOT NULL');

        $categories = (new Query())->select('id, title')->from('{{%category}}')->all();
        foreach ($categories as $category) {
            $this->update('{{%category}}', array('slug' => Inflector::slug($category['title'])), 'id = :id',
                array(':id' => $category['id']));
        }

        $sections = (new Query())->select('id, title')->from('{{%section}}')->all();
        foreach ($sections as $section) {
            $this->update('{{%section}}', array('slug' => Inflector::slug($section['title'])), 'id = :id',
                array(':id' => $section['id']));
        }
    }

    public function down()
    {
        $this->dropColumn('{{%category}}', 'slug');
        $this->dropColumn('{{%section}}', 'slug');
    }
}
