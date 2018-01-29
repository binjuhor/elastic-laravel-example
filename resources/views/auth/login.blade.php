@extends('layouts.userlog')
@section('content')
<div class="full-page login-page" data-color="orange" data-image="/img/full-screen-image-1.jpg">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <form method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="card card-hidden">
                            <div class="header text-center">Login</div>
                            <div class="content">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" placeholder="Enter email" name="email" class="form-control value="{{ old('email') }}" >
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" placeholder="Password" class="form-control"  name="password">
                                     @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="checkbox">
                                        <input type="checkbox" data-toggle="checkbox" name="remember" value="">Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-fill btn-warning btn-wd">Login</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection