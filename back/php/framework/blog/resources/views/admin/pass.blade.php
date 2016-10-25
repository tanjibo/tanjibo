@extends('layouts.admin')


@section('content')
    <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 修改密码
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form method="post">
         {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>原密码：</th>
                <td>
                    <input type="password" name="password_o">
                    <i  class="warnning">请输入原始密码</i>
                     <!-- <i class="error">请输入原始密码</i> -->
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>新密码：</th>
                <td>
                    <input type="password" id="password" name="password">
                    <i class="warnning">新密码6-20位</i>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>确认密码：</th>
                <td>
                    <input type="password" name="password_c">
                    <i class="warnning">再次输入密码</i>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <!-- <input type="button" class="back" onclick="history.go(-1)" value="返回"> -->
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<script type="text/javascript">

$(function(){
//     $.validator.setDefaults({
//
// 	showErrors: function(map, list) {
// 		// there's probably a way to simplify this
// 		// var focussed = document.activeElement;
// 		// if (focussed && $(focussed).is("input, textarea")) {
// 		// 	$(this.currentForm).tooltip("close", {
// 		// 		currentTarget: focussed
// 		// 	}, true)
// 		// }
// 		// this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
// 		$.each(list, function(index, error) {
//              $(error.element).siblings('i').text(error.message);
// 			// $(error.element).attr("title", error.message).addClass("ui-state-highlight");
// 		})
// 		// if (focussed && $(focussed).is("input, textarea")) {
// 		// 	$(this.currentForm).tooltip("open", {
// 		// 		target: focussed
// 		// 	});
// 		// }
// 	}
// });

    var validator=$('form').validate({
        //debug:true,
        rules:{
            'password_o':{
                required:true,
                rangelength:[6,12],
                'remote':{
                    url:"{{url('admin/index/remotepwd')}}",
                    type:'post',
                    dataType:"json",
                    data:{
                      '_token':"{{csrf_token()}}",
                      'password_o':function(){
                          return $('input[name=password_o]').val().trim();
                      }
                    }

                }
            },
            password:{
                required:true,
                rangelength:[6,12]
            },
            'password_c':{
                required:true,
                equalTo:'#password'
            }
        },
        messages:{
            password:{
                required:'不能为空',
                rangelength:'密码长度为6到12位',


            },
            'password_o':{
                required:'不能为空',
                rangelength:'密码长度为6到12位',
                'remote':"原密码错误",
            },
            'password_c':{
                 required:'不能为空',
                 equalTo:'两次密码不一致',
            }
        },
        errorElement:'i',
        errorClass:'error',
        validClass:'success',
        //errorContainer:'.tip',
        // errorLabelContainer:'#info',
        // wrapper:'ul',
        errorPlacement: function(error, element) {

             $(element).siblings('i').remove();
             $(element).removeClass('error');
             error.appendTo(element.parent());


        },
        submitHandler:function(form){
             var data=$(form).serialize();
             $.post("{{url('admin/index/chpwd')}}",data,function(data){
                 layer.msg(data.msg,{

                 },function(){
                      window.location.reload();
                 });

             });
            return false;
        },

        success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					 //console.log(label);
                    // console.log(element);
                    $(element).removeClass('success');
					 $(label).addClass('success').text('输入正确');
				},

        highlight:function(element,errorClass,validClass){
            // $(element).addClass(errorClass).removeClass(validClass);
            $(element).fadeOut().fadeIn();
        },
        unhighlight:function(element,errorClass,validClass){
            // $(element).addClass(validClass).removeClass(errorClass);
        }
    })
})
</script>
@endsection
