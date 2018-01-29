@extends('layouts.app')

@section('header')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">

                        <form id="inputUserinfo" action="{{action('UserController@store')}}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Short Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="@if(isset($user)){{$user->name}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="firstName" value="@if(isset($userInfo[0]->firstName)){{$userInfo[0]->firstName}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="lastName" value="@if(isset($userInfo[0]->lastName)){{$userInfo[0]->lastName}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email" value="@if(isset($user)){{$user->email}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Company</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="company" value="@if(isset($userInfo[0]->company)){{$userInfo[0]->company}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Birth date</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="birthdate" value="@if(isset($userInfo[0]->birthdate)){{date('Y-m-d', strtotime($userInfo[0]->birthdate))}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            {{-- <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" placeholder="Leave blank if you don't change" name="password" value="">
                                    </div>
                                </div>
                            </fieldset>

                             <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Confirm password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" value="">
                                    </div>
                                </div>
                            </fieldset> --}}

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button class="btn btn-default btn-fill btn-wd">Update</button>
                                    </div>
                                </div>
                            </fieldset>

                        </form>

                    </div>
                </div>  <!-- end card -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>
@endsection