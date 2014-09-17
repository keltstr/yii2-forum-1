<?php
/* @var $className string */

echo "<?php\n";
?>

use yii\db\Schema;
use console\components\Migration;

class <?= $className ?> extends Migration
{
    public function up()
    {

    }

    public function down()
    {
        echo "<?= $className ?> cannot be reverted.\n";

        return false;
    }
}
