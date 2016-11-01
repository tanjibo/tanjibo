@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <ul>
                            @foreach($articles as $v)
                                <li>
                                     <div class="title">
                                         <a href="">{{$v->title}}</a>
                                     </div>
                                     <div>
                                         <p>{{$v->body}}</p>
                                     </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
