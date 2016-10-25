<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\LinkPager;
echo Breadcrumbs::widget([
	'homeLink'=>['label'=>'首页'],
	'links'=>[
		['label'=>'用户列表','url'=>['user/index']]
	]
]);
?>

<div class="inner-container">
	<p class="text-right">
		<a class="btn btn-primary btn-middle" href="<?=Url::to(['user/add'])?>">添加</a>
		<a id="delete-btn" class="btn btn-primary btn-middle">删除</a>
	</p>
	<form method="post" action="/mrsblog/backend/web/index.php?r=slideshow%2Fdelete" id="dltForm">
		<table class="table table-hover">
			<thead>
				<tr>
						<th class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked',this.checked);"></th>
						<th>用户名</th>

				</tr>

					<?php foreach ($data as $key => $value) {?>

							<tr>
									<th class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked',this.checked);"></th>
						 <td><?=$value['username'];?></td>
						 </tr>
					<?php }?>

			</thead>

		</table>
	</form>
<?=LinkPager::widget(['pagination'=>$p])?>
</div>
<script type="text/javascript">
$(function(){
	$("#delete-btn").click(function(){
		if(confirm('您确定要删除 ,这是不可恢复操作')){
			$("#dltForm").submit();
		}
	});

	$(".data_delete").click(function(){
		$("#dltForm").find('input[type=checkbox]').prop('checked' , false);
		$(this).parent().parent().find('input[type=checkbox]').prop('checked' , true);
		$("#delete-btn").click();
	});

});
</script>
