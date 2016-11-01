@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel-default">
                    <div class="panel-heading">文章管理</div>
                    <div class="panel-body">
                        @if (count($errors)>0)
                            <div class="alert alert-danger">
                                {!! implode('<br/>',$errors->all())!!}
                            </div>
                        @endif

                        <a href="{{url('admin/article/create')}}" class="btn btn-lg btn-primary">新增</a>
                        @foreach($articles as $v)
                            <h4>{{$v->title}}</h4>
                            <p>{{$v->body}}</p>
                            <a href="{{url('admin/article/".$v->id."/edit')}}" class="btn btn-lg btn-block btn-success">修改</a>
                            <form method="post" action="{{url('admin/article/'.$v->id)}}">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection