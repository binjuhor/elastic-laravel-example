@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('SettingController@index')}}">Setting page</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <legend>System setting</legend>
                    </div>
                    <div class="content">

                        <form id="inputthemeInfo" method="POST" action="{{action('SettingController@index')}}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            
                             <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">App name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control valid" name="name" value="{{ config('app.name')}}" type="text">
                                        </input>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        Time zone
                                    </label>
                                    <div class="col-sm-10">
                                        <input class="form-control valid" name="timezone" value="{{ config('app.timezone')}}" type="text">
                                        </input>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Facebook url</label>
                                    <div class="col-sm-10">
                                        <input class="form-control valid" name="facebook[url]" value="{{ config('social.facebook.url')}}" type="text">
                                        </input>
                                    </div>
                                </div>
                            </fieldset>

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

