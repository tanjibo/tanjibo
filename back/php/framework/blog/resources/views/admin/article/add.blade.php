@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">文章列表</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/article')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>所属分类：</th>
                        <td>
                            <select name="c_id">
                                 @foreach ($data as $v)
                                <option value="{{$v['c_id']}}">{{$v['_cate_name']}}</option>
                                 @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" class="md" name="title">
                        </td>
                    </tr>
                    <tr>
                        <th>发布人：</th>
                        <td>
                            <input type="text" name="author" class="md">

                        </td>
                    </tr>
                    <tr>
                        <th class="imgWrap"><i class="require">*</i>缩略图：</th>
                        <td>
                            <input type="text" class="md" name="thumbnail">
                            <style type="text/css">
                                #file_upload{

                                    display:inline-block;

                                }
                                #file_upload-button{
                                    border-radius: 0;
                                    color:white;
                                    background:none;
                                }
                            </style>
                            <script src="{{asset('resources/orgs/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                            <link rel="stylesheet" type="text/css" href="{{asset('resources/orgs/uploadify/uploadify.css')}}">
                            	<input id="file_upload" name="file_upload" type="file" multiple="true">
                                <script type="text/javascript">
                            		<?php $timestamp = time();?>
                            		$(function() {
                            			$('#file_upload').uploadify({
                                            'buttonText' : '上传图片',
                            				'formData'     : {
                            					'timestamp' :"<?php echo time();?>",
                            					'_token'     : "{{csrf_token()}}"
                            				},
                            				'swf'      : "{{asset('resources/orgs/uploadify/uploadify.swf')}}",
                            				'uploader' : "{{url('admin/common/upload')}}",
                                            'onUploadSuccess' : function(file, data, response) {
                                                 var data=JSON.parse(data);
                                                 $('input[name=thumbnail]').val(data.data);

                                                if(data.status){

                                                    var imgObj=new Image();
                                                    imgObj.src=data.data;
                                                    imgObj.onload=function(){
                                                        var h=this.height;
                                                        var w=this.width;
                                                        if(this.height>1000)
                                                        h=h*0.45;
                                                        if(this.width>1000)
                                                        w=w*0.45;
                                                        var tmp="<img src="+data.data+" style='width:"+w+"px;max-width:150px;max-height:150px;height:"+h+"px;'/>";
                                                        $('.imgWrap').siblings().append(tmp);


                                                    }
                                                }


                                           }

                            			});
                            		});
                            	</script>

                        </td>

                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="desc"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>关键字：:</th>
                        <td>
                            <textarea name="keywords"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>正文内容:</th>
                        <td>
                             <style style="text/css">
                             .edui-default{line-height: 28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden; height:22px;}
                             </style>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/orgs/ueditor1.4.3.3/ueditor.config.js')}}"></script>
                           <script type="text/javascript" charset="utf-8" src="{{asset('resources/orgs/ueditor1.4.3.3/ueditor.all.min.js')}}"> </script>
                           <script type="text/javascript" charset="utf-8" src="{{asset('resources/orgs/ueditor1.4.3.3/lang/zh-cn/zh-cn.js')}}"></script>

                             <script id="editor" name="content" type="text/plain" style="width:800px;height:500px;"></script>

                             <script type="text/javascript">
                                  var ue = UE.getEditor('editor');

                             </script>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script type="text/javascript">

    </script>

@endsection
