<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        ['label' => '用户列表', 'url' => ['user/index']],
        '添加用户',
    ],
]);?>


<div class="inner-container">
	<?=Html::beginForm(['user/add'], 'post', ['enctype' => 'multipart/form-data', 'name' => '', 'class' => 'form-horizontal', 'id' => 'addForm', 'role' => 'form']);?>

			<div class="form-group">
				<?=Html::label('用户名*:', '', ['class' => 'control-label col-sm-2 col-md-1']);?>
				<div class="controls col-sm-10 col-md-11">
				<?=Html::activeInput('text', $model, 'username', ['class' => 'form-control input', 'placeholder' => '你的用户名']);?>
        <?=Html::error($model, 'username')?>
			</div>
		</div>

			<div class="form-group">
				<?=Html::label('密码*:', '', ['class' => 'control-label col-sm-2 col-md-1']);?>
				<div class="controls col-sm-10 col-md-11">
				<?=Html::activeInput('password', $model, 'password', ['onclick' => 'add();', 'class' => 'form-control input', 'placeholder' => '你的密码']);?>
        <?=Html::error($model, 'password')?>
			</div>
		</div>


		<div class="form-group">
			<?=Html::label('是否开启', '', ['class' => 'control-label col-sm-2 col-md-1'])?>
			<div class="controls col-sm-10 col-md-11">
				<?=Html::activeDropDownList($model,'status',[''=>'请选择','1'=>'开启','0'=>'禁用','3'=>'dd'],['class'=>'form-control width_auto'])?>
				<?=Html::error($model,'status')?>
			 </div>
		</div>


		<div class="form-group">
		 	<div style="margin-top:10px" class="col-sm-10 col-sm-offset-2 col-md-11 col-md-offset-1">
		 		<button class="btn btn-primary" type="submit">提交</button>
				<a class="btn btn-primary" href="<?php echo Url::to(['user/index']);?>">返回</a>
		 	</div>
		</div>
	<?php echo Html::endForm();?>
	<?=Html::tag('script');?>
	<?=Html::beginTag('script', ['type' => 'text/javascript']);?>
	<!-- alert(111) -->
	<?=Html::endTag('script')?>
</div>
