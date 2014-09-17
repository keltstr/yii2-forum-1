<?php

use yii\db\Schema;
use console\components\Migration;

class m140917_072214_add_category_and_section_description extends Migration
{
    public function up()
    {
        $this->addColumn('{{%category}}', 'description', Schema::TYPE_TEXT . ' NULL DEFAULT NULL');
        $this->addColumn('{{%section}}', 'description', Schema::TYPE_TEXT . ' NULL DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%category}}', 'description');
        $this->dropColumn('{{%section}}', 'description');
    }
}
