@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('all articles') }}</div>
                <div class="card-body">
                    @if($articles->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('title')}}</th>
                                <th scope="col">{{__('category')}}</th>
                                <th scope="col">{{__('accept')}}?</th>
                                <th scope="col">{{__('delete')}}?</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($articles as $article)
                                <tr>
                                    <th scope="row">{{$article->id}}</th>
                                    <td>{{$article->title}}</td>
                                    <td>{{$article->category->name}}</td>
                                    <td>
                                        @if($article->accept == 1)
                                            <i class="fa-solid fa-check"></i>
                                        @else
                                            <i class="fa-solid fa-xmark"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-article" data-toggle="modal" data-id={{$article->id}} data-target="#modalConfirmation">
                                                <i class="fa-solid fa-trash-can"></i> {{__('delete')}}
                                          </button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            </table>
                            @else
                            @include('messages.error', ['message' => 'there are no articles'])
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalConfirmation">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">{{__('delete article')}}</h4>
        </div>

        <div class="modal-body">
            {{__('are you sure that you want to delete article')}}
            <form action={{route('article.delete')}} method="POST">
            @csrf
            <input type="string" name="articleId" class="article-id invisible">

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> {{__('delete')}}</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <script>
      $(document).on("click", ".remove-article", function () {
        let ArticleID = $(this).data('id');
        $(".modal-body .article-id").val( ArticleID );
      });
  </script>

@endsection
