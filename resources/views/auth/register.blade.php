@extends('layouts.userlog')
@section('content')
<div class="full-page register-page" data-color="orange" data-image="/img/full-screen-image-2.jpg">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="header-text">
                        <h2>Pickinside</h2>
                        <h4>Register for free and experience the dashboard today</h4>
                        <hr />
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <div class="media">
                        <div class="media-left">
                            <div class="icon">
                                <i class="pe-7s-user"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4>Free Account</h4>
                            Here you can write a feature description for your dashboard, let the users know what is the value that you give them.
                        </div>
                    </div>

                    <div class="media">
                        <div class="media-left">
                            <div class="icon">
                                <i class="pe-7s-graph1"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4>Awesome Performances</h4>
                            Here you can write a feature description for your dashboard, let the users know what is the value that you give them.

                        </div>
                    </div>

                    <div class="media">
                        <div class="media-left">
                            <div class="icon">
                                <i class="pe-7s-headphones"></i>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4>Global Support</h4>
                            Here you can write a feature description for your dashboard, let the users know what is the value that you give them.

                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-md-offset-s1">
                    <form method="post" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="card card-plain">
                            <div class="content">
                                <div class="form-group">
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input type="password" id="new-password" name="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" id="cf-password" name="password_confirmation" placeholder="Password Confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" id="regisger-button" class="btn btn-fill btn-neutral btn-wd">Create Free Account</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extrajs')
<script type="text/javascript">
    (function($){
        "use strict";
        $('#regisger-button').click(function(event) {
            if ($('#new-password').val() === $('#cf-password').val()) {
                return true;
            }else{
                swal("Your password do not match!");
            }
            return false;
        });
    })(jQuery)
</script>
@endsection