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
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" id="create-itemapi" class="btn btn-default btn-fill btn-wd loading">Create</button>
                            </div>
                            <div class="col-sm-10">
                                <div id="result">Item name</div>
                            </div>
                        </div>
                    </div>
                </div>  <!-- end card -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>
@endsection


@section('extrajs')
    <script>
        (function($){
            "use strict";

            $('#create-itemapi').click(function(event) {
                alert('do something');
            });

            /**
             * Create each item via ajax with data result
             * @param  string id id from api list
             * @return HTTP request
             */
            function getdataAjax(id){
                $.ajax({
                    url: "http://128.199.126.143:8080/api/v1.0/item?_action=info&id="+id,
                }).done(function(result) {
                    try{
                        if(result = '') {
                            throw new Error('Error!');
                        }
                        var result = JSON.parse(response);
                        var percenResult = parseFloat(result.percent);
                        var percen = (percenResult*100).toFixed(2);
                        if (percen == '100.00' || result.is_done_setting_pages) { percen = 99.99;}
                        jQuery('#beau-percen-text').text(percen+'%');
                        jQuery('.beau-process-bar').css('width',percen+'%');
                    } catch(e){
                        // Response is not JSON => Problem
                        // resultFinal();
                        jQuery('.beau-message').text('Import error please refresh page and import again or contact Beautheme Team');
                        jQuery('.result-title').append('<p class = "notice notice-error">'+e+'</p>');
                        return;
                    }

                });
            }

        })(jQuery)
    </script>
@endsection