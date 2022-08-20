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
                <div class="card-header">{{ __('create article') }}</div>

                <div class="card-body">
                    <form action="{{route('article.store')}}" method="POST" id="theform" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">{{__('title')}}</label>
                            <input class="form-control mb-3" id="title" name="title" value={{old('title')}} >
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('description')}}</label>
                            <div id="editor-container">
                                {{old('description')}}
                            </div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>{{__('category')}}</label>
                            <select class="form-control mb-3" name="category">
                                @foreach ($categories as $category )
                                    <option value={{$category->id}} @if(old('category') == $category->id) selected @endif>{{$category->name}}</option>
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
                                <option value="en" @if(old('language') == "en") selected @endif>EN</option>
                                <option value="pl" @if(old('language') == "pl") selected @endif>PL</option>
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
var quill = new Quill('#editor-container', {
    modules: {
        toolbar: [
          [{ header: [1, 2, false] }],
          ['bold', 'italic', 'underline'],
          ['code-block']
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
