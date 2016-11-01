@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新增一篇文章
                </div>
                <div class="panel-body">
                    @if(count($errors)>0)
                         <div class="alert alert-danger">
                             <strong>新增失败</strong>
                             {!! implode('<br/>',$errors->all()) !!}
                         </div>
                        @endif
                        <form action="{{url('admin/article')}}" method="post">
                            {!! csrf_field() !!}
                            <input type="text" name="title" class="form-control" required="true">
                            <input type="text" name="body" class="form-control" required="true">
                            <input type="submit" value="新增文章" class="btn btn-lg btn-primary btn-block">
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection