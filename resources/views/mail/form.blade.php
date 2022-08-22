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
                        <div class="form-group mb-3">
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
                            <div class="form-group mb-3">
                                <label for="name">{{__('name')}}</label>
                                <input type="string" id="name" class="form-control" name="name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">{{__('email')}}</label>
                                <input type="string" id="email" class="form-control" name="email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="subject">{{__('subject')}}</label>
                                <input type="string" id="subject" class="form-control" name="subject">
                            @error('subject')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">{{__('content')}}</label>
                                <textarea id="content" class="form-control" name="content"></textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="content">{{__('captcha')}}</label>
                                <div class="form-group">
                                    <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                    </button>
                                </div>
                                 <input id="captcha" type="text" class="form-control" placeholder="{{ __('enter captcha') }}" name="captcha">
                                @error('captcha')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                            <div class="form-group mb-3">
                                <button role="submit" class="btn btn-primary">{{__('send')}} <i class="fa-solid fa-envelope"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '/reload-captcha',
            crossDomain: true,
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script>
@endsection
