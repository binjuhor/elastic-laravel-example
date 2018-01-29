@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('TaxonomyController@index')}}">{{trans('taxonomies.list')}}</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <legend>Add new taxonomy</legend>
                    </div>
                    <div class="content">
                        <form id="form-taxonomy" action="{{action('TaxonomyController@updateDB')}}" method="post" class="form-horizontal">
                            {{ csrf_field() }}


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Taglist</label>
                                    <div class="col-sm-10">
                                        <textarea  class="form-control" name="taxonomylist"></textarea>
                                        <span class="help-block">List tax child with comma</span>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Select parrent</label>
                                    <div class="col-sm-10">
                                        <select data-title="Select parent"  name="parrent[]" class="selectpicker" data-style="btn-info btn-block" data-menu-style="dropdown-blue">
                                            <option value="0">Root</option>
                                            @foreach ($taxonomies as $taxonomy)
                                                <option value="{{ $taxonomy->id }}">{{ $taxonomy->taxname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                             <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Type</label>
                                    <div class="col-sm-10">
                                        <select data-title="Select type"  name="type" class="selectpicker" data-style="btn-info btn-block" data-menu-style="dropdown-blue">
                                            <option value="0">Category</option>
                                            <option value="1">Attribute</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button class="btn btn-default btn-fill btn-wd">Create list</button>
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