<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'itemCategory')->dropDownList(
                                                    ArrayHelper::map(Category::find()->orderBy(['categoryName' => SORT_ASC])->asArray()->all(), 'categoryId', 'categoryName'),
                                                    ['prompt' => Yii::t('app', 'Select Category') . '...']
                                                ); ?>

    <?= $form->field($model, 'itemName') ?>

    <?= $form->field($model, 'itemMinStock') ?>

    <?= $form->field($model, 'itemActStock')->textInput([
                                                    'readonly' => true,
                                                    'value' => '0',
                                                ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
