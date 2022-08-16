@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__($title)}}</div>

                <div class="card-body">
                    <div class="flex-box">
                    @if($articles->count() < 1)
                    @include('messages.error', ['message' => 'dont have articles'])
                    @endif
                    @foreach($articles as $article)
                        <div class="single-article" style="background-image: url(@if(isset($article->cover)){{asset('covers')}}/{{$article->cover}} @else {{asset('covers')}}/default.jpg @endif)">
                            <div class="article-details">
                                <h5><a href="{{route('article', ['slug' => $article->slug])}}">{{ $article->title }}</h5>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
