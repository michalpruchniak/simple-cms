@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('all users') }}</div>
                <div class="card-body">
                    @if($users->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('name')}}</th>
                                <th scope="col">{{__('admin')}}?</th>
                                <th scope="col">{{__('delete')}}?</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td><a href={{ route('admin.user.edit', ['id' => $user->id]) }}>{{$user->name}}</a></td>
                                    <td>@if($user->admin == 1) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-xmark"></i> @endif</td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-article" data-toggle="modal" data-id={{$user->id}} data-target="#modalConfirmation">
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
          <h4 class="modal-title">{{__('delete user')}}</h4>
        </div>

        <div class="modal-body">
            {{__('are you sure that you want to delete user')}}
            <form action={{route('admin.user.delete')}} method="POST">
            @csrf
            <input type="string" name="userId" class="article-id invisible">

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
      $(document).on("click", ".delete-article", function () {
        let ArticleID = $(this).data('id');
        $(".modal-body .article-id").val( ArticleID );
      });
  </script>
@endsection
