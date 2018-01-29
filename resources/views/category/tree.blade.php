@extends('layouts.app')


@section('content')

 <div class="container-fluid">

    <div class="row">
        <ul>
        @foreach($categories as $key => $category)
            <li class=""><a class="catname items-{{$category->id}}" href="{{Request::url()}}{{$urli}}{{$category->id}}"><h3>
            {{$category->taxname}} ({{number_format($category->items()->count())}} items / 0 sales)</h3></a></li>
            @if(isset($category->subList) && count($category->subList) > 0)
                <ul>
                    @foreach($category->subList as $key1 => $value1)
                        <li><a href="#">{{$value1->taxname}}</a> ({{number_format($value1->items()->count())}} items / 0 sales)</li>
                        @if(isset($value1->subList) && count($value1->subList) > 0)
                            <ul>
                                @foreach($value1->subList as $key2 => $value2)
                                    <li><a href="#">{{$value2->taxname}}</a> ({{number_format($value2->items()->count())}} items / 0 sales)</li>
                                @endforeach
                            </ul>
                         @endif
                    @endforeach
                </ul>
             @endif
        @endforeach
        </ul>
    </div> <!-- end row -->
</div>

@endsection