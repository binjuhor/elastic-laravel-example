@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{ url('/') }}">
    Dashboard PI
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card" style="min-height: 189px;">

            <div class="content">
                <h1>{{number_format($itemCount,0)}} <sup>Items</sup></h1>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="min-height: 189px;">

            <div class="content">
                <h1>{{number_format($newItems,0)}} <sup>New Items</sup></h1>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card" style="min-height: 189px;">
            <div class="content">
                <a href="{{action('TaxonomyController@category')}}"><h1>{{number_format($catCount,0)}} <sup>Categories</sup></h1></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card" style="min-height: 189px;">
            <div class="content">
                <a href="{{action('BoardsController@index')}}"><h1>{{number_format($boardCount,0)}} <sup>Boards</sup></h1></a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card" style="min-height: 189px;">
            <div class="content">
                <h1>{{number_format($auth,0)}} <sup>Auth</sup></h1>
            </div>
        </div>
    </div>

</div> <!--End topdashboard-->
@endsection




@section('extrajs')
<script type="text/javascript">
    var $table = $('#bootstrap-table');

    function operateFormatter(value, row, index) {
        return [
            '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="fa fa-image"></i>',
            '</a>',
            '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="fa fa-edit"></i>',
            '</a>',
            '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="fa fa-remove"></i>',
            '</a>'
        ].join('');
    }

    $().ready(function(){
        window.operateEvents = {
            'click .view': function (e, value, row, index) {
                $.ajax({
                    url: "/items/view/"+row.id,
                }).done(function(result) {
                    console.log(result);
                    swal({  title: 'Theme detail',
                        html:
                            '<div class="row"><div class="col-sm-3 text-right">Theme name:</div><div class="col-sm-9 text-left"> <strong><a target="_blank" href="http://themeforest.net/'+result.items.sourceurl+'">' + result.items.name+'</a></strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Author: </div><div class="col-sm-9 text-left"><strong><a target="_blank" href="https://themeforest.net/user/'+result.items.author+'">' + result.items.author+'</a></strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Sales: </div><div class="col-sm-9 text-left"><strong>' + result.itemInfo.salesdate+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Total sales: </div><div class="col-sm-9 text-left"><strong>' + result.itemInfo.sales+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Created at: </div><div class="col-sm-9 text-left"><strong>' + result.items.uploaded+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Last update: </div><div class="col-sm-9 text-left"><strong>' + result.itemInfo.upload_update+'</strong></div></div>'+
                            '<div class="row"><div class="col-sm-3 text-right">Tags:</div><div class="col-sm-9 text-left " style="word-break:break-all;">' + result.items.tags+'</div></div>'
                    });
                });

            },
            'click .edit': function (e, value, row, index) {
                window.location = "/items/edit/"+row.id;
            },
            'click .remove': function (e, value, row, index) {
                console.log(row);
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },function(isConfirm){
                    if (isConfirm){
                        $.ajax({
                            url: "/items/destroy/"+row.id,
                        }).done(function(result) {
                            console.log(result);
                            swal(
                              'Good job!',
                              'You deleted the item and all data of it!',
                              'success'
                            );
                            $table.bootstrapTable('remove', {
                                field: 'id',
                                values: [row.id]
                            });
                        });
                    }else{
                        swal("Cancelled", "Your item is safe :)", "error");
                    }
                });
            }
        };

        $table.bootstrapTable({
            toolbar: ".toolbar",
            clickToSelect: false,
            showRefresh: false,
            search: false,
            showToggle: false,
            showColumns: false,
            pagination: false,
        });
        $(window).resize(function () {
            $table.bootstrapTable('resetView');
        });

    });

</script>
@endsection
