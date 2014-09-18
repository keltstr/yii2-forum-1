<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $categories common\models\Category[] */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="well well-lg clearfix">
        <div class="btn-group pull-right">
            <?= Html::a('Start a new discussion topic', ['topic/create'], ['class' => 'btn btn-lg btn-primary']); ?>
        </div>
    </div>

    <?php foreach ($categories as $category): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?= Html::a(Html::encode($category->title), $category->url); ?></strong>
            </div>

            <?php if (!empty($category->description)): ?>
                <div class="panel-body">
                    <?= Yii::$app->formatter->asParagraphs($category->description); ?>
                </div>
            <?php endif; ?>

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
                                <strong><?= Html::a(Html::encode($section->title), $section->url); ?></strong>
                                <?php if (!empty($section->description)): ?>
                                    <?= Yii::$app->formatter->asParagraphs($section->description); ?>
                                <?php endif; ?>
                            </td>
                            <td>123</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
</div>
