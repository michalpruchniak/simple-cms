@extends('layouts.app')
@section('assets')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@if(isset($article)) {{ __('update article') }} @else {{ __('create article') }} @endif</div>

                <div class="card-body">
                    <form action="@if(isset($article)) {{route('article.update', ['id' => $article->id])}} @else {{route('article.store')}} @endif" method="POST" id="theform" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">{{__('title')}}</label>
                            <input class="form-control mb-3" id="title" name="title" value="@if(isset($article) && !old('title')) {{$article->title}} @else {{old('title')}} @endif" >
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('description')}}</label>
                            <div id="editor-container">
                                @if(isset($article) && !old('description')) {!! $article->description !!} @else {!! old('description') !!} @endif
                            </div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('category')}}</label>
                            <select class="form-control mb-3" name="category">
                                @foreach ($categories as $category )
                                    @if(isset($article) && !old('category'))
                                        <option value={{$category->id}}  @if($article->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                    @else
                                        <option value={{$category->id}}  @if(old('category') == $category->id) selected @endif>{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('upload file')}}
                            <input class="form-control mb-3" type="file" name="file">
                            @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('language')}}</label>
                            <select class="form-control mb-3" name="language">
                                @if(isset($article) && !old('language'))
                                    <option value="en" @if($article->lang == "en") selected @endif>EN</option>
                                    <option value="pl" @if($article->lang == "pl") selected @endif>PL</option>
                                @else
                                    <option value="en" @if(old('language') == "en") selected @endif>EN</option>
                                    <option value="pl" @if(old('language') == "pl") selected @endif>PL</option>
                                @endif
                            </select>
                            @error('language')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" role="submit">{{__('save')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    let quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                    [{ 'direction': 'rtl' }],                         // text direction

                    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'font': [] }],
                    [{ 'align': [] }],

                    ['clean']
            ]
        },
        theme: 'snow'
        });


    $(document).ready(function(){
        $("#theform").on("submit", function () {
            let value = $('#editor-container .ql-editor').html();
            $(this).append("<textarea name='description' style='display:none'>"+value+"</textarea>");
        });
    });
</script>

@endsection
