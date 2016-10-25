<?php
use yii\jui\DatePicker;
?>
<?= DatePicker::widget(['name'=>'date'])?>
<div>
  <form method="post" action="">
    <input type="text" name="username" value="">
    <input type="password" name="password" value="">
    <input type="submit"  value="提交">
 </form>
</div>
