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
                                    <td><a href={{ route('admin.userEdit', ['id' => $user->id]) }}>{{$user->name}}</a></td>
                                    <td>@if($user->admin == 1) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-xmark"></i> @endif</td>
                                    <td>
                                        <a href={{route('admin.userDelete', ['id' => $user->id])}} class="btn btn-danger">X</a>
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

@endsection
