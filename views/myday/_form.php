<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Myday */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="myday-form">

    <?php $form = ActiveForm::begin(); ?>

   

    <?= $form->field($model, 'til')->textInput(['maxlength' => true])->label('Topic :') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Description :') ?>

    <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
