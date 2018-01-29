@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{ url('/') }}"> Reports</a>
@endsection




@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                Chart view item changed
                <p class="category">Line Chart</p>
            </div>
            <div class="content">
                <div id="chartPerformance" class="ct-chart "></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <h4 class="title">List item on this board</h4>
                <p class="category">Here is item list for chart</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Add </th>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td><input type="checkbox" class="item-id" data-id="{{ $item->id }}"></td>
                            <td>{{$item->name}}</td>

                            <td>Oud-Turnhout</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="idview-list" value="">
        </div>
    </div>
</div>
@endsection

@section('extrajs')
<script type="text/javascript">
    $().ready(function(){
        var dataPerformance = {
            labels: ['05/10/2016','15/10/2016', '20/10/2016', '30/10/2016'],
            series: [
                [1, 6, 8, 7,10]
            ]
        };

        var options = {
            showPoint: true,
            lineSmooth: true,
            height: "260px",
            axisX: {
                showGrid: true,
                showLabel: true
            },
                axisY: {
                offset: 40,
            },
                low: 0,
                high: 50
        };
        createChart('#chartPerformance',dataPerformance, options, 'Bar');
    });


    function createChart(id,data, options, type){
        switch(type) {
            case 'Line':
                Chartist.Line(id, data, options);
                break;
            case 'Bar':
                Chartist.Bar(id, data, options);
                break;
            case 'Pie':
                Chartist.Pie(id, data, options);
                break;

            default:
                Chartist.Line(id, data, options);
            break;
        }
        //

    }

    //Test ajax jquery
    (function($){
        "use strict";
        $('.item-id').click(function(event) {
            var idItemList  = $('#idview-list').val();
            var idItem      = $(this).attr('data-id');

            if ($(this).is(":checked")) {
                if (idItemList != "") {
                    idItemList += ','+idItem;
                }else{
                    idItemList = idItem;
                }
            }else{
                idItemList = idItemList.split(',');
                var index = idItemList.indexOf(idItem);
                if (index > -1) idItemList.splice(index, 1);
            }
            $('#idview-list').val(idItemList);
            if (idItemList !='') {
                var url = '/reports/ajaxitem/'+idItemList;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                })
                .done(function(data) {
                    data = JSON.parse(data);
                    var dataChart = {
                        labels: data.labels,
                        series : data.series
                    };
                    var options = {
                        showPoint: true,
                        lineSmooth: true,
                        height: "260px",
                        axisX: {
                            showGrid: true,
                            showLabel: true,
                        },
                        axisY: {
                            offset: 40,
                        },
                        low: 0,
                        high: Math.max.apply(Math, data.series)
                    };
                    //Create chart with Link chart
                    createChart('#chartPerformance',dataChart, options, 'Line');
                })
                .fail(function(msg) {
                    console.log("Error "+msg);
                })
            }
        });
    })(jQuery)

</script>
@endsection
