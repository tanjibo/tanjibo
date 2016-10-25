<?php
use app\assets\FrontendAsset;
use yii\web\View;

FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?= $this->head();?>
  </head>
<?php $this->beginBody() ?>
  <body>

    <?php echo $content;?>
  </body>
<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
