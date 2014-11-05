<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $categories common\models\Category[] */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php echo $this->render('/partials/_menu'); ?>
    <?php foreach ($categories as $category): ?>
        <?php echo $this->render('/category/_item', ['category' => $category]); ?>
    <?php endforeach; ?>
</div>
