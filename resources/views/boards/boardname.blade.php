<div id="list-itemsForBoards" class="row">
        <div class="col-md-12">
            <div class="card">

                <table id="bootstrap-table" class="table">
                    <thead>
                        <th data-field="state" data-checkbox="true"></th>
                        <th data-field="id" data-sortable="true" class="text-center">ID</th>
                        <th data-field="name" data-sortable="true">Name</th>
                        <th data-field="saledate" data-sortable="true">Sales / date</th>
                        <th data-field="totalsale" data-sortable="true">Total sale</th>
                        <th data-field="author" data-sortable="true">Author</th>
                        <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
                    </thead>
                    <tbody>
                        @if($items)
                            @foreach ($items as $item)
                                <tr id="tax-{{ $item['_source']['id'] }}" class="row-item" data-id="{{ $item['_source']['items_id'] }}">
                                    <td></td>
                                    <td>{{ $item['_source']['id']}}</td>
                                    <td><a href="{{action('ItemsController@edit', $item['_source']['id'])}}">@if(isset($item['_source']['name'])) {{ $item['_source']['name'] }} @endif</a></td>
                                    <td>@if(isset($item['_source']['sale_today'])) {{$item['_source']['sale_today'] }} @endif</td>
                                    <td>@if(isset($item['_source']['sales'])) {{ $item['_source']['sales'] }} @endif</td>
                                    <td>@if(isset($item['_source']['author'])){{ $item['_source']['author'] }} @endif</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endif

                        @if(!$items)
                        <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>
                        @endif

                    </tbody>
                </table>
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
</div>
<script>
    /*
     * Setup table list item
     */
    var $table = $('#bootstrap-table');
    $table.bootstrapTable({
        toolbar: ".toolbar",
        clickToSelect: true,
        showRefresh: false,
        search: true,
        showToggle: false,
        showColumns: false,
        pagination: false,
    });

    function operateFormatter(value, row, index) {
        return [
            '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="fa fa-image"></i>',
            '</a>',
            '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="fa fa-edit"></i>',
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
            }
        }
    });


    $(window).resize(function () {
        $table.bootstrapTable('resetView');
    });

    //Find item
    $('#items-find').keyup(function() {
        if ($(this).val().length > 3) {
            // swal( "Handler for .keyup() called." );
            var url = '/search/advance/?q='+$(this).val();
            $.ajax({
                url: url,
                dataType:'html',
                // data: $(this).val()
            }).done(function(result) {
                // console.log(result)
                $('#result-search').html(result);

            });
        }
    });
</script>