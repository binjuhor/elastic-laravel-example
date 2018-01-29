//Init bootstrap table
var $table = $('#bootstrap-table');
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
            window.open("/items/edit/"+row.id,'_blank');
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

    var columns_table = [{
            field: 'state',
            checkbox:true,
            class:'checkbox_field',
    }, {
        field: 'items_id',
        title: 'Item ID',
        class: 'id_items'
    }, {
        field: 'name',
        title: 'Name',
        sortable: true
    },
    {
        field: 'salesdate',
        title: 'Sales',
        sortable: true
    },
    {
        field: 'sales',
        title: 'Total sale',
        sortable: true
    },
    {
        field: 'cat_tree',
        title: 'Category',
        sortable: true
    },
    {
        field: 'tags',
        title: 'Tags',
        sortable: false
    },
    {
        field: 'actions',
        title: 'Actions',
        class:'td-actions text-right',
        events:'operateEvents',
        formatter:'operateFormatter'
    }];

    $table.bootstrapTable({
        toolbar: ".toolbar",
        clickToSelect: false,
        search: true,
        searchAlign: 'left',
        showColumns: true,
        showRefresh: true,
        showExport: true,
        pagination: true,
        pageSize: 10,
        pageNumber: 1,
        pageList: [10,15,20,25, 50],
        columns: columns_table,
        data: table_data,
        formatShowingRows: function(pageFrom, pageTo, totalRows){
            //do nothing here, we don't want to show the text "showing x of y from..."
        },
        formatRecordsPerPage: function(pageNumber){
            return pageNumber + " rows visible";
        },
        icons:{
            refresh: 'fa fa-save',
            toggle: 'fa fa-th-list',
            columns: 'fa fa-columns',
            detailOpen: 'fa fa-plus-circle',
            detailClose: 'fa fa-minus-circle'
        }
    });
    $table.bootstrapTable('resetView');

    $(window).resize(function () {
        $table.bootstrapTable('resetView');
    });

    //js function export data to excel
    $('[name="refresh"]').click(function(){
        $('#idlist').val($("#itemsList").val());
        $('#export-data').submit();
    })

    //Call action when check choose column and export data excel
    var fields      = ['items_id','name','salesdate','sales','cat_tree','tags'];
    $('.dropdown-menu input').click(function(){
        var valcheck    = $(this).attr('data-field');
        if (valcheck != 'actions') {
            if ($(this).is(':checked')) {
                fields.push(valcheck);
            }
            if(!$(this).is(':checked')){
                fields = fields.filter(function(item) {
                    return item !== valcheck;
                });
            }
            $('#getfield').val(fields.join());
        }
    })
    $('#getfield').val(fields.join());

    //Selected items
    var selected_items = ($('#itemsList').val()).split(',');
    $table.bootstrapTable('checkBy', {field:'items_id', values:selected_items});
});

//Action for bootstrap table
$table.on('check.bs.table', function (e, row) { //Check item
    add_itemsCalc(row, true);
    // get_check_row(row.items_id, table_data);
}).on('uncheck.bs.table', function (e, row) { //Uncheck item
    add_itemsCalc(row);
}).on('check-all.bs.table', function (e) { //Check all items
    let listId = '';
    $.each(table_data, function( index, value) {
        if (index) listId += ',';
        listId += value.items_id;
    });
    var inputArray  = listId;
    var listString  = unique(inputArray.split(','));
    inputArray      = listString.join();
    var valCheck    = $('#month-select').val();
    var getUrl      = $('#url-getdata').val();
    if (getUrl == '/boards/getweek') {
        valCheck    = $('#week-select').val();
    }
    $('#itemsList').val(inputArray);
    createChartFromAjax(listId,valCheck,getUrl);
}).on('uncheck-all.bs.table', function (e) { //Uncheck all items
    $('body').addClass('loading');
    $('#itemsList').val('');
    $('#chartSale').html('');
    $('body').removeClass('loading');
    saveBoardStage();
})

//Get checkrow when checked
function get_check_row(row, data){
    var selected = $('#table_selected').val();
    $.each(data,function(index, value){
        if (value.items_id == row) {
            selected =  selected+','+index
        }
    })
    $('#table_selected').val(selected);
    // console.log(selected);
}

// $table.checkbox([-1,0,1,4])

//Calc when check and uncheck items
function add_itemsCalc(row,check){
    if(check == undefined) check = false;
    var id          = row.items_id;
    var inputArray  = $('#itemsList').val();
    var listString  = unique(inputArray.split(','));
    inputArray      = listString.join();
    var valCheck    = $('#month-select').val();
    var newVal      = 0;
    var getUrl      = $('#url-getdata').val();
    if (getUrl == '/boards/getweek') {
        valCheck    = $('#week-select').val();
    }
    newVal = subInputValue(inputArray, id);
    if (check) {
        newVal = setinPutValue(inputArray, id);
    }
    $('#itemsList').val(newVal);
    if ($('#itemsList').val() !='') $('#getdata').removeClass('hide');
    saveBoardStage();
    createChartFromAjax(newVal,valCheck,getUrl);
}

