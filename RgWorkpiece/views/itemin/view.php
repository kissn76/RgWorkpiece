<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Itemin */

$this->title = Yii::t('app', 'Incoming');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['item/index']];
$this->params['breadcrumbs'][] = ['label' => $model->parentItem->itemName, 'url' => ['item/view', 'id' => $model->parentItem->itemId]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="itemin-view">

    <h1><?= Html::encode($this->title . ': ') . Html::a($model->parentItem->itemName, ['item/view', 'id' => $model->parentItem->itemId]) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->iteminId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->iteminId], [
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
            //'iteminId',
            //'iteminItem',
            [
                'label' => Yii::t('app', 'Item name'),
                'value' => function ($model) {
                                return $model->parentItem->itemName;
                            },
            ],
            'iteminAmount',
            'iteminComment:ntext',
        ],
    ]) ?>

</div>
