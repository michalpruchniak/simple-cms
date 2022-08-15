@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">{{$article->title}}</h2>
                    <p><small>{{__('made by')}} {{$article->user->name}}</small></p>
                    @if(isset($article->cover))
                        <img src="{{asset('covers')}}/{{$article->cover}}" class="img-fluid" alt="{{$article->title}}" >
                    @endif
                    <p>{!! $article->description !!}</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
