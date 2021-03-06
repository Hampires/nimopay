@extends('layouts.front', ['title' => __('User Profile')])
@if (strlen(env('RECAPTCHA_SITE_KEY',""))>2)
    @section('head')
    {!! htmlScriptTagJsApi([]) !!}
    @endsection
@endif

@section('content')
    @include('users.partials.header', [
        'title' => __(''),
    ])


    <div class="container-fluid mt--7">
        <div class="row">

            </div>
            <div class="col-xl-8 offset-xl-2">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Register your business') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form  id="registerform" method="post" action="{{ route('newbusiness.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Business information') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name">{{ __('Business Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Business Name here') }} ..." value="{{ isset($_GET["name"])?$_GET['name']:""}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('placeholder') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="placeholder">{{ __('Business Placeholder') }}</label>
                                    <input type="text" name="placeholder" id="placeholder" class="form-control form-control-alternative{{ $errors->has('placeholder') ? ' is-invalid' : '' }}" placeholder="{{ __('Service offered by Table, Seat, Room etc...') }} ..." value="{{ isset($_GET["placeholder"])?$_GET['placeholder']:""}}" required autofocus>
                                    @if ($errors->has('placeholder'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('placeholder') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('enterprise') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="enterprise">{{ __('Business Category') }}</label>
                                    <br />
                                    <select class="w-100 form-control form-control-alternative   @isset($classselect) {{$classselect}} @endisset"  name="enterprise" id="enterprise">
                                        <option disabled selected value> {{ __('Select')." ".__('Business Category')}} </option>
                                        @foreach($enterprises as $enterprise)
                                            <option value="{{ $enterprise->id }}">{{ __(ucwords($enterprise->name)) }}</option>
                                        @endforeach
                                    </select>
                                    <style>
                                        .select2-container {
                                            width: 100% !important;
                                        }
                                    </style>
                                </div>
                                
                            </div>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-4">{{ __('Owner information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name_owner">{{ __('Owner Name') }}</label>
                                    <input type="text" name="name_owner" id="name_owner" class="form-control form-control-alternative{{ $errors->has('name_owner') ? ' is-invalid' : '' }}" placeholder="{{ __('Owner Name here') }} ..." value="{{ isset($_GET["name"])?$_GET['name']:""}}" required autofocus>

                                    @if ($errors->has('name_owner'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name_owner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email_owner') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="email_owner">{{ __('Owner Email') }}</label>
                                    <input type="email" name="email_owner" id="email_owner" class="form-control form-control-alternative{{ $errors->has('email_owner') ? ' is-invalid' : '' }}" placeholder="{{ __('Owner Email here') }} ..." value="{{ isset($_GET["email"])?$_GET['email']:""}}" required autofocus>

                                    @if ($errors->has('email_owner'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email_owner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone_owner') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="phone_owner">{{ __('Owner Phone') }}</label>
                                    <input type="text" name="phone_owner" id="phone_owner" class="form-control form-control-alternative{{ $errors->has('phone_owner') ? ' is-invalid' : '' }}" placeholder="{{ __('Owner Phone here') }} ..." value="{{ isset($_GET["phone"])?$_GET['phone']:""}}" required autofocus>

                                    @if ($errors->has('phone_owner'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_owner') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    @if (strlen(env('RECAPTCHA_SITE_KEY',""))>2)
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif

                                        {!! htmlFormButton(__('Save'), ['id'=>'thesubmitbtn','class' => 'btn btn-success mt-4']) !!}
                                    @else
                                        <button type="submit" id="thesubmitbtn" class="btn btn-success mt-4">{{__('Save')}}</button>
                                    @endif


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    </div>
@endsection

@section('js')
@if (isset($_GET['name'])&&$errors->isEmpty())
<script>
    "use strict";
    document.getElementById("thesubmitbtn").click();
</script>
@endif
@endsection
