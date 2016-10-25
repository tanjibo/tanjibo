<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Status;

?>


<?php $form=ActiveForm::begin();?>

<?php echo $form->field($model,'text')->textArea(['rows'=>4])->label('status update');?>

<?php echo $form->field($model,'permissions')->dropDownList($model->getPermissions(),['prompt'=>'dddd']);?>

<?php echo Html::submitButton('Submit',['class'=>'btn btn-primary']);?>

<?php ActiveForm::end();?>
