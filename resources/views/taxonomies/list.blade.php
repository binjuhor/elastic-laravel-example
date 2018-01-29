@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('TaxonomyController@index')}}">{{trans('taxonomies.list')}}</a>
@endsection

@section('content')

 <div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="toolbar">

                </div>

                <table id="bootstrap-table" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" ata-sortable="true" class="text-center">ID</th>
                        <th data-field="name" data-sortable="true">Name</th>
                        <th data-field="description" data-sortable="true">Description</th>
                        <th data-field="parent" data-sortable="true">Parent</th>
                        <th data-field="status" data-sortable="true">Status</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($taxonomies as $taxonomy)
                            <tr id="tax-{{ $taxonomy->id }}" data-id="{{ $taxonomy->id }}">
                                <td></td>
                                <td>{{ $taxonomy->id }}</td>
                                <td><a href="{{action('TaxonomyController@edit', [$taxonomy->id])}}">{{ $taxonomy->taxname }}</a></td>
                                <td>{{$taxonomy->description}}</td>
                                <td>
                                    @if($taxonomy->parent == '0') Root @else Child tax @endif
                                </td>
                                <td>
                                    @if ($taxonomy->status == 0)
                                        Disabled
                                    @elseif ($taxonomy->status == 1)
                                        Public
                                    @else
                                        Private
                                    @endif
                                </td>
                                <td></td>
                            </tr>

                        @endforeach


                    </tbody>
                </table>
                {{ $taxonomies->links() }}
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->

</div>

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
                info = JSON.stringify(row);

                swal('You click view icon, row: ', info);
                console.log(info);
            },
            'click .edit': function (e, value, row, index) {
                info = JSON.stringify(row);

                swal('You click edit icon, row: ', info);
                console.log(info);
            },
            'click .remove': function (e, value, row, index) {
                console.log( row.id);

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
                            url: "/taxonomy/destroy/"+row.id,
                        }).done(function(result) {
                            console.log(result);
                            swal(
                              'Good job!',
                              'You deleted the taxonomy and tax relation ship!',
                              'success'
                            );
                            $table.bootstrapTable('remove', {
                                field: 'id',
                                values: [row.id]
                            });
                        });
                    }else{
                        swal("Cancelled", "Your taxonomy is safe :)", "error");
                    }
                });
            }
        };

        $table.bootstrapTable({
            toolbar: ".toolbar",
            clickToSelect: true,
            showRefresh: true,
            search: true,
            showToggle: true,
            showColumns: true,
            // pagination: true,
            searchAlign: 'left',
            // pageSize: 8,
            clickToSelect: false,
            // pageList: [8,10,25,50,100],

            formatShowingRows: function(pageFrom, pageTo, totalRows){
                //do nothing here, we don't want to show the text "showing x of y from..."
            },
            formatRecordsPerPage: function(pageNumber){
                return pageNumber + " rows visible";
            },
            icons: {
                refresh: 'fa fa-refresh',
                toggle: 'fa fa-th-list',
                columns: 'fa fa-columns',
                detailOpen: 'fa fa-plus-circle',
                detailClose: 'fa fa-minus-circle'
            }
        });

        //activate the tooltips after the data table is initialized
        $('[rel="tooltip"]').tooltip();

        $(window).resize(function () {
            $table.bootstrapTable('resetView');
        });

    });

</script>
@endsection