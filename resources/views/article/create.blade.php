@extends('layouts.app')
@section('assets')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>


@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{route('article.store')}}" method="POST" id="theform" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">{{__('title')}}</label>
                            <input class="form-control" id="title" name="title" />
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('description')}}</label>
                            <div id="editor">
                            </div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{__('upload file')}}
                            <input class="form-control" type="file" name="file">
                        </div>
                        <button class="btn btn-primary" role="submit">{{__('store')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
    <script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });

</script>
    <script>
$(document).ready(function(){
  $("#theform").on("submit", function () {
    let value = $('#editor .ql-editor').html();
    $(this).append("<textarea name='description' style='display:none'>"+value+"</textarea>");
   });
});
    </script>
@endsection
