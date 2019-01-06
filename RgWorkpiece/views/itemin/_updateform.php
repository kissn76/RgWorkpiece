<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Itemin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="itemin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iteminItem', ['template' => '{input} {hint} {error}',])->hiddenInput() ?>

    <?= $form->field($model, 'iteminAmount')->textInput([
                                                    'readonly' => true,
                                                ]) ?>

    <?= $form->field($model, 'iteminComment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
