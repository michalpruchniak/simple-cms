@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('contact') }}</div>

                <div class="card-body">
                    <form action="{{route('contact.send')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="department">{{__('department')}}</label>
                            <select id="department" class="form-control" name="department">
                                <option value="team-leader@company.com">{{__('team leader')}}</option>
                                <option value="programming@company.com">{{__('programming department')}}</option>
                                <option value="hr@company.com">{{__('hr')}}</option>
                            </select>
                            @error('department')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                            <div class="form-group">
                                <label for="name">{{__('name')}}</label>
                                <input type="string" id="name" class="form-control" name="name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('email')}}</label>
                                <input type="string" id="email" class="form-control" name="email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="subject">{{__('subject')}}</label>
                                <input type="string" id="subject" class="form-control" name="subject">
                            @error('subject')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="content">{{__('content')}}</label>
                                <textarea id="content" class="form-control" name="content"></textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <button role="submit" class="btn btn-primary">{{__('send')}} <i class="fa-solid fa-envelope"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
