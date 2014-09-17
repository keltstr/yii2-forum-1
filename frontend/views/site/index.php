<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $categories common\models\Category[] */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php foreach ($categories as $category): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?= Html::encode($category->title); ?></strong>
            </div>
            <div class="panel-body">
                <p>desc here</p>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Section</th>
                        <th class="col-md-2">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($category->sections as $section): ?>
                        <tr>
                            <td>
                                <strong><?= Html::encode($section->title); ?></strong>
                                <p>desc here</p>
                            </td>
                            <td>123</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>
