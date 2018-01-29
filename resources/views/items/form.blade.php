@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('ItemsController@index')}}">{{trans('items.list')}}</a>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <legend>Add new Items</legend>
                    </div>
                    <div class="content">

                        <form id="inputthemeInfo" method="POST" action="@if(isset($items)){{action('ItemsController@update',[$items->id])}} @else {{action('ItemsController@create')}}@endif" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="abc" name="craw_id">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Items name</label>
                                    <div class="col-sm-10">
                                        <input type="text" minLength="5" class="form-control" name="name" value="@if(isset($items)){{$items->name}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">More info</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input minLength="3" type="text" class="form-control" placeholder="Author name" name="author" value="@if(isset($items)){{$items->author}}@endif">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="input-group">
                                           <span class="input-group-addon">Rate:</span>
                                           <input range="[0,5]" type="text" class="form-control" name="rate" placeholder="Rate" value="@if(isset($itemInfo)){{$itemInfo->rate}}@endif"/>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input min="13" type="text" class="form-control" placeholder="Price" name="price" value="@if(isset($itemInfo)){{$itemInfo->price}}@endif"/>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sales:</span>
                                            <input min="0" type="text" class="form-control" placeholder="Sale" name="sales" value="@if(isset($itemInfo)){{$itemInfo->sales}}@endif"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea min="110" id="description"  class="form-control" name="description">@if(isset($items)){{$items->description}}@endif</textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Preview</label>
                                    <div class="col-sm-10">
                                       <input type="text" url="true" class="form-control" name="preview" value="@if(isset($items)){{$items->preview}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Source url</label>
                                    <div class="col-sm-10">
                                        <input type="text" url="true" class="form-control" name="sourceurl"  value="@if(isset($items)){{$items->sourceurl}}@endif"/>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Url demo</label>
                                    <div class="col-sm-10">
                                        <input type="text" url="true" class="form-control" name="demourl" value="@if(isset($items)){{$items->demourl}}@endif"/>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Documentation</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="documentation" value="@if(isset($items)){{$items->documentation}}@endif"/>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Created at</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control datepicker" name="uploaded" placeholder="Created at" value="@if(isset($items)){{$items->uploaded}}@endif"/>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Updated at</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control datepicker" name="upload_update" placeholder="Updated at" value="@if(isset($itemInfo)){{$itemInfo->upload_update}}@endif"/>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
                                        <select multiple name="tax[]" class="selectpicker" data-title="Select Category" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if(isset($taxs) && in_array($category->id, $taxs,TRUE)) selected @endif">{{$category->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Columns</label>
                                    <div class="col-sm-10">
                                        <select name="tax[]" class="selectpicker" data-title="Select Columns" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($columns as $column)
                                                <option value="{{$column->id}}" @if(isset($taxs) && in_array($column->id, $taxs,TRUE)) selected @endif">{{$column->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Layout</label>
                                    <div class="col-sm-10">
                                        <select data-title="Layout" name="tax[]" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($layouts as $layout)
                                                <option value="{{$layout->id}}" @if(isset($taxs) && in_array($layout->id, $taxs,TRUE)) selected @endif">{{$layout->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">High Resolution</label>
                                    <div class="col-sm-5 row-no-padding">
                                        @foreach ($highsolution as $highsolut)
                                             <label class="radio radio-inline">
                                                <input type="radio" data-toggle="radio" require="true" name="highsolution" @if(isset($items) && $items->highsolution == $highsolut->taxname) checked @endif value="{{$highsolut->taxname}}">{{$highsolut->taxname}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Widget Ready</label>
                                    <div class="col-sm-5 row-no-padding">
                                        @foreach ($widgetready as $widgetread)
                                             <label class="radio radio-inline">
                                                <input type="radio" require="true" data-toggle="radio" @if(isset($items) && $items->widgetready == $widgetread->taxname) checked @endif name="widgetready" value="{{$widgetread->taxname}}">{{$widgetread->taxname}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Compatible Browsers</label>
                                    <div class="col-sm-10">
                                        <select multiple data-title="Compatible Browsers"  require="true"  name="tax[]" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($compare_browsers as $browsers)
                                                <option value="{{$browsers->id}}" @if(isset($taxs) && in_array($browsers->id, $taxs,TRUE)) selected @endif">{{$browsers->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Compatible With</label>
                                    <div class="col-sm-10">
                                        <select multiple data-title="Compatible With"  require="true"  name="tax[]" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($compare_with as $comparewith)
                                                <option value="{{$comparewith->id}}" @if(isset($taxs) && in_array($comparewith->id, $taxs,TRUE)) selected @endif">{{$comparewith->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Software Version</label>
                                    <div class="col-sm-10">
                                        <select multiple data-title="Software Version"  require="true"  name="tax[]" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($sofwares as $sofware)
                                                <option value="{{$sofware->id}}" @if(isset($taxs) && in_array($sofware->id, $taxs,TRUE)) selected @endif">{{$sofware->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Framework</label>
                                    <div class="col-sm-10">
                                        <select multiple data-title="Framework"  require="true"  name="tax[]" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($frameworks as $framework)
                                                <option value="{{$framework->id}}" @if(isset($taxs) && in_array($framework->id, $taxs,TRUE)) selected @endif">{{$framework->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ThemeForest Files Included</label>
                                    <div class="col-sm-10">
                                        <select multiple data-title="Files Included"   require="true" name="tax[]" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            @foreach ($themeincludes as $themeinclude)
                                                <option value="{{$themeinclude->id}}" @if(isset($taxs) && in_array($themeinclude->id, $taxs,TRUE)) selected @endif">{{$themeinclude->taxname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Fonts</label>
                                    <div class="col-sm-10">
                                        <input  require="true" name="fonts" class="tagsinput tag-azure tag-default" value="@if(isset($items)){{$items->fonts}}@endif" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tags</label>
                                    <div class="col-sm-10">
                                        <input  require="true" name="tags" class="tagsinput tag-azure tag-default" value="@if(isset($items)){{$items->tags}}@endif" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Media</label>
                                    <div class="col-sm-10">
                                        @if(isset($items))
                                            @foreach($items->getMedia as $media)
                                                <img src="{{$media->body}}" width="50" height="50">
                                            @endforeach
                                        @endif

                                        <input  name="media[]" type="file" multiple value="" />
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button class="btn btn-default btn-fill btn-wd">@if(isset($items))Update @else Create @endif</button>
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


@section('extrajs')
<script src="/editor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
    CKEDITOR.replace( 'description',{
        filebrowserBrowseUrl: '/editor/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });

    //Add date picker
    (function($){
        "use strict";
        $(document).ready(function(){
            demo.initFormExtendedDatetimepickers();
            $('#inputthemeInfo').validate();
        });
    })(jQuery)
</script>
@endsection
