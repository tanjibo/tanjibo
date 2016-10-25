<?php $this->beginBlock('loginForm');?>
<div class="container">
  <form class="" action="" method="post">
    <input type="text" name="username" value="">
    <input type="password" name="password" value="">
     <input type="submit" value="提交">
  </form>
  <?php $this->endBlock();?>
<?php
 use app\assets\FrontendAsset;
 use yii\web\View;

 // FrontendAsset::register($this);
 FrontendAsset::addScript($this,'@web/frontend/js/com.js');
 ?>
 <div class="top_nav">
   <section class="">
       fdsfsdf
   </section>
   <section>

   </section>
 </div>
 <div class='left'>

 </div>
 <div class="right">

 </div>
