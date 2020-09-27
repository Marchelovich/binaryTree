<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $childrenDataProvider \yii\data\BaseDataProvider */
/* @var $parentDataProvider \yii\data\BaseDataProvider */
/* @var $nodeId int */

?>

<div class="site-index">
    <div class="row">
        <div class="col-xs-1">
            <?= Html::a('Build Tree', ['site/build-tree'], [
                'class' => ['btn', 'btn-primary'],
            ]) ?>
        </div>
        <div class="col-xs-1">
            <?= Html::a('Add node', ['site/add-node'], [
                'class' => ['btn', 'btn-primary'],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <?= Html::beginForm('', 'get') ?>
            <div class="col-md-2">
                <label>Node id: </label>
            </div>
            <div class="col-md-4">
                <?= Html::input('string', 'nodeId', $nodeId) ?>
            </div>
            <div class="col-md-1">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
            </div>
        <?= Html::endForm() ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $childrenDataProvider,
            ]) ?>
        </div>
    </div>
    <h2>Children nodes</h2>

    <h2>Parent nodes</h2>
    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $parentDataProvider,
            ]) ?>
        </div>
    </div>
</div>
