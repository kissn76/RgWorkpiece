<?php

use yii\helpers\Html;
use app\models\Item;

/* @var $this yii\web\View */
/* @var $model app\models\Itemout */

$this->title = Yii::t('app', 'Create Outgoing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['item/index']];
$this->params['breadcrumbs'][] = ['label' => $model->parentItem->itemName, 'url' => ['item/view', 'id' => $model->parentItem->itemId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemout-create">

    <h1><?= Html::encode($this->title . ': ') . Html::a($model->parentItem->itemName, ['item/view', 'id' => $model->parentItem->itemId]) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
