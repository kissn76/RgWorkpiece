<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->itemName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->itemId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->itemId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'itemId',
            //'itemCategory',
            [
                'attribute' => 'itemcategoryname.categoryName',
            ],
            'itemName:ntext',
            'itemMinStock',
            'itemActStock',
        ],
    ]) ?>
    
    <div class="row">
        <div class="col-lg-6">
            <p>
                <?= Html::a(Yii::t('app', 'Incoming'), ['itemin/create', 'parentId' => $model->itemId], ['class' => 'btn btn-primary', 'title' => Yii::t('app', 'Add new incoming')]) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProviderIn,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'iteminId',
                    //'iteminItem',
                    'iteminAmount',
                    'iteminComment:ntext',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'itemin',
                        //'template' => '{view} {delete}',
                    ],
                ],
            ]); ?>
        </div>
        
        <div class="col-lg-6">
            <p>
                <?= Html::a(Yii::t('app', 'Outgoing'), ['itemout/create', 'parentId' => $model->itemId], ['class' => 'btn btn-primary', 'title' => Yii::t('app', 'Add new outgoing')]) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProviderOut,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'iteminId',
                    //'iteminItem',
                    'itemoutAmount',
                    'itemoutComment:ntext',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'itemout',
                        //'template' => '{view} {delete}',
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>
