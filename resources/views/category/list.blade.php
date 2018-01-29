@extends('layouts.app')


@section('content')

 <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <ul class="inline-block">
                    <li class="inline-block"><a href="{{action('TaxonomyController@category')}}">Category</a></li>

                </ul>
            </div>
        </div>
    </div>

    <div class="row">

        @foreach($categories as $category)
            <div class="col-md-4">
                <div class="card">
                    <div class="content">
                        <a class="catname items-{{$category->id}}" href="{{Request::url()}}{{$urli}}{{$category->id}}"><h3>{{$category->taxname}}</h3><sup>@if(isset($category->catInfo) && count($category->catInfo) > 0) {{ number_format($category->catInfo[0]->items)}} items @endif</sup><sup>@if(isset($category->catInfo) && count($category->catInfo) > 0) {{number_format($category->catInfo[0]->total_sale)}} sales @endif </sup></a>
                    </div>
                </div>
            </div>
        @endforeach

    </div> <!-- end row -->

</div>

@endsection


@section('extrajs')

@endsection