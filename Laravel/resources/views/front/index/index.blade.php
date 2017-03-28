
@extends('layouts.front')



@section('content')
        <link rel="stylesheet" href="/front/css/index.css">
        <div class="container-fluids">
            <li><a href="">dddd</a></li>
        </div>
        <div class="container">
            <!-- Example row of columns -->

            <div class="row">
                @foreach($posts as $key=>$v)
                <div class="col-md-4">
                    <h2>{{$v->title}} {{$v->category->name}}</h2>
                    <p>{{$v->content}}</p>
                    <p><a class="btn btn-default" href="{{url('details/'.$v->id)}}" role="button">View details »</a></p>
                </div>
                @endforeach
            </div>
        </div>
      <div class="container">
          {{$posts->links()}}
      </div>

@endsection