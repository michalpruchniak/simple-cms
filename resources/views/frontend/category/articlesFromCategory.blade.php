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
                  @foreach($category->articles as $article)
                    {{ $article->title }}
                  @endforeach
                @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
