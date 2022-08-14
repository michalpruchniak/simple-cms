@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action={{route('admin.userStore')}} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{__('name')}}</label>
                            <input class="form-control" id="name" name="name" value=@if(isset($user)) {{ $user->name }} @else {{ old('name')}} @endif >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">{{__('email')}}</label>
                            <input class="form-control" id="email" name="email" value=@if(isset($user)) {{ $user->email }} @else {{ old('email')}} @endif >
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">{{__('default password')}}</label>
                            <input class="form-control" type="password" id="password" name="password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check">
                        <input name="admin" class="form-check-input" type="checkbox" value="1" id="admin" @if((isset($user) && $user->admin == 1) || old('name') == 1) checked @endif>
                        <label class="form-check-label" for="admin">
                            {{__('admin')}}
                        </label>
                            @error('admin')
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

@endsection
