@extends('layouts.app')

@section ('extracss')
<link href="/css/chartist-plugin-tooltip.css" rel="stylesheet" />
@endsection

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="col-md-2">
                        Line chart
                        <p class="category">{{$board->name}}</p>
                    </div>
                    <div class="col-md-10">
                        <form id="export-data" action="/boards/export" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="idlist" name="idlist">
                            <input type="hidden" id="getfield" name="get-field">
                            <input type="hidden" id="board-name" name="board-name" value="{{$board->name}}">
                        </form>
                        <form id="getdata" action="#" method="POST">
                            {{ csrf_field() }}
                            <div class="col-sm-2">
                                <select name="view_by" id="type-cselect" class="selectpicker" data-title="View" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="month-select">View</option>
                                    <option value="month-select" @if(isset($table_setting->select_view) && $table_setting->select_view == 'month-select') selected @endif >Month</option>
                                    <option value="week-select" @if(isset ($table_setting->select_view) && $table_setting->select_view == 'week-select') selected @endif >Week</option>
                                </select>
                            </div>
                            <div class="col-sm-2 selectdate month-select @if(isset ($table_setting->select_view) && $table_setting->select_view == 'week-select') hide @endif" data-url="/boards/getmonth">
                                <select name="view_month" id="month-select" class="selectpicker" data-title="On" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="current" selected>30 days latest</option>
                                    @foreach($months as $key => $month)
                                        <option value="{{$key}}" @if(isset($table_setting->select_data) && $table_setting->select_data == $key && $table_setting->select_view == 'month-select') selected @endif>{{$month}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 selectdate week-select @if(isset ($table_setting->select_view) && $table_setting->select_view != 'week-select') hide @endif" data-url="/boards/getweek">
                                <select name="view_week" id="week-select" class="selectpicker" data-title="On" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    @for($i=1; $i<=52; $i++)
                                        <option value="{{$i}}" @if(isset($table_setting->select_data) && $table_setting->select_data == $i  && $table_setting->select_view == 'week-select') selected @endif> Week {{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-2 chart-view" data-url="line-view">
                                <select name="sale_view" id="chart-view" class="selectpicker" data-title="Default" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="default" selected="selected"> Total sales </option>
                                    <option value="salesdate">Sales date</option>
                                </select>
                            </div>
                             <div class="col-sm-2 data-view" data-url="line-view">
                                <select name="data_view" id="data-view" class="selectpicker" data-title="Day view view" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="day" selected="selected">Days view</option>
                                </select>
                            </div>
                            <div class="col-md-2 data-view" data-url="line-view">
                                <button type="button" id="save-stage" class=" hide btn btn-default" >Save View</button>
                            </div>
                            <input type="hidden" id="itemsList" name="items" value="@if(isset($dataBoard[0])){{$dataBoard[0]['item_id']}}@endif">
                            <input type="hidden" id="dataChart" name="chart_data" value="@if(isset($dataBoard[0])){{$dataBoard[0]['chart_data']}}@endif">
                            <input type="hidden" id="set_view" name="set_view" value="@if(isset($dataBoard[0])){{$dataBoard[0]['set_view']}}@endif">
                            <input type="hidden" id="table_data" name="table_data" value=" @if(isset($item_json)){{$item_json}}@endif">
                            <input type="hidden" id="table_setting" name="table_setting" value="@if(isset($dataBoard[0])){{json_decode($dataBoard[0]['table_setting'])}}@endif">
                            <input type="hidden" name="table_selected" id="table_selected" value="-1">
                            <input type="hidden" id="id_board" name="id_board" value="{{$id}}">
                            <input type="hidden" id="totalday" name="totalday" value="0">
                            <input type="hidden" id="url-getdata" name="url" value="@if(isset($table_setting->url) && $table_setting->url !=''){{$table_setting->url}}@else{{'/boards/ajaxitem'}}@endif">

                        </form>
                    </div>
                </div>
                <div class="content">
                    <div id="chartSale" class="ct-chart "></div>
                </div>
            </div>
        </div>

    </div><!--End .row-->

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="content">
                    <h1>{{count($items)}}<sup>items</sup></h1>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="content">
                    <h1><span id="sales">0</span><sup>Today sales</sup></h1>
                </div>
            </div>
        </div>

    </div><!--End .row info-->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="toolbar">

                </div>
                <table id="bootstrap-table" class="table"></table>
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->

</div>

@endsection

@section('extrajs')
<script type="text/javascript" src="/js/chartist-plugin-tooltip.js"></script>
<script type="text/javascript">
    var table_data = JSON.parse($('#table_data').val());
    @if(isset($dataBoard[0]) && $dataBoard[0]['table_data'] != '')
        table_data = JSON.parse('{!! json_decode($dataBoard[0]['table_data']) !!}');
    @endif
</script>
<script type="text/javascript" src="/js/detail.board.js"></script>
<script>
    @if(isset($dataBoard[0]) && $dataBoard[0]['chart_data'] != '')
        var chart_data = JSON.parse('{!! $dataBoard[0]['chart_data'] !!}');
        createChart(chart_data); //Create chart if isset data
    @endif
</script>
@endsection