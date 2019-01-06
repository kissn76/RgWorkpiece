<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Itemin */

$this->title = Yii::t('app', 'Update Incoming');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['item/index']];
$this->params['breadcrumbs'][] = ['label' => $model->parentItem->itemName, 'url' => ['item/view', 'id' => $model->parentItem->itemId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemin-update">

    <h1><?= Html::encode($this->title . ': ') . Html::a($model->parentItem->itemName, ['item/view', 'id' => $model->parentItem->itemId]) ?></h1>

    <?= $this->render('_updateform', [
        'model' => $model,
    ]) ?>

</div>
