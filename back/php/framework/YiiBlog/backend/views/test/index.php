<?php
 use yii\widgets\Breadcrumbs
 ?>

<?php echo Breadcrumbs::widget([
  'homeLink'=>['label'=>'首页','url'=>['user/index','id'=>'1']],
  'itemTemplate'=>'<li><b>{link}</b></li>',
  'links'=>[
    ['label'=>'用户列表','url'=>['user/index','id'=>1]],
    '添加用户',

  ],
  'options'=>['class'=>'breadcrumb aaa']
]);
?>
