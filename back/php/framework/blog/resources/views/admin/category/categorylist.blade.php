@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index/info')}}">首页</a> &raquo; <a href="{{url('admin/category/index')}}">分类管理</a> &raquo; 分类列表
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->

    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>新增分类</a>

                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>

                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>分类名称</th>
                        <th>点击次数</th>
                        <th>操作</th>
                    </tr>
					@foreach($data as $v)
                    <tr>

                        <td class="tc">
                            <input type="text" name="ord[]" value="{{$v['cate_order']}}"  onchange="changeOrd(this,{{$v['c_id']}})">
                        </td>
                        <td class="tc">{{$v['c_id']}}</td>
                        <td>
                            <a href="#">{{$v['_cate_name']}}</a>
                        </td>
                        <td>0</td>

                        <td>
                            <a href="{{url('admin/category/'.$v['c_id'].'/edit')}}">修改</a>
                            <a href="#" onclick="return del({{$v['c_id']}});">删除</a>
                        </td>
                    </tr>
					@endforeach
                </table>


<div class="page_nav">

</div>



            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

	<script type="text/javascript">
	    function changeOrd(obj,id){
           var ord_id=$(obj).val().trim();

		   if(isNaN(ord_id)){
			   layer.msg('请输入数字');
		   }
			$.post("{{url('admin/category/changeord')}}",{id:id, _token:'{{csrf_token()}}',ord_id:ord_id},function(data){

					layer.msg(data.msg,function(){
						window.location.reload();
					});

			})

			return false;
		}

        /*
         * 删除
         */
        function del(id){
            $data={
                '_token':"{{csrf_token()}}",
                '_method':'DELETE',
                'id':id
            }
            layer.confirm('你确定删除当前分类？', {
              btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/category')}}/"+id,$data,function(data){
                   if(data.status){
                       layer.msg(data.msg,function(){
                         window.location.reload();
                       })
                   }else{
                       layer.msg(data.msg);
                   }
                })
            }, function(){

            });

        }
	</script>
	@endsection
