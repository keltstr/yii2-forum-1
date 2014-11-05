<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $category common\models\Category */
?>
<div class="category-view">
    <?php echo $this->render('/partials/_menu'); ?>
    <?php echo $this->render('/category/_item', ['category' => $category]); ?>
</div>
