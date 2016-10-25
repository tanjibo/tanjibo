@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index/index')}}">首页</a> &raquo; <a href="#">分类管理</a> &raquo; 添加分类
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增分类</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->


    <div class="result_wrap">
        @include('common.errors')
        <form action="{{url('admin/category/'.$field->c_id.'')}}" method="post">
            <table class="add_tab">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="pid">
                                <option value="0">==顶级分类==</option>
                                @foreach($data as $v)
                                  <option value="{{$v['c_id']}}"  <?php if($v['c_id']==$field['pid']) echo 'selected';?>>{{$v['_cate_name']}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类名称：</th>
                        <td>
                            <input type="text" class="md" name="cate_name" value="{{$field['cate_name']}}">
                            <span>

                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>标题：</th>
                        <td>
                            <input type="text"  class="md" name="title" value="{{$field->title}}">
                            <span>

                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>关键字：</th>
                        <td>
                            <input type="text" class="md" name="keywords"  value="{{$field->keywords}}">
                            <span>

                        </td>
                    </tr>



                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="desc">{{$field->desc}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>remark:</th>
                        <td>
                            <textarea name="remark"> {{$field->remark}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>签名:</th>
                        <td>
                            <textarea name="sign">{{$field->sign}}</textarea>
                        </td>
                    </tr>

                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text"  class="lg" name="cate_order" value="0">

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

@endsection