function operateFormatter(value, row, index)
{
    return [
        '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
            '<i class="fa fa-plus"></i>',
        '</a>',
        '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
            '<i class="fa fa-remove"></i>',
        '</a>'
    ].join('');
}


//function cal sales
$(function () {
    var total = 0;
    $('.sales-single').each(function()
    {
        var sale    = $(this).attr('data-sales');
        total       = total+parseInt(sale)
    })
    $('#sales').text(total);
    $('#totalday').val(total);
});


//Select view on month or date or on week
$('#data-view').change(function(){
    var view     = $(this).val();
    var get      = $('#url-getdata').val();
    var timeType = $('#type-cselect').val();
    var time     = $('#month-select').val();
    var idList   = $('#itemsList').val();
    var getUrl   = view;
    if (view == 'day') {
        getUrl   = '/boards/ajaxitem';
        $('#url-getdata').val(getUrl);
        if (timeType == 'week-select' )
        {
            getUrl  = '/boards/getweek';
            time    = $('#week-select').val();
        }
        else
        {
            getUrl = '/boards/getweek';
        }
    }
    else
    {
        $('#url-getdata').val(view);
    }
    createChartFromAjax(idList,time,getUrl);
})

//Select month to view
$('#month-select').change(function(){
    var month   = $(this).val();
    var idList  = $('#itemsList').val();
    createChartFromAjax(idList,month);
});

//View chart for week
$('#chart-view').change(function(){
    var view     = $(this).val();
    var get      = $('#url-getdata').val();
    var timeType = $('#type-cselect').val();
    var time     = $('#month-select').val();
    var idList   = $('#itemsList').val();
    var getUrl   = $('#url-getdata').val();
    if (getUrl == '/boards/getweek') {
        time     = $('#week-select').val();
    }
    createChartFromAjax(idList,time,getUrl);
});

$('#week-select').change(function(){
    var week    = $(this).val();
    var idList  = $('#itemsList').val();
    createChartFromAjax(idList,week,'/boards/getweek');
});

$('#type-cselect').change(function(event){
    var valueChange = $(this).val();
    $('.selectdate').addClass('hide').removeClass('active');
    $('.'+valueChange).removeClass('hide').addClass('active');
    $('#url-getdata').val('/boards/getmonth')
    if (valueChange == 'week-select') {
        $('#url-getdata').val('/boards/getweek')
    }
});

/**
 * Remove array duplicate
 * @param  array list array duplicate items
 * @return an array list not duplicate items
 */
function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}



/**
 * Get ajax form month to and create chart with this data
 * @param  string idlist list id from input and split by comma
 * @param  interger month  number of month
 * @return linechart using chartjs for create chart
 */
function createChartFromAjax(idlist, month, request){

    if(idlist == ""){
        $('#chartSale').html('');
        return false;
    }
    if (request == undefined) request = $('#url-getdata').val();
    var view        = $('#chart-view').val();
    var dataview    = $('#data-view').val();
    var url         = request+'/'+idlist+'/'+month+'?view='+view+'&dataview='+dataview;

    $('body').addClass('loading');
    $.ajax({
        url:url,
        type: 'GET',
        dataType: 'html',
    })
    .done(function(data){
        $('#dataChart').val(data);
        data = JSON.parse(data);
        createChart(data);

    })
}

//Create chart with all options and data view
function createChart(data, options='')
{
    if(options == '')
    {
        options = {
            showPoint: true,
            lineSmooth: false,
            height: "260px",
            fullWidth: false,
            plugins: [
                Chartist.plugins.tooltip({
                    tooltipOffset: {
                      x: 30,
                      y: 40
                    },
                })
            ],
            axisX: {
                showGrid: true,
                showLabel: true,
            },
            axisY: {
                offset: 40,
            },
        };
    }
    Chartist.Line('#chartSale', data, options);
    $('#save-stage').removeClass('hide');
    saveBoardStage();
    $('body').removeClass('loading');
}

/**
 * get in put value from action
 * @param  int val current value of input
 * @param  id click add add to new value
 * @return string result value
 */
function setinPutValue(val, add)
{
    var valInput    = '';
    var data        = '';
    if (val == 0)   return add;
    valInput        = val.split(',');
    data            = valInput+','+add;
    return  data;
}

/**
 * Sub value from list data
 * @param  string val split via comma
 * @param  int sub value of row want to remove
 * @return string to input
 */
function subInputValue(val, sub)
{
    var dataArray   = '';
    var data        = "";
    if (val == sub) return 0;
    dataArray   = val.toString().split(',');
    var index   = $.inArray(sub, dataArray);
    dataArray.splice(index, 1);
    return dataArray.join();
}

$().ready(function(){
    $('.dateforchart').datetimepicker({
        format: 'MM/DD/YYYY',
        // format: 'DD MMMM YY', //30 September 16
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
     });

});


//Save stage current board
$('#save-stage').click(function(){
    saveBoardStage();
})

/**
 * Save board stage
 * @return json console
 */
function saveBoardStage()
{
    var url ='/boards/savedata';
    $('body').addClass('loading');
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'html',
        data: $('#getdata').serialize()
    })
    .done(function(data) {
        console.log(data);
        $('body').removeClass('loading');
    })
}
