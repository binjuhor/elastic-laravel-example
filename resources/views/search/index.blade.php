@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('ItemsController@index')}}">{{trans('items.list')}}</a>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="content">

                <form id="search-advance" class="advance-search" action="/search/advance/" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-10 col-xs-8">
                            <h4 class="title">Search advance <input name="enable-advance" type="checkbox" id="show-advance" value="1"></h4>
                            <div class="form-group">
                                <input type="text" id="text-search" class="form-control" name="q" autocomplete="off" placeholder="Item name" value="">
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-4">
                             <h4 class="title">&nbsp;</h4>
                            <div class="form-group">
                                <button class="btn btn-fill">Search</button>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 hide advance-param">
                            <legend>Advance search</legend>
                            <div class="">
                                <label class="radio checked">
                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span><span class="second-icon fa fa-dot-circle-o"></span></span><input data-toggle="radio" name="search" type="radio" value="name">
                                        By title
                                </label>
                                <label class="radio">
                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span><span class="second-icon fa fa-dot-circle-o"></span></span><input data-toggle="radio" name="search" type="radio" value="author">
                                        By author name

                                </label>
                                <label class="radio">
                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span><span class="second-icon fa fa-dot-circle-o"></span></span><input data-toggle="radio" name="search" type="radio" value="taxonomy">
                                        Taxonomy name
                                </label>

                            </div><!--End .advance-param-->
                        </div>
                    </div>
                </form><!--End #advance-search-->

            </div>
        </div> <!-- end card -->



        <!--Get list item result here-->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="fresh-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                       {{--  <th>Sales</th>
                                        <th>Total sales</th> --}}
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="result-search"></tbody>
                            </table>
                        </div>
                    </div><!-- end content-->
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->


    </div>
@endsection


@section('extrajs')
    <script>
    (function($){
        "use strict";
        $().ready(function(){

            // Init Sliders
            demo.initFormExtendedSliders();
            // Init DatetimePicker
            demo.initFormExtendedDatetimepickers();


            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });

            var table = $('#datatables').DataTable();

            //Action to click something
            table.on( 'click', '.remove', function (e) {
                var id = $(this).attr('data-id');
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
                            url: "/items/destroy/"+id,
                        }).done(function(result) {
                            console.log(result);
                            swal(
                              'Good job!',
                              'You deleted the item and all data of it!',
                              'success'
                            );
                            $('#themeid-'+id).remove();
                        });
                    }else{
                        swal("Cancelled", "Your item is safe :)", "error");
                    }
                });
            } );


            //On submit search data
            $('#search-advance').submit(function(event) {
                $('body').addClass('loading');
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    dataType:'html',
                    data: $(this).serialize()
                }).done(function(result) {
                    console.log(result)
                    $('body').removeClass('loading');
                    $('#result-search').html(result);

                });
                return false;
            });

            //Show options advance search
            $('#show-advance').click(function(event) {
               checkAdvance();
            });
            function checkAdvance(){
                if ( $('#show-advance').is(':checked')) {
                    $('.advance-param').removeClass('hide')
                }else{
                    $('.advance-param').addClass('hide')
                }
            }
        });


    })(jQuery)
</script>
@endsection