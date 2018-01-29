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
                                <button type="button" id="create-itemapi" class="btn btn-default btn-fill btn-wd loading">Create <span class="percen hide">0%</span></button>
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
    <script>
    (function($){
        "use strict";

        $('#create-itemapi').click(function(event)
        {
            getLisThemeViaApi();
        });

        /**
         * Get request index list item from data app
         * @param  interger page per page for item (one item per one page)
         * @return index item for elastic search
         */
        function getLisThemeViaApi(page)
        {
            if (page == undefined) page = 1;
            $.ajax({
                url: "/search/itemindex?page="+page,
            }).done(function(result) {
                console.log(result);
                var message = getdataAjax(result.data[0].id);
                var percen  = (page*100)/result.total;
                page += 1;
                getLisThemeViaApi(page);
                // if (message == "success") getLisThemeViaApi(page);
                if (percen == 100) return false;
                $('.percen').text(percen.toFixed(2)+'%').removeClass('hide');
                $('.status-bar').css('width', percen.toFixed(2)+'%');
                $('.percen').attr('data-page', page);
                return true;

            });
        }

        /**
         * Create each item via ajax with data result
         * @param  string id id from api list
         * @return HTTP request
         */
        function getdataAjax(id)
        {
            var message = "success";
            $.ajax({
                url: "/search/index/"+id,
            }).done(function(result) {
                $('#result').text(result);
                message = "failed";
                console.log('data'+result)
            });
            return message;
        }

    })(jQuery)
</script>
@endsection