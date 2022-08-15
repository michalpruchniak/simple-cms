@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                @if(!$category || $category->articles->count() == 0)
                    @include('messages.error', ['message' => 'this category does\'t exist or category is empty'])
                @else
                    <div class="flex-box">
                    @foreach($category->articles as $article)
                        <div class="single-article" style="background-image: url(@if(isset($article->cover)){{asset('covers')}}/{{$article->cover}} @else {{asset('covers')}}/default.jpg @endif)">
                            <div class="article-details">
                                <h5>{{ $article->title }}</h5>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
