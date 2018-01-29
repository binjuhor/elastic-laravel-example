@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{action('BoardsController@index')}}">{{trans('taxonomies.list')}}</a>
@endsection

@section('content')
    <div class="container-fluid">

        <form id="form-board" action="@if(isset($board)){{action('BoardsController@update',[$board->id])}} @else {{action('BoardsController@create')}} @endif" method="post" class="form-horizontal">



            <div class="card tab-list-action">
                <div class="header">
                    <h4 class="title">Create new boards</h4>
                    <p class="category">Search items and info boards</p>
                </div>
                <div class="content">

                    <ul role="tablist" class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a href="#board-info" data-toggle="tab" aria-expanded="false">Board Info</a>
                        </li>
                        <li class="">
                            <a href="#search-items" data-toggle="tab" aria-expanded="true">Search items</a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="board-info" class="tab-pane active">

                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Board name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="@if(isset($board)){{$board->name}}@endif">
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea  class="form-control" id="description" name="description">@if(isset($board)){{$board->description}}@endif</textarea>
                                        <span class="help-block">Short description for this taxonomy.</span>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label"></label>
                                    <div class="col-sm-9">
                                       <button class="btn btn-default btn-fill btn-wd">@if(isset($board)) Update Board @else Create Board @endif</button>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div id="search-items" class="tab-pane">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">By category</label>
                                    <div class="col-sm-8">
                                         <select name="cities" class="selectpicker" data-title="Select category" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                            <option value="all">All</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if(isset($taxs) && in_array($category->id, $taxs,TRUE)) selected @endif">{{$category->taxname}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="itemsList" name="items" value="@if(isset($board)){{$board->items}}@endif">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">By items name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="items-name" name="items-name" value="">
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-default btn-fill btn-wd btn-items">Search items</button>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">By author name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="author-name" name="author-name" value="">
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-default btn-fill btn-wd btn-author">Search author</button>
                                    </div>

                                </div>
                            </fieldset>

                          {{--   <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Sale from</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="sale-from" name="sale-from" value="">
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-default btn-fill btn-wd btn-author">Sales from</button>
                                    </div>

                                </div>
                            </fieldset> --}}

                            {{-- <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label"></label>
                                    <div class="col-sm-7">
                                       <button class="btn btn-default btn-fill btn-wd btn-search">Search items</button>
                                    </div>
                                </div>
                            </fieldset> --}}
                        </div><!--End #search-tab-->

                   </div>
                </div>
            </div>

        </form>

        <div id="result-search">
            <div id="list-itemsForBoards" class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <table id="bootstrap-table" class="table"></table>
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->
            </div>
        </div><!--End #result-search-->
@endsection


@section('extrajs')
<script>
    var table_data = {!!$item_json!!};
</script>
<script type="text/javascript" src="/js/create.board.js"></script>
@endsection
