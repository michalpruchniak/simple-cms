@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('title')}}</th>
                                <th scope="col">{{__('category')}}</th>
                                <th scope="col">{{__('user')}}</th>
                                <th scope="col">{{__('accept')}}?</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($articles as $article)
                                <tr>
                                    <th scope="row">{{$article->id}}</th>
                                    <td>{{$article->title}}</td>
                                    <td>{{$article->category->name}}</td>
                                    <td>{{$article->user->name}}</td>
                                    <td>
                                        @if($article->accept == 1)
                                            <a href={{route('admin.articleAccept', ['id' => $article->id])}} class="btn btn-danger">{{__('remove accept')}}</a>
                                        @else
                                            <a href={{route('admin.articleAccept', ['id' => $article->id])}} class="btn btn-success">{{__('accept')}}</a>
                                        @endif
                                    </td>
                                </tr>
                    @endforeach

                            </tbody>
                            </table>
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
          ['image', 'code-block']
        ]
      },
      placeholder: 'Compose an epic...',
      theme: 'snow'  // or 'bubble'
    });

$(document).ready(function(){
  $("#theform").on("submit", function () {
    let value = $('#editor-container .ql-editor').html();
    $(this).append("<textarea name='description' style='display:none'>"+value+"</textarea>");
   });
});
</script>

@endsection
