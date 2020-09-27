<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\models\NodeForm $model
 */

?>

<div class="add-node-form">
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'parentId') ?>

    <?= $form->field($model, 'position') ?>

    <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>

    <?= Html::a('Cancel', ['site/index'], ['class' => 'btn btn-danger']) ?>

    <?php $form = ActiveForm::end() ?>
</div>
