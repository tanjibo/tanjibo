<?php
 use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\Helpers\widgets;
use yii\captcha\Captcha;

LoginAsset::register($this);
 ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>smister后台登录</title>
  <?php $this->head() ?>

</head>

<body>
  <?php $this->beginBody() ?>
   <div id="login_box">
   <h1>smister后台登录</h1>

   <?=Html::beginForm(['login/index'], 'post', ['id' => 'form'])?>

		  <ul>
			 <li class="text">
         用户名：<?php echo Html::activeTextInput($model, 'username',['class'=>'input']);?>
       </li>
			 <li class="tip">&nbsp;<div class="error"><?=Html::error($model,'username');?></div></li>

			 <li>密&emsp;&emsp;&emsp;码：
         <?= Html::activePasswordInput($model, 'password',['class'=>"input"]);?>

			 <li class="tip">&nbsp;<div class="error"><?=Html::error($model,'password');?></div></li>

       <li style="position:relative;">验证码：
        <?php echo Captcha::widget([
          'model'=>$model,
          'attribute'=>'code',
          'template'=>'{input}{image}',
          'captchaAction'=>'login/captcha',

          'options'=>[
            'class'=>'input verifycode',

          ],
          'imageOptions'=>[
            'alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer'
          ]
        ]);?>

       </li>
			 <li class="tip">&nbsp;<div class="error"><?=Html::error($model,'code');?></div></li>

       	 <li class="tip remember">
           <input type="checkbox" id="remember" name="LoginForm[remember]" value="1">
           <label for="remember">&nbsp;保持登录状态</label>
         </li>
		  </ul>
		  <div>
        <?php echo Html::submitInput( '登陆',['id'=>'login_submit','style'=>"border:none"]);?>
		  </div>
	   </div>
	  <?=Html::endForm();?>
   </div>
   <?php $this->endBody()?>
</body>

</html>
<?php $this->endPage()?>
