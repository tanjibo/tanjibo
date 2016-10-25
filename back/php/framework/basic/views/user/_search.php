<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'mobile_phone') ?>

    <?= $form->field($model, 'login_pwd') ?>

    <?= $form->field($model, 'nickname') ?>

    <?= $form->field($model, 'head_url') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <?php // echo $form->field($model, 'ping_num') ?>

    <?php // echo $form->field($model, 'integral') ?>

    <?php // echo $form->field($model, 'is_lock') ?>

    <?php // echo $form->field($model, 'reg_client_id') ?>

    <?php // echo $form->field($model, 'delivery_address_id') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
