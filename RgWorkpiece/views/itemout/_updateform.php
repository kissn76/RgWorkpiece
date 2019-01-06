<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Itmout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itmout-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'itemoutItem', ['template' => '{input} {hint} {error}',])->hiddenInput() ?>

    <?= $form->field($model, 'itemoutAmount')->textInput([
                                                    'readonly' => true,
                                                ]) ?>

    <?= $form->field($model, 'itemoutComment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
