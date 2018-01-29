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
                                <button type="button" id="itembutton" class="btn btn-default btn-fill btn-wd loading">Create <span class="percen hide">0%</span></button>
                            </div>
                            <div class="col-sm-10">
                                <div id="result">Status</div>
                                <div class="status-bar" style="background: green; height: 2px; width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                </div>  <!-- end card -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>
@endsection


@section('extrajs')
    {{-- Show a div lock screen --}}
    <div class="lockscreen hide">
        <div class="percen-message">
            <h1><div id="percen">0%</div></h1>
            <div id="message-status">Item name success</div>
            <div class="percen-bar">
                <div class="procecc-rule" style="width:0%"><sup id="number"></sup></div>
            </div>
            <button id="pause-getdata" class="hide" data-percen="0" data-n="0">Stop</button>
        </div><!--End .percen-message-->
    </div><!--End .lockscreen-->
    <script>
    (function($){
        "use strict";
        $('#itembutton').click(function(event)
        {
            $(this).attr('disable','true').addClass('loading');
            $.ajax({
                url: "/items/api/view-api",
            }).done(function(rs) {
                var data        = $.parseJSON(rs);
                var listItem    = data.result.items;
                var total       = data.result.total;
                var arrayData   = Object.values(listItem);
                var n           = window.prompt("Input number to continue",0);
                requestDataItem(n, arrayData, total);
            });
        });

        $('#pause-getdata').click(function(){
            $('.lockscreen').addClass('hide');
        });

        /**
         * this request each data from item list
         * @param  {int} n        number of item in list api
         * @param  {array} arrayData list data from api
         * @return http request
         */
        function requestDataItem(n, arrayData, total)
        {
            console.log(n)
            var items   = arrayData.slice(n, parseInt(n+1));
            var percen  = (n*100)/total;
            if (n > total)return false;
            $.ajax({
                url: "/items/detailAPI/"+items[0].item_id,
            }).done(function(dt) {
                $('.lockscreen').removeClass('hide');
                $('#percen').text(percen.toFixed(2)+'%');
                $('#number').text(n);
                $('#message-status').text(dt);
                $('.procecc-rule').css('width', percen.toFixed(2)+'%');
                requestDataItem(parseInt(n)+1, arrayData, total);
                console.log(n+'/'+total);
            });
        }
    })(jQuery)
</script>
@endsection