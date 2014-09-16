<?php

namespace console\components;

class Migration extends \yii\db\Migration
{
    public function createTable($table, $columns, $options = null)
    {
        if ($options === null && $this->db->driverName === 'mysql') {
            $options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        parent::createTable($table, $columns, $options);
    }
}
