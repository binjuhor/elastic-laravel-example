@extends('layouts.app')

@section('breadcrumb')
 <ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active"><a href="{{action('TaxonomyController@index')}}">Taxonomy</a></li>
</ol>
@endsection

@section('content')
    {{-- {{$taxitem}} --}}
    edit the eheh

@endsection