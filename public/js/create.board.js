/*
 * Setup table list item
 */
var $table= $('#bootstrap-table');

$().ready(function(){
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
        pagination: true,
        pageSize: 10,
        pageNumber: 1,
        pageList: [10,15,20,25, 50],
        columns: columns_table,
        data: table_data,
    });

    $(window).resize(function () {
        $table.bootstrapTable('resetView');
    });

    //Selected items
    var selected_items = ($('#itemsList').val()).split(',');
    $table.bootstrapTable('checkBy', {field:'items_id', values:selected_items});
});


//Action for bootstrap table
var newVal      = 0;
$table.on('check.bs.table', function (e, row) { //Check item
    var inputArray  = $('#itemsList').val();
    var id          = row.items_id;
    var listString  = unique(inputArray.split(','));
    inputArray      = listString.join();
    newVal          = setinPutValue(inputArray, id);
    $('#itemsList').val(newVal);
}).on('uncheck.bs.table', function (e, row) { //Uncheck item
    var inputArray  = $('#itemsList').val();
    var id          = row.items_id;
    var listString  = unique(inputArray.split(','));
    inputArray      = listString.join();
    newVal          = subInputValue(inputArray, id);
    $('#itemsList').val(newVal);
}).on('check-all.bs.table', function (e) { //Check all items
    let listId = '';
    $.each(table_data, function( index, value) {
        if (index) listId += ',';
        listId += value.items_id;
    });
    var inputArray  = listId;
    var listString  = unique(inputArray.split(','));
    inputArray      = listString.join();
    $('#itemsList').val(inputArray);
}).on('uncheck-all.bs.table', function (e) { //Uncheck all
    $('#itemsList').val('');
})

/**
 * unique array value item
 * @author  Binjuhor
 * @version 2.0.0
 * @since   2.0.0
 * @param   array list id in list array
 * @return  array  result
 */
function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}



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

/**
 * get in put value from action
 * @param  int val current value of input
 * @param  id click add add to new value
 * @return string result value
 */
function setinPutValue(val, add){
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
function subInputValue(val, sub){
    var dataArray   = '';
    var data        = "";
    if (val == sub) return 0;
    dataArray   = val.toString().split(',');
    var index   = $.inArray(sub, dataArray);
    dataArray.splice(index, 1);
    return dataArray.join();
}


$('.selectpicker').change(function(){
    var idCategory = $(this).val();
    $('body').addClass('loading');
    var url        = '/boards/cat/'+idCategory;
    $table.bootstrapTable('refresh',{'url':url});
    $('body').removeClass('loading');
});


//Enter on input could not submit form
//All input search key with enter
$('#items-name, #author-name, #sale-from').keypress(function (e) {
    var testText = $(this).val();
    if (e.which == 13) {
        if (testText !='') {
            e.preventDefault();
            $('body').addClass('loading');
        }
        return false;
    }
});


// $('#items-name').keyup(function(){
//Input items name enter
$('#items-name').keypress(function(e){
    var text = $('#items-name').val();
    if (text !='') {
        var url        = '/boards/itemname/'+text;
        $table.bootstrapTable('refresh',{'url':url});
    }
    $('body').removeClass('loading');
});

//Button items click for search
$('.btn-items').click(function(e){
    e.preventDefault();
    $('body').addClass('loading');
    var text = $('#items-name').val();
    if (text !='') {
        var url        = '/boards/itemname/'+text;
        $table.bootstrapTable('refresh',{'url':url});
    }
    $('body').removeClass('loading');
});

// $('#sale-from').keyup(function(){
//Sale from input enter
$('#sale-from').keypress(function(e){
    if (e.which == 13) {
        var text = parseInt($(this).val());
        if (text!='') {
            var url = '/boards/salefrom/'+text;
            $table.bootstrapTable('refresh',{'url':url});
        }
        $('body').removeClass('loading');
    }
});

// $('#author-name').keyup(function(){
// Input auhor name enter
$('#author-name').keypress(function(e){
    if (e.which == 13) {
        var text = $('#author-name').val();
        if (text !='') {
            var url        = '/boards/authorname/'+text;
            $table.bootstrapTable('refresh',{'url':url});
        }
        $('body').removeClass('loading');
    }
});

// Button search author click
$('.btn-author').click(function(e){
    e.preventDefault();
    $('body').addClass('loading');
    var text = $('#author-name').val();
    if (text !='') {
        var url        = '/boards/authorname/'+text;
        $table.bootstrapTable('refresh',{'url':url});
    }
    $('body').removeClass('loading');
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
            }).done(function(result) {;
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